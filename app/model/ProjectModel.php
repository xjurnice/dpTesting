<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class ProjectModel
{
    use Nette\SmartObject;

    /**
     * @var Nette\Database\Context
     */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function addProject($values)
    {
        return $this->database->table('project')->insert($values);
    }

    public function getProject()
    {
        return $this->database->table('project');
    }

    public function getProjectById($id)
    {
        return $this->database->table('project')->select('name')->where('id',$id)->fetch();
    }

    public function getCountCaseInProject()
    {
        return $this->database->query('SELECT count(case.id) AS c FROM `project`JOIN `case` on project.id = case.project_id group by project.id')->fetchPairs();

    }

    public function getProjectNameCaseInProject()
    {
        return $this->database->query('SELECT project.name AS c FROM `project`JOIN `case` on project.id = case.project_id group by project.id')->fetchPairs();

    }

    public function getFailedTestToProject($id)
    {
        $fail =2;
        return $this->database->query('SELECT execution.id FROM `case`JOIN `execution` on case.id = execution.case_id WHERE execution.status=? AND case.project_id=?',$fail,$id)->getRowCount();
    }

    public function getPassTestToProject($id)
    {
        $pass =1;
        return $this->database->query('SELECT execution.id FROM `case`JOIN `execution` on case.id = execution.case_id WHERE execution.status=? AND case.project_id=?',$pass,$id)->getRowCount();
    }

    public function getNumberTestPlan($id)
    {
        return $this->database->table('test_plan')->select('name')->where('project_id',$id)->count();
    }

}