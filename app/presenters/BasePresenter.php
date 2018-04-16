<?php

namespace App\Presenters;

use App\Model\EventModel;
use Nette;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var EventModel */
    public $eventModel;

    private $acl = null;

    public function renderLayout(){

       $this->template->neco = 'a';
    }

    public function __construct(EventModel $eventModel)
    {

        $this->eventModel = $eventModel;

    }
    public function startup() {
        parent::startup();


        if (!$this->getUser()->isLoggedIn()) {
            if ($this->name != "Sign" && $this->action != "in") {

                $this->flashMessage("Musíte se přihlásit!");
                $this->redirect("Sign:in");
            }
        }else {
            $this->acl = new \AclModel();
            $roles = $this->getUser()->getRoles();
            $role = array_shift($roles);
            if (!$this->acl->isAllowed($role, strtolower($this->name), $this->action)) {

                $this->flashMessage("Nemáš oprávnění");
                $this->redirect("Dashboard:default");
            }
        }

    }


    public function handleModal($modalId)
    {
        $this->template->modal = $modalId;
        $this->redrawControl('modal');
    }
    protected function beforeRender() {
        $this->template->project = $this->getSession('sekcePromenna')->project;

    }

}
