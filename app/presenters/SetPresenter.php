<?php

namespace App\Presenters;

use App\Model\SetModel;
use Nette,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;
use AlesWita;




class SetPresenter extends BasePresenter
{

    /** @var SetModel */
    private $setModel;
    private $data = null;
    public $id;

    public function __construct(setModel $setModel)
    {
        $this->setModel = $setModel;
    }

    public function renderEdit()
    {
    }

    public function actionEdit($id)
    {
        $this->data = $this->setModel->findById($id);
    }


    protected function createComponentAddSetForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addText('name', 'Název sady')->setRequired('Prosím zadejte název sady');


        $form->addSelect('parent_id', 'Nadrazena sada', $this->setModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name'))
            ->setPrompt('Zadna', null);

        $form->addHidden('id')->setDefaultValue($this->data['id']);

        $form->addSubmit('edit', 'Přidat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'addSetSuccess'];

        return $form;
    }



    public function addSetSuccess(Form $form, $values)
    {
        $values = $form->getValues();

        $values['project_id']=$this->getSession('sekcePromenna')->project;
        $this->setModel->addSet($values);

        $this->flashMessage('Úspěšně přidána sada');
        $this->redirect('Set:default');

    }


    protected function createComponentEditSetForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addText('name', 'Název sady')->setDefaultValue($this->data['name'])->setRequired('Prosím zadejte název sady');


        $form->addSelect('parent_id', 'Nadrazena sada', $this->setModel->notThisId($this->data['id'],$this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name'))
            ->setPrompt('Zadna', null)->setDefaultValue($this->data['parent_id']);


        $form->addText('project_id', 'Projekt')->setDefaultValue($this->getSession('sekcePromenna')->project);
        $form->addHidden('id')->setDefaultValue($this->data['id']);

        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editSetSuccess'];

        return $form;
    }



    public function editSetSuccess(Form $form, $values)
    {
        $values = $form->getValues();


        $this->setModel->updateSet($values);

        $this->flashMessage('Úspěšně změněny údaje.');
        $this->redirect('Set:default');

    }

    public function createComponentCategoriesGrid($name)
    {

        $grid = new DataGrid($this, $name);


        $fluent = $this->setModel->getSets($this->getSession('sekcePromenna')->project)->where('set.parent_id', null);


        $grid->setDataSource($fluent);
        try {
            $grid->setTreeView([$this, 'getChildren'], [$this, 'hasChildren']);

        } catch (DataGridException $e) {
        }


        $grid->addColumnText('name', 'Name');



        $grid->addAction('edit', '', 'edit')
            ->setIcon('edit');


    }

    public function getChildren($parentId)
    {
        return $this->setModel->getSets($this->getSession('sekcePromenna')->project)->where('parent_id', $parentId);
    }



    public function hasChildren($parentId)
    {
        return $this->setModel->getSets($this->getSession('sekcePromenna')->project)->where('parent_id', $parentId)->count() > 0 ? true : false;
    }



}