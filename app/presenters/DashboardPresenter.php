<?php

namespace App\Presenters;

use AlesWita;
use App\Model;
use App\Model\CaseModel;
use App\Model\EventModel;
use App\Model\ProjectModel;
use Nette;
use Nette\Application\UI\Form;
use WebChemistry\Forms;

class DashboardPresenter extends BasePresenter
{

    /** @var CaseModel */
    private $caseModel;


    /** @var EventModel */
    public $eventModel;

    /** @var ProjectModel */
    public $projectModel;
    /** @var Nette\Http\Session */
    private $session;

    /** @var Nette\Http\SessionSection */
    private $sessionSection;

    private $data = null;


    public function __construct(CaseModel $caseModel, ProjectModel $projectModel, Nette\Http\Session $session, Model\EventModel $eventModel)
    {
        parent::__construct($eventModel);

        $this->caseModel = $caseModel;
        $this->projectModel = $projectModel;


    }

    public function renderDefault()
    {
        $project = $this->getSession('sekcePromenna')->project;

        if ($project == 0) {

            $project = '';
        }
        $names = $this->projectModel->getProjectNameCaseInProject($this->getUser()->getIdentity()->id);

        $this->template->labels = $names;

        $number = $this->projectModel->getCountCaseInProject($this->getUser()->getIdentity()->id);
//dump($number);
        $this->template->series = $number;

        $this->template->projectActive = $this->projectModel->isProjectActive($project);
        $this->template->events = $this->eventModel->getEvents($project);

        $this->template->defect = $this->projectModel->getFailedTestToProject($project);
        $this->template->sucess = $this->projectModel->getPassTestToProject($project);
        $this->template->skip = $this->projectModel->getSkipeedTestToProject($project);
        $this->template->users = $this->projectModel->getUsersToProject($project);

        $this->template->plan = $this->projectModel->getNumberTestPlan($project);
        $this->template->sumTime = $this->projectModel->getSumTimByProject($project);

        $this->template->seriesTesters = $this->projectModel->getNumberExecutionByTester($project);
        $this->template->sumTimeTesters = $this->projectModel->getSumTimeTesterByExe($project);
        $this->template->labelsTesters = $this->projectModel->getNameTesterByExe($project);
        $this->template->plansUser = $this->projectModel->getTestPlanForUser($project,$this->getUser()->getIdentity()->id);
        $this->template->request = $this->projectModel->getRequests($project);


    }

    public function renderAll()
    {

        $this->template->events = $this->eventModel->getAllEvents($this->getSession('sekcePromenna')->project);

    }


}
