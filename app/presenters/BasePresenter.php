<?php

namespace App\Presenters;

use App\Model\EventModel;
use Nette;
use AlesWita;
use Nette\Application\UI\Form;
use WebChemistry\Forms;
use App\Model;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var EventModel */
    public $eventModel;

    private $acl = null;

    public function renderLayout()
    {

        $this->template->neco = 'a';
    }

    public function __construct(EventModel $eventModel)
    {

        $this->eventModel = $eventModel;

    }

    public function startup()
    {
        parent::startup();


        if (!$this->getUser()->isLoggedIn()) {
            if ($this->name != "Sign" && $this->action != "in") {

                $this->flashMessage("Musíte se přihlásit!");
                $this->redirect("Sign:in");
            }
        } else {
            $this->acl = new \AclModel();
            $roles = $this->getUser()->getRoles();
            $role = array_shift($roles);
            if (!$this->acl->isAllowed($role, strtolower($this->name), $this->action)) {

                $this->flashMessage("Nemáš oprávnění");
                $this->redirect("Dashboard:default");
            }
        }

    }


    public function createComponentSelectProjectForm()
    {

        $form = new Form();
        $form->addProtection(); // Add "Reload form for safe submit, Form was expired."
        $project = [];
        $project = [0 => 'Zvolte projekt'] + $this->eventModel->getProject($this->getUser()->getIdentity()->id)->fetchPairs('id', 'name');
        $form->addSelect('id', '', $project)->setDefaultValue($this->getSession('sekcePromenna')->project);
        $form->addSubmit('edit', 'Vyber')->getControlPrototype()->setClass('btn');


        $form->onSuccess[] = array($this, "changeProjectSuccess");

        return $form;
    }

    public function changeProjectSuccess(Form $form, $values)
    {
        $values = $form->getValues();
        $session = $this->getSession();
        $sessionSection = $session->getSection('sekcePromenna');
        $sessionSection->project = $values['id'];

        $this->flashMessage('Úspěšně jste zvolili projekt.');


    }

    public function handleModal($modalId)
    {
        $this->template->modal = $modalId;
        $this->redrawControl('modal');
    }


    protected function beforeRender()
    {
        $this->template->project = $this->getSession('sekcePromenna')->project;
        $this->template->projectActive = $this->eventModel->isProjectActive($this->getSession('sekcePromenna')->project);

    }

}
