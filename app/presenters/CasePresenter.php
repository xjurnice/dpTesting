<?php

namespace App\Presenters;

use App\Model\CaseModel;
use Composer\IO\NullIO;
use Nette,
    App\Model,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;
use Nette\Utils\Html;
use Ublaboo\DataGrid\Exception\DataGridException;
use WebChemistry\Forms;
use AlesWita;



class CasePresenter extends BasePresenter
{


    /** @var CaseModel */
    private $caseModel;

    /** @persistent */
    public $id;


    public $id_step;

    private $data = null;
    private $steps = null;
    private $datastep = null;
    public $case;

    public function __construct(CaseModel $caseModel)
    {
        $this->caseModel = $caseModel;

    }


    public function renderDetail($id)
    {
        $this->id =$id;
        $this->template->author = $this->caseModel->getCurrentAuthor($id);
        $this->template->category = $this->caseModel->getCurrentCaseCategory($id);
        $this->template->case = $this->caseModel->getCase($id);
        $this->template->steps = $this->caseModel->getAllSteps($id);
        $this->template->exe = $this->caseModel->getAllExecutions($id);
        $this->template->exeCount = $this->caseModel->getExecutions($id)->count();
        $this->template->exePassCount = $this->caseModel->getExecutions($id)->where('status',1)->count();
        $this->template->exeFailCount = $this->caseModel->getExecutions($id)->where('status',2)->count();
        $this->template->exeSkipCount = $this->caseModel->getExecutions($id)->where('status',3)->count();
        $this->template->exeSumTime = $this->caseModel->getExecutions($id)->sum('spend_time');
        $this->template->setName = $this->caseModel->getCurrentSet($id);

    }

    public function actionEditStep($id_step)
    {
        $this->id_step = $id_step;
        $this->datastep = $this->caseModel->getStep($id_step);




    }
    public function handleEditStep($id_step)
    {
        $this->id_step = $id_step;
        $this->datastep = $this->caseModel->getStep($id_step);


        parent::handleModal('edit');

    }

    public function handleDeleteStep($id_step)
    {
        $this->id_step = $id_step;
        $this->caseModel->deleteStep($id_step);
        $this->flashMessage('Krok úspěšně smazán.');


    }

    public function handleAddStep()
    {




        parent::handleModal('add');
    }

