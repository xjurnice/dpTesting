<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class PlanModel
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


    public function getUsers()
    {
        return $this->database->table('user');
    }

    public function addPlan($values)
    {
        return $this->database->table('test_plan')->insert($values);
    }


    public function getTestersInProject($project)
    {
        $role = 3; //testers
        return $this->database->query('SELECT id, username from user JOIN project_has_user ON user.id=project_has_user.user_id WHERE project_id=? 
AND role_id=?', $project, $role)->fetchPairs('id', 'username');
    }

    public function editPlan($values)
    {
        return $this->database->table('test_plan')->where('id=?', $values['id'])->update($values);
    }


    public function getPlans($id)
    {
        return $this->database->table('test_plan')->where('project_id', $id)->fetchAll();
    }

    public function getPlan($id)
    {
        return $this->database->table('test_plan')->where('id', $id)->fetch();
    }


    public function addCases($ids, $id)
    {
        $lastId = $this->database->table('test_plan_has_case')->select('sequence')->where('test_plan_id', $id)
            ->max('sequence');

        if ($lastId == null) {
            $sequence = 1;

        } else {
            $sequence = (int)$lastId + 1;
        }

        foreach ($ids as $i) {
            $this->database->query("INSERT INTO test_plan_has_case (case_id,test_plan_id,sequence) VALUES ($i,$id,$sequence)");
            $sequence++;
        }
        $status = 0; //0 mean in creation status
        $this->database->query('UPDATE test_plan SET status=? WHERE id=? ', $status, $id);
    }

    public function deleteCases($ids, $id)
    {

        foreach ($ids as $i) {
            $this->database->table('test_plan_has_case')->where('case_id=?', $i)->where('test_plan_id', $id)->delete();
            $this->database->table('execution')->where('case_id=?', $i)->where('test_plan_id', $id)->delete();


        }

    }


    public function getAssignCases($id)
    {
        return $this->database->query("SELECT DISTINCT case.id, case.name, case.set_id, a.id as exe_id  FROM `case` JOIN test_plan_has_case ON case.id=test_plan_has_case.case_id 
LEFT JOIN (SELECT execution.id, execution.case_id as ids FROM execution JOIN `test_plan_has_case` ON execution.test_plan_id=test_plan_has_case.test_plan_id WHERE execution.test_plan_id=?)
 AS a ON case_id=a.ids
WHERE test_plan_has_case.test_plan_id=? 
ORDER BY sequence", $id, $id)->fetchAll();
    }

    public function getAssignCasesCount($id)
    {
        return $this->database->query("SELECT * FROM `case` JOIN test_plan_has_case ON case.id=test_plan_has_case.case_id WHERE test_plan_has_case.test_plan_id=? 
ORDER BY sequence", $id)->getRowCount();
    }

    public function getProcessCaseCount($id)
    {
        return $this->database->table('execution')->where('test_plan_id', $id)->count();
    }


    public function getCasesNotInPlanYet($id, $test_plan_id)
    {
        $ids = $this->database->table('test_plan_has_case')->select('case_id')->where('test_plan_id', $test_plan_id);

        return $this->database->table('case')->where('project_id', $id)->where('NOT (id ?)', $ids);
    }


    public function getFirstCase($id)
    {

        return $this->database->table('test_plan_has_case')->where('test_plan_id', $id)
            ->order('sequence')->limit(1)->fetch();

    }

    public function getNextCase($id)
    {
        $runned = $this->database->query('SELECT case_id FROM execution WHERE test_plan_id=?', $id)->fetchAll();

        $arr = [];
        $iterator = 0;
        foreach ($runned as $r) {
            $arr[$iterator] = $r->case_id;
            $iterator++;
        }
        if (sizeof($arr) == 0) {
            $arr = null;
        }

        return $this->database->query("SELECT id FROM `case` JOIN test_plan_has_case ON case.id=test_plan_has_case.case_id WHERE (test_plan_has_case.test_plan_id=?)
 AND (id NOT IN (?)) 
 ORDER BY sequence LIMIT 1", $id, $arr)->fetch();


    }

    public function setTestPlanFinished($id, $value)
    {

        return $this->database->table('test_plan')->where('id', $id)
            ->update($value);

    }

    public function getCountExecution($id)
    {

        return $this->database->table('execution')->where('test_plan_id', $id);

    }

    public function getTimeOfExecution($id)
    {

        return $this->database->query('SELECT (spend_time/60) FROM `execution` WHERE test_plan_id=? ', $id)->fetchPairs();

    }

    public function getNameOfExecution($id)
    {

        return $this->database->query('SELECT name FROM `execution` JOIN `case` ON execution.case_id=case.id  WHERE test_plan_id=? ', $id)->fetchPairs();

    }

    public function getUserForTestPlan($id)
    {

        return $this->database->query('SELECT user.* FROM `user` JOIN `test_plan` ON user.id=test_plan.assign_user_id  WHERE test_plan.id=? ', $id)->fetch();

    }

    public function deletePlan($id)
    {
        $this->database->table('execution')->where('test_plan_id', $id)->delete(); // all execution
        $this->database->table('test_plan_has_case')->where('test_plan_id', $id)->delete(); //all association plan and case
        $this->database->table('test_plan')->where('id', $id)->delete(); // finally test plan

    }

    public function isAnyCaseInPlanExist($id)
    {
        if (!empty($this->database->query('SELECT name FROM `execution` JOIN `case` ON execution.case_id=case.id  WHERE test_plan_id=?', $id)->fetchAll())) {

            return 1;
        } else {
            return 0;
        }
    }
}