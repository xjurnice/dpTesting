<?php

namespace App\Model;

use Nette;

class CaseModel
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

    public function getSets()
    {
        return $this->database->table('set');
    }

    public function updateUser($values)
    {
        return $this->database->table('user')->where('id',$values['id'])->update($values);
    }



}