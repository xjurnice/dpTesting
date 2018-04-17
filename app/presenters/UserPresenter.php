<?php

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form;
use App\Model\UserModel;
use Ublaboo\DataGrid\DataGrid;
use AlesWita;


class UserPresenter extends BasePresenter
{

    /** @var UserModel */
    private $userModel;
    private $data = null;
    /** @persistent */
    public $id;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function renderEdit()
    {
        $this->template->userdata = $this->userModel->getUserInfo($this->getUser()->getIdentity()->id);
        $this->data = $this->userModel->getUserInfo($this->getUser()->getIdentity()->id);
    }

    public function renderProfile($id)
    {
        $this->id = $id;
        $this->template->userdata = $this->userModel->getUserInfo($id);

    }

    public function renderManagement()
    {
        $this->template->userdata = $this->userModel->getUsers();

    }

    public function handleAssign()
    {

        parent::handleModal('add');
    }

    public function handleDelete()
    {

        parent::handleModal('delete');
    }

    public function handleEditPass()
    {

        parent::handleModal('editPass');
    }


    public function createComponentAssignToProjectGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->userModel->getNotAssignProjects($this->id);


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'name', '');


        $grid->addGroupAction('Přidat')->onSelect[] = [$this, 'addSelectedProject'];


    }
    public function createComponentDeleteAssignToProjectGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->userModel->getAssignProjects($this->id);


        $grid->setDataSource($fluent);


        $grid->addColumnText('name', 'name', '');


        $grid->addGroupAction('Odebrat')->onSelect[] = [$this, 'deleteSelectedProject'];


    }
    public function addSelectedProject(array $ids)
    {

        $this->userModel->addProjectsToUser($ids, $this->id);


        $this->flashMessage('Záznam byl úspěšně přidán.');

        $this['assignToProjectGrid']->reload();

        $this->redirect('this');

    }

    public function deleteSelectedProject(array $ids)
    {

        $this->userModel->deleteProjectsToUser($ids, $this->id);


        $this->flashMessage('Záznam byl úspěšně odebrán.');

        $this['assignToProjectGrid']->reload();

        $this->redirect('this');

    }
    public function createComponentUsersGrid($name)
    {

        $grid = new DataGrid();
        $this->addComponent($grid, $name);


        $fluent = $this->userModel->getUsers()->fetchAll();
        $grid->addColumnLink('link', 'Uživatel', 'User:profile', 'username', ['id'])
            ->addAttributes(['class' => 'text-center font-weight-bold'])->setSortable();


        $grid->setDataSource($fluent);
        $grid->addColumnStatus('role_id', 'Uživatelská role (skupina)')
            ->setCaret(false)
            ->addOption(1, 'registrovanný uživatel')
            ->setIcon('users')
            ->setClass('btn-success')
            ->endOption()
            ->addOption(2, 'administrátor')
            ->setIcon('users')
            ->setClass('btn-danger')
            ->endOption()
            ->addOption(3, 'tester')
            ->setIcon('users')
            ->setClass('btn-info')
            ->endOption()
            ->addOption(4, 'zákazník')
            ->setIcon('users')
            ->setClass('btn-warning')
            ->endOption()->onChange[] = [$this, 'roleChange'];

        $grid->addColumnText('id', 'Přiřazené projekty')
            ->setRenderer(function ($item) {
                $projects = $this->userModel->getAssignProjectToUser($item->id);
                //dump($projects);
                $projectString = '';
                foreach ($projects as $project) {
                    $projectString = $projectString . ' ' . $project . ', ';
                }
                return $projectString ;
            })->addAttributes(['class' => 'text-center font-weight-bold']);


        $grid->addAction('assign', 'Přiřadit další projekt', 'assign!', ['id'])->setIcon('plus-circle')->setClass('btn btn-xs btn-success ajax');
        $grid->addAction('delete', 'Odebrat přiřazené projekty', 'delete!', ['id'])->setIcon('minus-circle')->setClass('btn btn-xs btn-danger ajax');



    }

    public function roleChange($id, $new_status)
    {
        if (in_array($new_status, [1, 2, 3, 4])) {
            $this->userModel->getUsers()->where('id = ?', $id)
                ->update(['role_id' => $new_status]);
        }


        $this->flashMessage("Role byla úspěšně změněna");
        $this->redirect("this");

    }

    protected function createComponentEditMemberForm()
    {

        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addHidden('create_time')->setDefaultValue($this->data['create_time']);
        $form->addText('username', 'Login')->setDefaultValue($this->data['username'])->setRequired('Prosím zadejte login');
        $form->addText('name', 'Jméno')->setDefaultValue($this->data['name']);
        $form->addText('surname', 'Příjmení')->setDefaultValue($this->data['surname']);
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


    protected function createComponentEditPassForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection();

        $form->addPassword('password', 'Nové heslo', 20)
            ->setOption('description', 'Alespoň 6 znaků')
            ->addRule(Form::FILLED, 'Vyplňte Vaše heslo')
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 6);
        $form->addPassword('password2', 'Nové heslo znovu', 20)
            ->addConditionOn($form['password'], Form::VALID)
            ->addRule(Form::FILLED, 'Heslo znovu')
            ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['password']);

        $form->addHidden('id')->setDefaultValue($this->getUser()->getIdentity()->id);
        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editPassSuccess'];
        return $form;
    }

    public function editPassSuccess(Form $form, $values)
    {

        $this->userModel->editPass($values);

        $this->flashMessage('Úspěšně změněny údaje.');
        $this->redirect('User:edit');

    }
}