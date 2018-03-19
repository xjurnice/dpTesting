<?php

namespace App\Presenters;

use Nette;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    private $acl = null;


    public function startup() {
        parent::startup();


        if (!$this->getUser()->isLoggedIn()) {
            if ($this->name != "Sign" && $this->action != "in") {

                $this->flashMessage("Musíte se přihlásit!");
                $this->redirect("Sign:in");
            }}

    }



    protected function beforeRender() {

    }

}
