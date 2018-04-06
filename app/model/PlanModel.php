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
        return $this->database->table('test_plan')->where('project_id',$id)->fetchAll();
    }
    public function getPlan($id)
    {
        return $this->database->table('test_plan')->where('id',$id)->fetch();
    }


    public function addCases($ids,$id)
    {

        foreach ($ids as $i){
           $this->database->query("INSERT INTO test_plan_has_case (case_id,test_plan_id) VALUES ($i,$id)");

        }

    }
    public function deleteCases($ids,$id)
    {

        foreach ($ids as $i){
            $this->database->table('test_plan_has_case')->where('case_id=?',$i)->where('test_plan_id',$id)->delete();

        }

    }


    public function getAssignCases($id)
    {
        return $this->database->query("SELECT * FROM `case` JOIN test_plan_has_case ON case.id=test_plan_has_case.case_id WHERE test_plan_has_case.test_plan_id=?",$id)->fetchAll();
    }

}