    protected function createComponentEditStepForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);


        $form->addHidden("id")->setDefaultValue($this->datastep['id']);
        $form->addTextArea('action','Akce',70,7)->setDefaultValue($this->datastep['action']);
        $form->addTextArea('result','Očekáváný výstup',70,5)->setDefaultValue($this->datastep['result']);
        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editStepSuccess'];

        return $form;
    }
    public function editStepSuccess(Form $form, $values)
    {
        $values = $form->getValues();

        $this->caseModel->updateStep($values);

        $this->flashMessage('Záznam byl úspěšně upraven.');


    }

    protected function createComponentAddStepForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);

        $form->addHidden("sequence");
        $form->addHidden("case_id")->setDefaultValue($this->id);
        $form->addTextArea('action','Akce',70,7);
        $form->addTextArea('result','Očekáváný výstup',70,5);
        $form->addSubmit('edit', 'Přidat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'addStepSuccess'];

        return $form;
    }
    public function addStepSuccess(Form $form, $values)
    {
        $values = $form->getValues();

        $this->caseModel->addStep($values);

        $this->flashMessage('Záznam byl úspěšně přidán.');


    }

    public function actionEdit($id)
    {
        $this->data = $this->caseModel->getCase($id);
        $this->steps = $this->caseModel->getAllSteps($id);
    }

    public function actionDetail($id)
    {
        $this->id = $id;
    }



    protected function createComponentInsertForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();
        $status = array(
            '1' => 'Navržený',

        );

        $priority = array(
            '1' => 'Vysoka',
            '2' => 'Stredni',
            '3' => 'Nizka',
        );

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název');
        $form->addSelect('status', 'Status', $status)->setRequired('Uvedte prioritu')
            ->setOption('left-addon', 'addon text');
        $form->addTextArea('description', 'Popis (předpoklady, uživ. role):');

        $form->addSelect('priority', 'Priorita', $priority)->setRequired('Uvedte prioritu');
        $form->addSelect('category_id', 'Case category', $this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setPrompt('Zvolte', null);
        $form->addSelect('project_id', 'Projekt', $this->caseModel->getProject()->fetchPairs('id', 'name'))
            ->setDefaultValue($this->getSession('sekcePromenna')->project)->setDisabled(false);
        $form->addSelect('set_id', 'Testovací sada', $this->caseModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name'))->setPrompt('Zvolte', null)->setRequired('Testovací sada musí být zvolena');

        $copies = 0;
        $maxCopies = 100;

        $multiplier = $form->addMultiplier('multiplier', function (Nette\Forms\Container $container, Nette\Forms\Form $form) {

            $container->addTextArea("action", '#'.((int)$container->getName()+1).' krok'.' Akce')
                ->setDefaultValue('My value'); $container->addTextArea("result", 'Očekávaný výstup')
                ->setDefaultValue('My value') ->setOption('description', Html::el('p')
                    ->setHtml(' <hr>')
                );
        }, $copies, $maxCopies);

        $multiplier->addCreateButton('Přidat 1 krok',1);
        $multiplier->addCreateButton('Přidat 3 kroky',3);
        $multiplier->addCreateButton('Přidat 5 kroků',5);

        $multiplier->addRemoveButton('Odebrat krok');


        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'insertFormSucceeded');
        return $form;
    }



    public function insertFormSucceeded(Form $form, $values)
    {
        // ...
        $values['author_id'] = $this->getUser()->getIdentity()->id;
        $steps= $values['multiplier'];
        $this->caseModel->addCase($values, $steps);
        $this->flashMessage('Záznam byl úspěšně vložen.');

        $this->redirect('Case:default');
    }

    //Edit form


    protected function createComponentEditForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();
        $status = array(
            '0' => 'Naznámý',
            '1' => 'Navržený',
            '2' => 'Schválený',
            '3' => 'Archivovaný',

        );

        $priority = array(
            '1' => 'Vysoka',
            '2' => 'Stredni',
            '3' => 'Nizka',
        );
        $form->addHidden('create_time')->setDefaultValue($this->data['create_time']);
        $form->addHidden('id', 'Název:')->setDefaultValue($this->data['id']);
        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název')->setDefaultValue($this->data['name']);
        $form->addSelect('status', 'Status', $status)->setRequired('Uvedte prioritu')->setDefaultValue($this->data['status']);
        $form->addTextArea('description', 'Popis (předpoklady, uživ. role):')->setDefaultValue($this->data['description']);

        $form->addSelect('priority', 'Priorita', $priority)->setRequired('Uvedte prioritu')->setDefaultValue($this->data['priority']);
        $form->addSelect('category_id', 'Case category', $this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setDefaultValue($this->data['category_id']);
        $form->addSelect('project_id', 'Projekt', $this->caseModel->getProject()->fetchPairs('id', 'name'))
            ->setDefaultValue($this->data['project_id'])->setDisabled(false);
        $form->addSelect('set_id', 'Testovací sada', $this->caseModel->getSets($this->getSession('sekcePromenna')->project)->
        fetchPairs('id', 'name'))->setDefaultValue($this->data['set_id'])->setRequired('Testovací sada musí být zvolena');

        $form->addSubmit('add', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'editFormSucceeded');
        return $form;
    }


    public function editFormSucceeded(Form $form, $values)
    {
        $values = $form->getValues();
        $values['update_time']= new \Nette\Utils\DateTime();
        $this->caseModel->updateCase($values);


        $this->flashMessage('Záznam byl úspěšně upraven.');

        $this->redirect('Case:default');
    }

    public function createComponentCaseGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->caseModel->getCases($this->getSession('sekcePromenna')->project);


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'Name');
        $grid->addColumnText('description', 'Popis');
        $grid->addColumnText('id', 'Id');


        $grid->addAction('edit', '', 'edit')->setIcon('edit');
        $grid->addAction('detail', '', 'detail')
            ->setIcon('lemon');

        $grid->addAction('delete', '', 'delete!')
            ->setIcon('trash')->setConfirm('Opravdu chcete smazat test case %s?', 'name');;


    }


    public function createComponentExeGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);




        $fluent = $this->caseModel->getAllExecutions($this->id);


        $grid->setDataSource($fluent);

        $grid->addColumnDateTime('start_time', 'Cas spusteni')
            ->setFormat('d.m.Y H:i:s')->setSortable();



        try {
            $grid->addColumnText('spend_time', 'Cas')
                ->setSortable()->setRenderer(function ($item) {
                    if ($item->spend_time < 60) {
                        return ($item->spend_time) . ' sekund';
                    } else {

                        return (round($item->spend_time / 60, 2)) . ' minut';
                    }
                })->setSortable();
        } catch (DataGridException $e) {
        };

        $grid->addColumnLink('link', 'Uživatel', 'User:profile', 'username',  ['id' => 'ide'])->setSortable();



    }

    public function actionDelete($id) {
        $this->caseModel->deleteCase($id);

        $this->flashMessage("Najemník byl smazán");
        $this->redirect("Case:prehled");
    }


    public function handleDelete($id) {
        $this->flashMessage('Nájemník smazán.');
        $todo = $this->caseModel;
        if ($todo) {
            $todo->deleteCase($id);
        }

        $this->redirect('this'); // this vyjadřuje aktuální presenter i view, ale bez signálu
    }










}




