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

    public function addExecution($values)
    {

        if($values['test_plan_id']==null)
        {
            unset($values['test_plan_id']);
        }


      $this->database->table('execution')->insert($values);

        //event
        $val = [];
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
    public function getAllExecutions($id)
    {
        return $this->database->query("SELECT execution.*, set_id,category_id, case.name FROM `execution` JOIN `case` on execution.case_id=case.id WHERE case.project_id=?",$id)->fetchAll();

    }

}