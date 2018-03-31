<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class SetModel
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
    public function findById($id)
    {
        return $this->database->table('set')->where('id',$id)->fetch();
    }

    public function notThisId($id)
    {
        return $this->database->table('set')->where('id <> ? ',$id);
    }
    public function updateSet($values)
    {
        return $this->database->table('set')->where('id',$values['id'])->update($values);
    }

}