<?php

namespace App\Presenters;

use AlesWita;
use App\Model;
use App\Model\CaseModel;
use Joseki;
use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\Html;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;
use WebChemistry\Forms;


class CasePresenter extends BasePresenter
{


    /** @persistent */
    public $id;
    public $id_step;
    public $case;
    /** @var CaseModel */
    private $caseModel;
    private $data = null;
    private $steps = null;
    private $datastep = null;

    public function __construct(CaseModel $caseModel, Model\EventModel $eventModel)
    {
        parent::__construct($eventModel);
        $this->caseModel = $caseModel;

    }


    public function renderDetail($id)
    {


        $this->id = $id;
        $this->template->author = $this->caseModel->getCurrentAuthor($id);
        $this->template->category = $this->caseModel->getCurrentCaseCategory($id);
        $this->template->case = $this->caseModel->getCase($id);
        $this->template->steps = $this->caseModel->getAllSteps($id);
        $this->template->exe = $this->caseModel->getAllExecutions($id);
        $this->template->plans = $this->caseModel->getAllTestPlans($id, $this->getSession('sekcePromenna')->project);
        $this->template->exeCount = $this->caseModel->getExecutions($id)->count();
        $this->template->exePassCount = $this->caseModel->getExecutions($id)->where('status', 1)->count();
        $this->template->exeFailCount = $this->caseModel->getExecutions($id)->where('status', 2)->count();
        $this->template->exeSkipCount = $this->caseModel->getExecutions($id)->where('status', 3)->count();
        $this->template->exeSumTime = $this->caseModel->getExecutions($id)->sum('spend_time');
        $this->template->setName = $this->caseModel->getCurrentSet($id);
        $this->template->projectName = $this->getSession('sekcePromenna')->projectName;

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

    public function handleAddNote($id_step)

    {
        $this->id_step = $id_step;
        $this->datastep = $this->caseModel->getStep($id_step);

        parent::handleModal('note');
    }

    public function editStepSuccess(Form $form, $values)
    {
        $values = $form->getValues();

        $this->caseModel->updateStep($values);

        $this->flashMessage('Záznam byl úspěšně upraven.');


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

    public function insertFormSucceeded(Form $form, $values)
    {
        // ...
        $values['author_id'] = $this->getUser()->getIdentity()->id;
        $steps = $values['multiplier'];
        $this->caseModel->addCase($values, $steps);
        $this->flashMessage('Záznam byl úspěšně vložen.');

        $this->redirect('Case:default');
    }

    public function editFormSucceeded(Form $form, $values)
    {
        $values = $form->getValues();
        $values['update_time'] = new \Nette\Utils\DateTime();
        $this->caseModel->updateCase($values);


        $this->flashMessage('Záznam byl úspěšně upraven.');

        $this->redirect('Case:detail', $values['id']);
    }

    public function createComponentCaseGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);
        $grid->setRememberState(FALSE);


        $fluent = $this->caseModel->getCases($this->getSession('sekcePromenna')->project);


        $grid->setDataSource($fluent);


        $grid->addColumnLink('link', 'Testovací případ', 'Case:detail', 'name', ['id' => 'id'])->setFilterText(['name', 'id']);

        $set = [];
        $set = ['' => 'Všechno'] + $this->caseModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name');

        $category = [];
        $category = ['' => 'Všechno'] + $this->caseModel->getCaseCategory()->fetchPairs('id', 'name');
        $grid->addColumnText('set_id', 'Sada')
            ->setReplacement($this->caseModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name'))
            ->setFilterSelect($set);

        $grid->addColumnText('category_id', 'Kategorie')
            ->setReplacement($this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setFilterSelect($category);
        $grid->addColumnDateTime('create_time', 'Vytvořeno')
            ->setFormat('d.m.Y H:i:s')->setSortable();
        $grid->addColumnDateTime('update_time', 'Poslední změna')
            ->setFormat('d.m.Y H:i:s')->setSortable();
        $grid->addExportCsv('Exportovat do CSV', 'all.csv', 'windows-1250', ';');
        $grid->addColumnText('status', 'Status')
            ->setRenderer(function ($item) {
                switch ($item->status) {
                    case 0:
                        return "K přepracování";
                        break;
                    case 1:
                        return "Navržený";
                        break;

                    case 2:
                        return "Schválený";
                        break;


                }
            })->addAttributes(['class' => 'text-center font-weight-bold']);

        $grid->addAction('delete', '', 'delete!')
            ->setIcon('trash')->setConfirm('Opravdu chcete smazat testovací případ "%s?"', 'name');


    }

    public function createComponentApprovalCaseGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);
        $grid->setRememberState(FALSE);

        $fluent = $this->caseModel->getCases($this->getSession('sekcePromenna')->project);


        $grid->setDataSource($fluent);


        $grid->addColumnLink('link', 'Testovací případ', 'Case:detail', 'name', ['id' => 'id'])->setFilterText(['name', 'id']);

        $set = [];
        $set = ['' => 'Všechno'] + $this->caseModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name');
        $grid->addColumnStatus('status', 'Status')
            ->setCaret(false)
            ->addOption(0, 'K přepracování')
            ->setIcon('')
            ->setClass('btn-light')
            ->endOption()
            ->addOption(1, 'Navžený')
            ->setIcon('spinner')
            ->setClass('btn-info')
            ->endOption()
            ->addOption(2, 'Schválený')
            ->setIcon('check')
            ->setClass('btn-success')
            ->endOption()->onChange[] = [$this, 'statusChange'];

        $grid->addColumnText('set_id', 'Sada')
            ->setReplacement($this->caseModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name'))
            ->setFilterSelect($set);


        $category = [];
        $category = ['' => 'Všechno'] + $this->caseModel->getCaseCategory()->fetchPairs('id', 'name');

        $grid->addColumnText('category_id', 'Kategorie')
            ->setReplacement($this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setFilterSelect($category);
        $grid->addColumnDateTime('create_time', 'Vytvořeno')
            ->setFormat('d.m.Y H:i:s')->setSortable();

        $grid->addGroupAction('K přepracování')->onSelect[] = [$this, 'changeTo0Project'];
        $grid->addGroupAction('Navržený')->onSelect[] = [$this, 'changeTo1Project'];
        $grid->addGroupAction('Schválený')->onSelect[] = [$this, 'changeTo2Project'];

    }

    public function changeTo0Project(array $ids)
    {
        $status = 0;
        $user = $this->user->getIdentity()->id;
        $project = $this->getSession('sekcePromenna')->project;
        $this->caseModel->updateCaseStatus($ids, $status, $user, $project);
        $this->flashMessage('Záznam byl úspěšně upraven.');
        $this['approvalCaseGrid']->reload();
        $this->redirect('this');
    }

    //Edit form

    public function changeTo1Project(array $ids)
    {
        $status = 1;
        $user = $this->user->getIdentity()->id;
        $project = $this->getSession('sekcePromenna')->project;
        $this->caseModel->updateCaseStatus($ids, $status, $user, $project);
        $this->flashMessage('Záznam byl úspěšně upraven.');
        $this['approvalCaseGrid']->reload();
        $this->redirect('this');

    }

    public function changeTo2Project(array $ids)
    {
        $status = 2;
        $user = $this->user->getIdentity()->id;
        $project = $this->getSession('sekcePromenna')->project;
        $this->caseModel->updateCaseStatus($ids, $status, $user, $project);
        $this->flashMessage('Záznam byl úspěšně upraven.');
        $this['approvalCaseGrid']->reload();
        $this->redirect('this');

    }

    public function statusChange($id, $new_status)
    {
        if (in_array($new_status, [0, 1, 2])) {
            $this->caseModel->getCase($id)
                ->update(['status' => $new_status]);
            $user = $this->user->getIdentity()->id;
            $project = $this->getSession('sekcePromenna')->project;
            $this->caseModel->caseUpdateEvent($user, $id, $project);
        }

        $this->flashMessage('Záznam byl úspěšně upraven.');

        $this->redirect("this");

    }

    public function createComponentExeGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->caseModel->getAllExecutions($this->id);


        $grid->setDataSource($fluent);

        $grid->addColumnDateTime('start_time', 'Čas spusteni')
            ->setFormat('d.m.Y H:i:s')->setSortable();
        $grid->addColumnDateTime('end_time', 'Čas ukonceni')
            ->setFormat('d.m.Y H:i:s')->setSortable();


        try {
            $grid->addColumnText('spend_time', 'Čas')
                ->setSortable()->setRenderer(function ($item) {
                    if ($item->spend_time < 60) {
                        return ($item->spend_time) . ' sekund';
                    } else {

                        return (round($item->spend_time / 60, 2)) . ' minut';
                    }
                })->setSortable();
        } catch (DataGridException $e) {
        };
        $grid->addColumnText('status', 'Status')
            ->setRenderer(function ($item) {
                switch ($item->status) {
                    case 0:
                        return "K přepracování";
                        break;
                    case 1:
                        return "Navržený";
                        break;

                    case 2:
                        return "Schválený";
                        break;


                }
            })->addAttributes(['class' => 'text-center font-weight-bold']);
        $grid->addColumnLink('link', 'Uživatelem', 'User:profile', 'username', ['id' => 'ide'])->setSortable();

        $grid->addAction('detail', '', 'Execution:detail')
            ->setIcon('lemon')
            ->setTitle('Detail');

    }

    public function actionDelete($id)
    {
        $this->caseModel->deleteCase($id);

        $this->flashMessage("Testovací případ byl smazán");
        $this->redirect("Case:prehled");
    }

    public function handleDelete($id)
    {
        $this->flashMessage('Testovací případ byl smazán.');
        $todo = $this->caseModel;
        if ($todo) {
            $todo->deleteCase($id);
        }

        $this->redirect('this'); // this vyjadřuje aktuální presenter i view, ale bez signálu
    }

    protected function createComponentEditStepForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);


