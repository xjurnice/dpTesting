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
        $this->database->query('UPDATE test_plan SET status=? WHERE id=? ',$status,$id);
    }

    public function deleteCases($ids, $id)
    {

        foreach ($ids as $i) {
            $this->database->table('test_plan_has_case')->where('case_id=?', $i)->where('test_plan_id', $id)->delete();

        }

    }


    public function getAssignCases($id)
    {
        return $this->database->query("SELECT * FROM `case` JOIN test_plan_has_case ON case.id=test_plan_has_case.case_id WHERE test_plan_has_case.test_plan_id=? 
ORDER BY sequence", $id)->fetchAll();
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

}