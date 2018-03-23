<?php

namespace App\Presenters;

use App\Model\CaseModel;
use Composer\IO\NullIO;
use Nette,
    App\Model,
    Nette\Application\UI\Form;

use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;
use Nette\Utils\Html;
use WebChemistry\Forms;



class CasePresenter extends BasePresenter
{


    /** @var CaseModel */
    private $caseModel;
    public $id;

    private $data = null;
    public $case;

    public function __construct(CaseModel $caseModel)
    {
        $this->caseModel = $caseModel;

    }


    public function renderDetail($id)
    {

        $this->template->case= $this->caseModel->getCase($id);
        $this->template->steps= $this->caseModel->getAllSteps($id);

    }


    public function renderDefault()
    {
        $this->data = $this->caseModel->getSets();
    }

    public function actionEdit($id)
    {
        $this->data = $this->caseModel->findById($id);
    }



    protected function createComponentInsertForm()
    {
        $form = new Form;
        $form->onRender[] = [$this, 'makeBootstrap4'];
        $form->addProtection();
        $priority = array(
            '1' => 'Vysoka',
            '2' => 'Stredni',
            '3' => 'Nizka',
        );

        $form->addText('name', 'Název:')->setRequired('Je nutné uvést název');
        $form->addTextArea('description', 'Popis:')->setRequired('Uveďte cenu!');

        $form->addSelect('priority', 'Priorita', $priority)->setRequired('Uvedte datum pořízení!');
        $form->addSelect('category_id', 'Case category', $this->caseModel->getCaseCategory()->fetchPairs('id', 'name'))
            ->setPrompt('Zvolte', null);
        $form->addSelect('project_id', 'Projekt', $this->caseModel->getProject()->fetchPairs('id', 'name'))
            ->setPrompt('Zvolte', null);

        $copies = 0;
        $maxCopies = 10;

        $multiplier = $form->addMultiplier('multiplier', function (Nette\Forms\Container $container, Nette\Forms\Form $form) {

            $container->addTextArea("action", '#'.((int)$container->getName()+1).' krok')
                ->setDefaultValue('My value'); $container->addTextArea("result", 'Očekávaný výstup')
                ->setDefaultValue('My value') ->setOption('description', Html::el('p')
                    ->setHtml('Nejaky komentar. <hr>')
                );
        }, $copies, $maxCopies);

        $multiplier->addCreateButton('Přidat 1 krok',1);
        $multiplier->addCreateButton('Přidat 3 kroky',3);
        $multiplier->addCreateButton('Přidat 5 kroků',5);

        $multiplier->addRemoveButton('Odebrat krok');


        $form->addSubmit('add', 'Vložit')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'insertFormSucceeded');
        return $form;
    }

    public function insertFormSucceeded(Form $form, $values)
    {
        // ...
        $values['author_id'] = $this->getUser()->getIdentity()->id;
        $steps= $values['multiplier'];
        $this->caseModel->addCase($values, $steps);
        $this->flashMessage('Záznam byl úspěšně vložen.');


    }

    public function createComponentCategoriesGrid($name)
    {

        $grid = new DataGrid($this, $name);


        $fluent = $this->caseModel->getSets()->where('set.parent_id', null);


        $grid->setDataSource($fluent);
        try {
            $grid->setTreeView([$this, 'getChildren'], [$this, 'hasChildren']);

        } catch (DataGridException $e) {
        }


        $grid->addColumnText('name', 'Name');
        $grid->addColumnText('name2', 'Name2', 'name');
        $grid->addColumnText('id', 'Id');


        $grid->addAction('edit', '', 'edit')
            ->setIcon('edit');


    }

    public function createComponentCaseGrid($name)
    {

        $grid = new DataGrid($this, $name);


        $fluent = $this->caseModel->getCases();


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'Name');
        $grid->addColumnText('description', 'Popis');
        $grid->addColumnText('id', 'Id');


        $grid->addAction('edit', '', 'edit')
            ->setIcon('edit');
        $grid->addAction('detail', '', 'detail')
            ->setIcon('lemon');

        $grid->addAction('delete', '', 'delete!')
            ->setIcon('trash')->setConfirm('Opravdu chcete smazat test case %s?', 'name');;


    }
    public function actionDelete($id) {
        $this->caseModel->deleteCase($id);

        $this->flashMessage("Najemník byl smazán");
        $this->redirect("Case:prehled");
    }


    public function handleDelete($id) {
        $this->flashMessage('Nájemník smazán.');
        $todo = $this->caseModel;
        if ($todo) {
            $todo->deleteCase($id);
        }

        $this->redirect('this'); // this vyjadřuje aktuální presenter i view, ale bez signálu
    }
    function makeBootstrap4(Form $form)
    {
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = 'container';
        $renderer->wrappers['pair']['container'] = 'div class="form-group row"';
        $renderer->wrappers['pair']['.error'] = 'has-danger';
        $renderer->wrappers['control']['container'] = 'div class=col-sm-7';
        $renderer->wrappers['label']['container'] = 'div class="col-sm-1 col-form-label"';
        $renderer->wrappers['control']['description'] = 'span class=form-text';
        $renderer->wrappers['control']['errorcontainer'] = 'span class=form-control-feedback';
        foreach ($form->getControls() as $control) {
            $type = $control->getOption('type');
            if ($type === 'button') {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-secondary');
                $usedPrimary = false;
            } elseif (in_array($type, ['text', 'textarea', 'select'], true)) {
                $control->getControlPrototype()->addClass('form-control');
            } elseif ($type === 'file') {
                $control->getControlPrototype()->addClass('form-control-file');
            } elseif (in_array($type, ['checkbox', 'radio'], true)) {
                if ($control instanceof Nette\Forms\Controls\Checkbox) {
                    $control->getLabelPrototype()->addClass('form-check-label');
                } else {
                    $control->getItemLabelPrototype()->addClass('form-check-label');
                }
                $control->getControlPrototype()->addClass('form-check-input');
                $control->getSeparatorPrototype()->setName('div')->addClass('form-check');
            }
        }
    }


    protected function createComponentEditSetForm()
    {

        $form = new Form;
        $form->onRender[] = [$this, 'makeBootstrap4'];

        $form->addText('name', 'Název sady')->setDefaultValue($this->data['name'])->setRequired('Prosím zadejte název sady');


        $form->addSelect('parent_id', 'Nadrazena sada', $this->caseModel->notThisId($this->data['id'])->fetchPairs('id', 'name'))
            ->setPrompt('Zadna', null)->setDefaultValue($this->data['parent_id']);


        $form->addText('project_id', 'Projekt')->setDefaultValue($this->data['project_id']);
        $form->addHidden('id')->setDefaultValue($this->data['id']);

        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editSetSuccess'];

        return $form;
    }



    public function editSetSuccess(Form $form, $values)
    {
        $values = $form->getValues();


        $this->caseModel->updateSet($values);

        $this->flashMessage('Úspěšně změněny údaje.');
        $this->redirect('Case:default');

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




