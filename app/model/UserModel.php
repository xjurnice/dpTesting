<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class UserModel
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

    public function getUserInfo($id)
    {
        return $this->database->table('user')->where('id',$id)->fetch();
    }

    public function updateUser($values)
    {
        return $this->database->table('user')->where('id',$values['id'])->update($values);
    }



}