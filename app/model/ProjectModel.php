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
        return $this->database->table('project')->select('name')->where('id', $id)->fetch();
    }

    public function getCountCaseInProject()
    {
        return $this->database->query('SELECT count(case.id) AS c FROM `project`JOIN `case` on project.id = case.project_id group by project.id')->fetchPairs();

    }

    public function getProjectNameCaseInProject()
    {
        return $this->database->query('SELECT project.name AS c FROM `project`JOIN `case` on project.id = case.project_id group by project.id')->fetchPairs();

    }
    public function getSkipeedTestToProject($id)
    {
        $skip = 3;
        return $this->database->query('SELECT execution.id FROM `case`JOIN `execution` on case.id = execution.case_id WHERE execution.status=? AND case.project_id=?', $skip, $id)->getRowCount();
    }

    public function getFailedTestToProject($id)
    {
        $fail = 2;
        return $this->database->query('SELECT execution.id FROM `case`JOIN `execution` on case.id = execution.case_id WHERE execution.status=? AND case.project_id=?', $fail, $id)->getRowCount();
    }

    public function getPassTestToProject($id)
    {
        $pass = 1;
        return $this->database->query('SELECT execution.id FROM `case`JOIN `execution` on case.id = execution.case_id WHERE execution.status=? AND case.project_id=?', $pass, $id)->getRowCount();
    }

    public function getNumberTestPlan($id)
    {
        return $this->database->table('test_plan')->select('name')->where('project_id', $id)->count();
    }

    public function getNumberExecutionByTester($id)
    {
        return $this->database->query('SELECT COUNT(execution.id) FROM `execution` JOIN `case` ON execution.case_id=case.id WHERE case.project_id=? GROUP BY run_by ORDER BY run_by', $id)->fetchPairs();
    }

    public function getNameTesterByExe($id)
    {
        return $this->database->query('SELECT DISTINCT(user.username) FROM (`user` JOIN `execution` on user.id = execution.run_by) LEFT JOIN `case` ON execution.case_id=case.id WHERE case.project_id=? ORDER BY user.id', $id)->fetchPairs();

    }
    public function getSumTimeTesterByExe($id)
    {
        return $this->database->query('SELECT SUM(spend_time)/60 FROM (`user` JOIN `execution` on user.id = execution.run_by) LEFT JOIN `case` ON execution.case_id=case.id WHERE case.project_id=? GROUP BY run_by ORDER BY user.id', $id)->fetchPairs();

    }
    public function getSumTimByProject($id)
    {
        return $this->database->query('SELECT SUM(spend_time)/60 AS s FROM  `execution` JOIN `case` ON execution.case_id=case.id WHERE case.project_id=?', $id)->fetch();

    }

}