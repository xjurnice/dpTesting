<?php

namespace App\Presenters;

use App\Model\SetModel;
use App\Model\CaseModel;
use Nette,
    Nette\Application\UI\Form;
use App\Model;
use Ublaboo\DataGrid\DataGrid;
use AlesWita;


class SetPresenter extends BasePresenter
{

    /** @var SetModel */
    private $setModel;

    /** @var CaseModel */
    private $caseModel;

    private $data = null;
    /** @persistent */
    public $id;
    /** @persistent */
    public $parent_id;

    public function __construct(setModel $setModel, caseModel $caseModel, Model\EventModel $eventModel)
    {
        parent::__construct($eventModel);

        $this->setModel = $setModel;
        $this->caseModel = $caseModel;
    }

    public function renderEdit()
    {
    }

    public function renderDetail($id, $parent_id)
    {
        $this->id = $id;
        $this->parent_id = $parent_id;
        $this->template->set = $this->setModel->findById($id);
        $this->template->tree = $this->setModel->getTreeSet($parent_id);
        $this->template->parentSet = $this->setModel->findById($parent_id);
        $this->template->childrenSets = $this->setModel->getSets($this->getSession('sekcePromenna')->project)->where('parent_id', $id);


    }



    public function handleEdit($id)

    {
        $this->id = $id;
        $this->data = $this->setModel->findById($id);
        parent::handleModal('edit');
    }
    public function createComponentSetDetailGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->caseModel->getCases($this->getSession('sekcePromenna')->project)->where('set_id', $this->id);


        $grid->setDataSource($fluent);


        $grid->addColumnLink('link', 'Testovací případ', 'Case:detail', 'name')->setFilterText(['name', 'id']);
        $category = [];
        $category = ['' => 'Všechno'] + $this->caseModel->getCaseCategory()->fetchPairs('id', 'name');


        $grid->addColumnText('category_id', 'Kategorie')
            ->setReplacement($this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setFilterSelect($category);
        $grid->addColumnDateTime('create_time', 'Vytvořeno')
            ->setFormat('d.m.Y H:i:s')->setSortable()->setFilterDateRange();
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




    }

    protected function createComponentAddSetForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addText('name', 'Název sady')->setRequired('Prosím zadejte název sady');

        $form->addSelect('parent_id', 'Nadřazená sada', $this->setModel->getSets($this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name'))
            ->setPrompt('Žádna', null);

        $form->addHidden('id')->setDefaultValue($this->data['id']);

        $form->addSubmit('edit', 'Přidat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'addSetSuccess'];

        return $form;
    }


    public function addSetSuccess(Form $form, $values)
    {
        $values = $form->getValues();

        $values['project_id'] = $this->getSession('sekcePromenna')->project;
        $this->setModel->addSet($values);

        $this->flashMessage('Úspěšně přidána sada');
        $this->redirect('Set:default');

    }


    protected function createComponentEditSetForm()
    {

        $form = new Form;

        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addText('name', 'Název sady')->setDefaultValue($this->data['name'])->setRequired('Prosím zadejte název sady');


        $form->addSelect('parent_id', 'Nadřazená sada', $this->setModel->notThisId($this->id, $this->getSession('sekcePromenna')->project)->fetchPairs('id', 'name'))
            ->setPrompt('Zadna', null)->setDefaultValue($this->data['parent_id']);


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

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->setModel->getSets($this->getSession('sekcePromenna')->project)->where('set.parent_id', null);


        $grid->setDataSource($fluent);
        try {
            $grid->setTreeView([$this, 'getChildren'], [$this, 'hasChildren']);

        } catch (DataGridException $e) {
        }


        $grid->addColumnLink('link', 'Jméno sady', 'Set:detail', 'name', ['id', 'parent_id'])->setSortable();


        $grid->addAction('edit', '', 'edit!', ['id'])
            ->setIcon('edit')->setClass('ajax');


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