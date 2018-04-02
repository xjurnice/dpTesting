<?php

namespace App\Presenters;

use App\Model\CaseModel;
use Composer\IO\NullIO;
use Nette,
    App\Model,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;
use Nette\Utils\Html;
use WebChemistry\Forms;
use AlesWita;



class CasePresenter extends BasePresenter
{


    /** @var CaseModel */
    private $caseModel;

    /** @persistent */
    public $id;

    private $data = null;
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


    public function createComponentCaseGrid($name)
    {

        $grid = new DataGrid($this, $name);


        $fluent = $this->caseModel->getCases($this->getSession('sekcePromenna')->project);


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'Name');
        $grid->addColumnText('description', 'Popis');
        $grid->addColumnText('id', 'Id');


        $grid->addAction('edit', '', 'edit')
            ->setIcon('edit');
        $grid->addAction('detail', '', 'detail')
            ->setIcon('lemon');

        $grid->addAction('delete', '', 'delete!')
            ->setIcon('trash')->setConfirm('Opravdu chcete smazat test case %s?', 'name');;


    }


    public function createComponentExeGrid($name)
    {

        $grid = new DataGrid($this, $name);




        $fluent = $this->caseModel->getAllExecutions($this->id);


        $grid->setDataSource($fluent);

        $grid->addColumnDateTime('start_time', 'Cas spusteni')
            ->setFormat('d.m.Y H:i:s')->setSortable();
        $grid->addColumnDateTime('end_time', 'Cas ukonceni')
            ->setFormat('d.m.Y H:i:s')->setSortable();


        $grid->addColumnText('spend_time', 'Cas spotrebovany')->setSortable();


        $grid->addColumnLink('link', 'Uživatel', 'User:profile', 'username', ['ide'])->setSortable();


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



    protected function createComponentEditSetForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addText('name', 'Název sady')->setDefaultValue($this->data['name'])->setRequired('Prosím zadejte název sady');


        $form->addSelect('parent_id', 'Nadrazena sada', $this->caseModel->notThisId($this->data['id'])->fetchPairs('id', 'name'))
            ->setPrompt('Zadna', null)->setDefaultValue($this->data['parent_id']);


        $form->addText('project_id', 'Projekt')->setDefaultValue($this->data['project_id']);
        $form->addHidden('id')->setDefaultValue($this->data['id']);

        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editSetSuccess'];

        return $form;
    }



    public function editSetSuccess(Form $form, $values)
    {
        $values = $form->getValues();


        $this->caseModel->updateSet($values);

        $this->flashMessage('Úspěšně změněny údaje.');
        $this->redirect('Case:default');

    }






}