        $form->addHidden("id")->setDefaultValue($this->datastep['id']);
        $form->addTextArea('action', 'Akce', 70, 7)->setDefaultValue($this->datastep['action']);
        $form->addTextArea('result', 'Očekáváný výstup', 70, 5)->setDefaultValue($this->datastep['result']);
        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editStepSuccess'];

        return $form;
    }

    protected function createComponentAddStepForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);

        $form->addHidden("sequence");
        $form->addHidden("case_id")->setDefaultValue($this->id);
        $form->addTextArea('action', 'Akce', 70, 7);
        $form->addTextArea('result', 'Očekáváný výstup', 70, 5);
        $form->addSubmit('edit', 'Přidat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'addStepSuccess'];

        return $form;
    }

    protected function createComponentAddNoteForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addHidden("id")->setDefaultValue($this->datastep['id']);
        $form->addHidden("case_id")->setDefaultValue($this->id);
        $form->addTextArea('note', 'Poznámka', 80, 10)->setDefaultValue($this->datastep['note']);
        $form->addSubmit('edit', 'Přidat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editStepSuccess'];

        return $form;
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
            '1' => 'Vysoká',
            '2' => 'Střední',
            '3' => 'Nízká',
        );

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název');
        $form->addSelect('status', 'Status', $status)->setRequired('Uvedte prioritu')
            ->setOption('left-addon', 'addon text');
        $form->addTextArea('description', 'Popis (předpoklady, uživ. role):');

        $form->addSelect('priority', 'Priorita', $priority)->setRequired('Uvedte prioritu');
        $form->addSelect('category_id', 'Case category', $this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setPrompt('Zvolte', null);
        $form->addHidden('project_id', 'Projekt')->setDefaultValue($this->getSession('sekcePromenna')->project);
        $form->addSelect('set_id', 'Testovací sada', $this->caseModel->getSets($this->getSession('sekcePromenna')->project)
            ->fetchPairs('id', 'name'))->setPrompt('Zvolte', null)->setRequired('Testovací sada musí být zvolena');

        $copies = 0;
        $maxCopies = 100;

        $multiplier = $form->addMultiplier('multiplier', function (Nette\Forms\Container $container, Nette\Forms\Form $form) {

            $container->addTextArea("action", '#' . ((int)$container->getName() + 1) . ' krok' . ' Akce')
                ->setDefaultValue('My value');
            $container->addTextArea("result", 'Očekávaný výstup')
                ->setDefaultValue('My value')->setOption('description', Html::el('p')
                    ->setHtml(' <hr>')
                );
        }, $copies, $maxCopies);

        $multiplier->addCreateButton('Přidat 1 krok', 1);
        $multiplier->addCreateButton('Přidat 3 kroky', 3);
        $multiplier->addCreateButton('Přidat 5 kroků', 5);

        $multiplier->addRemoveButton('Odebrat krok'); $copies = 0;
        $maxCopies = 100;

     


        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'insertFormSucceeded');
        return $form;
    }

    protected function createComponentEditForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();
        $status = array(
            '0' => 'K přepracování',
            '1' => 'Navržený',
            '2' => 'Schválený',

        );

        $priority = array(
            '1' => 'Vysoká',
            '2' => 'Střední',
            '3' => 'Nízká',
        );
        $form->addHidden('create_time')->setDefaultValue($this->data['create_time']);
        $form->addHidden('id', 'Název:')->setDefaultValue($this->data['id']);
        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název')->setDefaultValue($this->data['name']);
        $form->addSelect('status', 'Status', $status)->setRequired('Uvedte prioritu')->setDefaultValue($this->data['status']);
        $form->addTextArea('description', 'Popis (předpoklady, uživ. role):')->setDefaultValue($this->data['description']);

        $form->addSelect('priority', 'Priorita', $priority)->setRequired('Uvedte prioritu')->setDefaultValue($this->data['priority']);
        $form->addSelect('category_id', 'Case category', $this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setDefaultValue($this->data['category_id']);

        $form->addSelect('set_id', 'Testovací sada', $this->caseModel->getSets($this->getSession('sekcePromenna')->project)->
        fetchPairs('id', 'name'))->setDefaultValue($this->data['set_id'])->setRequired('Testovací sada musí být zvolena');

        $form->addSubmit('add', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'editFormSucceeded');
        return $form;
    }


}




