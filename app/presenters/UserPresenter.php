<?php

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form;
use App\Model\UserModel;



class UserPresenter extends BasePresenter
{

    /** @var UserModel */
    private $userModel;
    private $data = null;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function renderEdit()
    {
        $this -> data = $this->userModel->getUserInfo($this->getUser()->getIdentity()->id);
    }


    function makeBootstrap4(Form $form)
    {
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = 'container';
        $renderer->wrappers['pair']['container'] = 'div class="form-group row"';
        $renderer->wrappers['pair']['.error'] = 'has-danger';
        $renderer->wrappers['control']['container'] = 'div class=col-sm-9';
        $renderer->wrappers['label']['container'] = 'div class="col-sm-3 col-form-label"';
        $renderer->wrappers['control']['description'] = 'span class=form-text';
        $renderer->wrappers['control']['errorcontainer'] = 'span class=form-control-feedback';
        foreach ($form->getControls() as $control) {
            $type = $control->getOption('type');
            if ($type === 'button') {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-secondary');
                $usedPrimary = true;
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

    protected function createComponentEditMemberForm()
    {

        $form = new Form;
        $form->onRender[] = [$this, 'makeBootstrap4'];
        $form->addText('username', 'Login')->setDefaultValue($this->data['username'])->setRequired('Prosím zadejte login');
        $form->addText('name', 'Name')->setDefaultValue($this->data['name']);
        $form->addText('surname', 'Surname')->setDefaultValue($this->data['surname']);
        $form->addText('email', 'E-mail')->setDefaultValue($this->data['email'])->addRule(Form::EMAIL, 'E-mail format is incorrect.')->setRequired('Prosím zadejte email');
        $form->addHidden('id')->setDefaultValue($this->data['id']);
        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editMemberSuccess'];

        return $form;
    }



    public function editMemberSuccess(Form $form, $values)
    {
        $values = $form->getValues();


        $this->userModel->updateUser($values);

        $this->flashMessage('Úspěšně změněny údaje.');
        $this->redirect('User:edit');

    }
}