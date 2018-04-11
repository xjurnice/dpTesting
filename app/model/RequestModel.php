<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class RequestModel
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


    public function getRequests($id)
    {
        return $this->database->table('request')->where('project_id',$id);
    }

    public function addRequest($values)
    {
        return $this->database->table('request')->insert($values);
    }




}