<?php

namespace App\Presenters;

use App\Model\CaseModel;
use App\Model\ProjectModel;
use Composer\IO\NullIO;
use Nette,
    App\Model,
    Nette\Application\UI\Form;

use WebChemistry\Forms;
use AlesWita;

class DashboardPresenter extends BasePresenter
{

    /** @var CaseModel */
    private $caseModel;

    /** @var ProjectModel */
    private $projectModel;
    /** @var Nette\Http\Session */
    private $session;

    /** @var Nette\Http\SessionSection */
    private $sessionSection;

    private $data = null;


    public function __construct(CaseModel $caseModel,ProjectModel $projectModel, Nette\Http\Session $session)
    {
        $this->caseModel = $caseModel;
        $this->projectModel = $projectModel;


    }
	public function renderDefault()
	{

        $this->template->labels = ["Úspěšný","Neúspěšný","Vynechaný"];


        $this->template->series= [25,37,45];
	}



    public function createComponentSelectProjectForm() {

        $form = new Form();
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
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
        $name =  $this->projectModel->getProjectById($values['id'])->toArray();
        $sessionSection->projectName =  $name['name'];
        $this->flashMessage('Úspěšně jste zvolili projekt.');



    }
}
