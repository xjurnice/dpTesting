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
        return $this->database->table('execution')->insert($values);
    }

    public function getExecution()
    {
        return $this->database->table('execution');
    }
    public function getAllExecutions($id)
    {
        return $this->database->query("SELECT execution.*, case.name FROM `execution` JOIN `case` on execution.case_id=case.id WHERE case.project_id=?",$id)->fetchAll();

    }

}