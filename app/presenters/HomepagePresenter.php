<?php

namespace App\Presenters;

use App\Model\CaseModel;
use Composer\IO\NullIO;
use Nette,
    App\Model,
    Nette\Application\UI\Form;

use WebChemistry\Forms;
use AlesWita;

class HomepagePresenter extends BasePresenter
{

    /** @var CaseModel */
    private $caseModel;
    /** @var Nette\Http\Session */
    private $session;

    /** @var Nette\Http\SessionSection */
    private $sessionSection;

    private $data = null;


    public function __construct(CaseModel $caseModel, Nette\Http\Session $session)
    {
        $this->caseModel = $caseModel;

    }
	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}



    public function createComponentSelectProjectForm() {

        $form = new Form();
        $form->addProtection(); // Add "Reload form for safe submit, Form was expired."
        $form->addSelect('id', '', $this->caseModel->getProject()->fetchPairs('id', 'name'))->setDefaultValue($this->getSession('sekcePromenna')->project);
        $form->addSubmit('edit', 'Vyber')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');


        $form->onSuccess[] = array($this, "changeProjectSuccess");

        return $form;
    }

    public function changeProjectSuccess(Form $form, $values)
    {
        $values = $form->getValues();
        $session = $this->getSession();
        $sessionSection = $session->getSection('sekcePromenna');
        $sessionSection->project =  $values['id'];
        $this->flashMessage('Úspěšně jste zvolili projekt.');



    }
}
