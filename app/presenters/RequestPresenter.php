<?php

namespace App\Presenters;

use App\Model\ProjectModel;
use App\Model\RequestModel;
use App\Model\SetModel;
use App\Model\CaseModel;
use Nette,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;
use AlesWita;


class RequestPresenter extends BasePresenter
{

    /** @var RequestModel */
    private $requestModel;

    /** @var CaseModel */
    private $caseModel;

    /** @var ProjectModel */
    public $projectModel;

    private $data = null;
    /** @persistent */
    public $id;
    /** @persistent */
    public $parent_id;

    public function __construct(requestModel $requestModel, caseModel $caseModel, projectModel $projectModel)
    {
        $this->requestModel = $requestModel;
        $this->caseModel = $caseModel;
        $this->projectModel = $projectModel;
    }


    public function handleAddRequest()
    {

        parent::handleModal('addRequest');
    }


    public function renderDetail($id)
    {
        $this->id = $id;
        $this->template->request = $this->requestModel->getRequest($id);

    }

    public function createComponentRequestGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);
        $grid->setRememberState(FALSE);


        $fluent = $this->requestModel->getRequests($this->getSession('sekcePromenna')->project, $this->id);


        $grid->setDataSource($fluent);


        $grid->addColumnLink('link', 'Název', 'detail', 'name', ['id' => 'id'])->setFilterText(['name', 'id']);

        $grid->addColumnStatus('status', 'Status')
            ->setCaret(false)
            ->addOption(0, 'Zadaný')
            ->setIcon('check')
            ->setClass('btn-info')
            ->endOption()
            ->addOption(1, 'Splněný')
            ->setIcon('check')
            ->setClass('btn-success')
            ->endOption();
        $grid->addColumnDateTime('create_time', 'Vytvořeno')
            ->setFormat('d.m.Y H:i:s')->setSortable();

    }

    protected function createComponentAddRequestForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název');
        $form->addTextArea('description', 'Popis:', 40, 10);
        $form->addHidden("project_id")->setDefaultValue($this->getSession('sekcePromenna')->project);

        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'insertFormSucceeded');
        return $form;
    }

    public function insertFormSucceeded(Form $form, $values)
    {
        $values['user_id'] = $this->getUser()->getIdentity()->id;
        $values['status'] = 0; // 0 means just created
        $this->requestModel->addRequest($values);
        $this->flashMessage('Záznam byl úspěšně vložen.');

        $this->redirect('Request:default');
    }

}