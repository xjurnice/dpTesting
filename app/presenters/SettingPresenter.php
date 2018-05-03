<?php

namespace App\Presenters;


use App\Model\ProjectModel;
use App\Model\SettingModel;
use Nette,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;
use AlesWita;


class SettingPresenter extends BasePresenter
{

    /** @var SettingModel */
    private $settingModel;

    /** @var ProjectModel */
    private $projectModel;


    private $data = null;
    /** @persistent */
    public $id;

    public function __construct(settingModel $settingModel, projectModel $projectModel)
    {
        $this->settingModel = $settingModel;
        $this->projectModel = $projectModel;

    }

    public function renderEdit()
    {
    }

    public function renderDefault()
    {


        $this->template->categoryes = $this->settingModel->getCaseCategory();
    }

    public function handleAdd()
    {

        parent::handleModal('add');
    }




    public function handleEdit($id)
    {
        $this->id = $id;
        $this->data = $this->settingModel->getCategoryID($id);
        parent::handleModal('edit');
    }

    protected function createComponentInsertForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název');


        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'insertFormSucceeded');
        return $form;
    }

    public function insertFormSucceeded(Form $form, $values)
    {

        $this->settingModel->addCategory($values);
        $this->flashMessage('Záznam byl úspěšně vložen.');

        $this->redirect('Setting:default');
    }

    protected function createComponentEditForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název')->setDefaultValue($this->data['name']);

        $form->addHidden("id")->setDefaultValue($this->data['id']);

        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'editFormSucceeded');
        return $form;
    }

    protected function createComponentEditProjectForm()
    {
        $form = new Form;
        $data = $this->projectModel->getProject()->where('id',$this->getSession('sekcePromenna')->project)->fetch();
        $start= new \DateTime($data['start_date']);
        $start= $start->format('d.m.Y');

        $end= new \DateTime($data['end_date']);
        $end= $end->format('d.m.Y');

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název')->setDefaultValue($data['name']);

        $form->addHidden("id")->setDefaultValue($data['id']);
        $form->addText('start_date', 'Začátek projektu')->setDefaultValue($start)->setRequired('Prosím zadejte datum k začátku projektu');
        $form->addText('end_date', 'Konec projektu')->setDefaultValue($end)->setRequired('Prosím zadejte datum ke konci projektu');

        $form->addSubmit('add', 'Upravit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'editFormSucceededProject');
        return $form;
    }

    public function editFormSucceeded(Form $form, $values)
    {

        $this->settingModel->updateCategory($values);
        $this->flashMessage('Záznam byl úspěšně upraven');

        $this->redirect('Setting:default');
    }

    public function editFormSucceededProject(Form $form, $values)
    {

        $values["start_date"] = new \Nette\Utils\DateTime($values["start_date"]);
        $values["end_date"] = new \Nette\Utils\DateTime($values["end_date"]);

        $this->projectModel->updateProject($values);
        $this->flashMessage('Záznam byl úspěšně upraven');

        $this->redirect('Setting:default');
    }



}