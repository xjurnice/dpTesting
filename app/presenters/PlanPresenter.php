<?php

namespace App\Presenters;

use App\Model\CaseModel;
use App\Model\ProjectModel;
use Nette,
    Nette\Application\UI\Form;
use Ublaboo\DataGrid\DataGrid;
use App\Model\PlanModel;
use AlesWita;



class PlanPresenter extends BasePresenter
{

    /** @var PlanModel */
    private $planModel;

    /** @var ProjectModel */
    private $projectModel;

    /** @var CaseModel */
    private $caseModel;
    private $data = null;

    /** @persistent */
    public $id;

    public function __construct(PlanModel $planModel, ProjectModel $projectModel, CaseModel $caseModel)
    {
        $this->planModel = $planModel;
        $this->caseModel = $caseModel;
        $this->projectModel = $projectModel;
    }

    public function renderDefault()
    {
    $this->template->plans = $this->planModel->getPlans($this->getSession('sekcePromenna')->project);
    }
    public function renderDetail($id)
    {
        $this->template->plan_id = $id;
        $this->template->plan = $this->planModel->getPlan($id);
        if ($this->planModel->getFirstCase($id)<>null) {
            $this->template->first = $this->planModel->getFirstCase($id);
        }

        if ($this->planModel->getNextCase($id)<>null) {
            $this->template->next = $this->planModel->getNextCase($id);
        }

        $succes = $this->planModel->getCountExecution($id)->where('status',1)->count();
        $fail = $this->planModel->getCountExecution($id)->where('status',2)->count();
        $skip = $this->planModel->getCountExecution($id)->where('status',3)->count();
        $this->template->labels = ["Úspěšný","Neúspěšný","Vynechaný"];
        $this->template->series = [$succes,$fail,$skip];


    }


    public function handleAddPlan(){

        parent::handleModal('add');
    }

    public function handleAddCase(){

        parent::handleModal('addcase');
    }


    public function createComponentCaseGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->planModel->getCasesNotInPlanYet($this->getSession('sekcePromenna')->project,$this->id);


        $grid->setDataSource($fluent);


        $grid->addColumnLink('link', 'Testovací případ', 'Case:detail', 'name',  ['id' => 'id'])->setFilterText(['name', 'id']);
$set = [];
$set = ['' => 'Všechno'] + $this->caseModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id','name');


        $grid->addColumnText('set_id', 'Sada')
            ->setReplacement($this->caseModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id','name'))
            ->setFilterSelect($set);

        $grid->addGroupAction('Přidat')->onSelect[] = [$this, 'addSelectedCase'];

        $grid->addColumnDateTime('create_time', 'Vytvořeno')
            ->setFormat('d.m.Y H:i:s')->setSortable();




    }

    public function createComponentAssignCaseGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->planModel->getAssignCases($this->id);


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'Name')->setFilterText(['name', 'id', 'name']);
        $grid->addColumnText('sequence', 's');

        $grid->addGroupAction('Odebrat')->onSelect[] = [$this, 'deleteSelectedCase'];





    }

    public function deleteSelectedCase(array $ids)
    {

            $this->planModel->deleteCases($ids,$this->id);
        $this->flashMessage('Záznam byl úspěšně odebrán.');
            $this['assignCaseGrid']->reload();
        $this->redirect('this');



    }
    public function addSelectedCase(array $ids)
    {

        $this->planModel->addCases($ids,$this->id);


            $this->flashMessage('Záznam byl úspěšně přidán.');

            $this['assignCaseGrid']->reload();

            $this->redirect('this');

    }

    protected function createComponentAddPlanForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název');
        $form->addSelect('project_id', 'Projekt', $this->projectModel->getProject()->fetchPairs('id', 'name'))
            ->setDefaultValue($this->getSession('sekcePromenna')->project)->setDisabled(false);
        $form->addSelect('assign_user_id', 'Určeno pro', $this->planModel->getUsers()->fetchPairs('id', 'username'));
        $form->addText('planed_time', 'Plánovaný čas spuštění')->setType('date')->setRequired('Prosím zadejte platnost nájemní smlouvy');

        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'insertFormSucceeded');
        return $form;
    }



    public function insertFormSucceeded(Form $form, $values)
    {

        $this->planModel->addPlan($values);
        $this->flashMessage('Záznam byl úspěšně vložen.');

        $this->redirect('Plan:default');
    }
}