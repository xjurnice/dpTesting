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

    public function getAllExecutions($id)
    {
        return $this->database->query("SELECT execution.*,user.username,user.id AS ide FROM `execution` JOIN `user` on execution.run_by=user.id JOIN `project` WHERE project.id=?",$id)->fetchAll();

    }

}