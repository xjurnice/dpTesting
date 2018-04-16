<?php

namespace App\Presenters;


use App\Model\SettingModel;
use Nette,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;
use AlesWita;


class SettingPresenter extends BasePresenter
{

    /** @var SettingModel */
    private $settingModel;


    private $data = null;
    /** @persistent */
    public $id;

    public function __construct(settingModel $settingModel)
    {
        $this->settingModel = $settingModel;

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

    public function editFormSucceeded(Form $form, $values)
    {

        $this->settingModel->updateCategory($values);
        $this->flashMessage('Záznam byl úspěšně upraven');

        $this->redirect('Setting:default');
    }


}