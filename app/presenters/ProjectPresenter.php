<?php

namespace App\Presenters;

use App\Model\ProjectModel;
use Latte\Runtime\Template;
use Nette,
    Nette\Application\UI\Form;
use App\Model;
use Ublaboo\DataGrid\DataGrid;
use AlesWita;




class ProjectPresenter extends BasePresenter
{

    /** @var ProjectModel */
    public $projectModel;
    private $data = null;
    public $id;

    public function __construct(projectModel $projectModel, Model\EventModel $eventModel)
    {
        parent::__construct($eventModel);
        $this->projectModel = $projectModel;
    }

    public function renderEdit()
    {
    }




    protected function createComponentInsertForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název');
        $form->addText('start_date', 'Plánovaný začátek projektu')->setType('date')->setRequired('Prosím zadejte datum k plánovanému začátku projektu');
        $form->addText('end_date', 'Plánovaný konec projektu')->setType('date')->setRequired('Prosím zadejte datum k plánovanému konci projektu');

        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'insertFormSucceeded');
        return $form;
    }

    public function insertFormSucceeded(Form $form, $values)
    {

        $this->projectModel->addProject($values);
        $this->flashMessage('Záznam byl úspěšně vložen.');

        $this->redirect('Dashboard:default');
    }





}