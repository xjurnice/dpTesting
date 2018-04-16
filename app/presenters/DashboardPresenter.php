<?php

namespace App\Presenters;

use App\Model\CaseModel;
use App\Model\EventModel;
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


    /** @var EventModel */
    public $eventModel;

    /** @var ProjectModel */
    private $projectModel;
    /** @var Nette\Http\Session */
    private $session;

    /** @var Nette\Http\SessionSection */
    private $sessionSection;

    private $data = null;


    public function __construct(CaseModel $caseModel, ProjectModel $projectModel, Nette\Http\Session $session,Model\EventModel $eventModel)
    {
        parent::__construct($eventModel);

        $this->caseModel = $caseModel;
        $this->projectModel = $projectModel;


    }

    public function renderDefault()
    {
        $project =$this->getSession('sekcePromenna')->project;
        $names = $this->projectModel->getProjectNameCaseInProject();

        $this->template->labels = $names;

        $number = $this->projectModel->getCountCaseInProject();
//dump($number);
        $this->template->series = $number;

        $this->template->events = $this->eventModel->getEvents();

        $this->template->defect = $this->projectModel->getFailedTestToProject($project);
        $this->template->sucess = $this->projectModel->getPassTestToProject($project);
        $this->template->skip = $this->projectModel->getSkipeedTestToProject($project);

        $this->template->plan = $this->projectModel->getNumberTestPlan($project);
        $this->template->sumTime = $this->projectModel->getSumTimByProject($project);

        $this->template->seriesTesters = $this->projectModel->getNumberExecutionByTester($project);
        $this->template->sumTimeTesters = $this->projectModel->getSumTimeTesterByExe($project);
        $this->template->labelsTesters = $this->projectModel->getNameTesterByExe($project);

    }

    public function renderAll()
    {

        $this->template->events = $this->eventModel->getAllEvents();

    }
    public function createComponentSelectProjectForm()
    {

        $form = new Form();
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);
        $form->addProtection(); // Add "Reload form for safe submit, Form was expired."
        $project = [];
        $project = ['' => 'zadny'] + $this->caseModel->getProject($this->getUser()->getIdentity()->id)->fetchPairs('id', 'name');
        $form->addSelect('id', '', $project )->setDefaultValue($this->getSession('sekcePromenna')->project);
        $form->addSubmit('edit', 'Vyber')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');


        $form->onSuccess[] = array($this, "changeProjectSuccess");

        return $form;
    }

    public function changeProjectSuccess(Form $form, $values)
    {
        $values = $form->getValues();
        $session = $this->getSession();
        $sessionSection = $session->getSection('sekcePromenna');
        $sessionSection->project = $values['id'];
        $name = $this->projectModel->getProjectById($values['id'])->toArray();
        $sessionSection->projectName = $name['name'];
        $this->flashMessage('Úspěšně jste zvolili projekt.');


    }
}
