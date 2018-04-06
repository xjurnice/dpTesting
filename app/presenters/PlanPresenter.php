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
        $this->template->plan = $this->planModel->getPlan($id);


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


        $fluent = $this->caseModel->getCases($this->getSession('sekcePromenna')->project);


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'Name')->setFilterText(['name', 'id', 'name']);;


        $grid->addGroupAction('Přidat')->onSelect[] = [$this, 'addSelectedCase'];

        $grid->addAction('detail', '', 'detail')
            ->setIcon('lemon');



    }

    public function createComponentAssignCaseGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->planModel->getAssignCases($this->id);


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'Name')->setFilterText(['name', 'id', 'name']);;


        $grid->addGroupAction('Odebrat')->onSelect[] = [$this, 'deleteSelectedCase'];

        $grid->addAction('detail', '', 'detail')
            ->setIcon('lemon');



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