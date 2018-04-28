<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class ExecutionModel
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

    public function addExecution($values, $project)
    {

        if ($values['test_plan_id'] == null) {
            unset($values['test_plan_id']);
        }


        $this->database->table('execution')->insert($values);

        //event
        $val = [];
        $val['project_id'] = $project;
        $val['user_id'] = $values['run_by'];
        $val['object_id'] = $values['case_id'];
        $val['event_type_id'] = 3;
        $val['event_time'] = new \Nette\Utils\DateTime();

        $this->database->table('event')->insert($val);

    }

    public function getExecution()
    {
        return $this->database->table('execution');
    }

    public function getExecutionByID($id)
    {
        return $this->database->table('execution')->where('id',$id)->fetch();
    }
    public function getExecutionAuthor($id)
    {
        return $this->database->query('SELECT username, user.id FROM user JOIN execution ON user.id=execution.run_by WHERE execution.id=?',$id)->fetch();
    }

    public function getExecutionPlan($id)
    {
        return $this->database->query('SELECT name, test_plan.id FROM test_plan JOIN execution ON test_plan.id=execution.test_plan_id WHERE execution.id=?',$id)->fetch();
    }


    public function getExecutionPass($id)
    {
        return $this->database->table('execution')->select('number_pass')->where('id',$id)->fetchField('number_pass');
    }

    public function getExecutionFail($id)
    {
        return $this->database->table('execution')->select('number_defect')->where('id',$id)->fetchField('number_defect');

    }

    public function getExecutionSkip($id)
    {
        return $this->database->table('execution')->select('number_skip')->where('id',$id)->fetchField('number_skip');
    }

    public function getAllExecutions($id)
    {
        return $this->database->query("SELECT execution.*, set_id,category_id, case.name FROM `execution` JOIN `case` on execution.case_id=case.id WHERE case.project_id=?", $id)->fetchAll();

    }

    public function addDefect($values)
    {

        $lastID = $this->database->table('execution')->select('id')->order('ID DESC')->limit(1)->fetch();
        $values['execution_id'] = $lastID['id'] + 1;
        $this->database->table('execution_step')->insert($values);

    }

    public function getDefects($id)
    {

        return $this->database->query('SELECT result,action,a.description FROM step LEFT JOIN (SELECT description,step.id FROM step LEFT JOIN execution_step on step.id=execution_step.step_id 
WHERE execution_id=? ORDER BY sequence) AS a ON step.id = a.id JOIN execution on step.case_id=execution.case_id WHERE execution.id=? GROUP BY step.id ORDER BY sequence
', $id, $id)->fetchAll();
    }

}