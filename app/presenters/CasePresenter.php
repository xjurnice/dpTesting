<?php

namespace App\Presenters;

use App\Model\CaseModel;
use Nette,
    App\Model,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;


class CasePresenter extends BasePresenter
{


    /** @var CaseModel */
    private $caseModel;

    private $data = null;

    public function __construct(CaseModel $caseModel)
    {
        $this->caseModel = $caseModel;
    }


    public function renderDefault()
    {
        $this->template->anyVariable = 'any value';
    }

    public function createComponentCategoriesGrid($name)
    {

        $grid = new DataGrid($this, $name);


        $fluent = $this->caseModel->getSets()->where('set.parent_id', null);


        $grid->setDataSource($fluent);
        $grid->setTreeView([$this, 'getChildren'], [$this, 'hasChildren']);


        //$grid->setSortable();

        $grid->addColumnText('name', 'Name');
        $grid->addColumnText('name2', 'Name2', 'name');
        $grid->addColumnText('id', 'Id')
            ->setAlign('center');


    }


    public function handleEdit()
    {
    }

    public function getChildren($parentId)
    {
        return $this->caseModel->getSets()->where('parent_id', $parentId);
    }

    public function hasChildren($parentId)
    {
        return $this->caseModel->getSets()->where('parent_id', $parentId)->count() > 0 ? true : false;
    }

    public function handleSetCategoryStatus($id, $status)
    {
        $this->categoryRepository->changeStatus($id, $status);

        $this->flashMessage("Status of category [$id] was updated to [$status].", 'success');

        $fluent = $this->caseModel->getSets()->where('set.parent_id', null);

        if ($this->isAjax()) {
            $this->redrawControl('flashes');

            $this['categoriesGrid']->setDataSource($fluent);
            $this['categoriesGrid']->redrawItem($id, 'c.id');
        } else {
            $this->redirect('this');
        }
    }


}




