<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class SettingModel
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

    public function getCaseCategory()
    {
        return $this->database->table('case_category')->fetchAll();
    }

    public function addCategory($values)
    {
        return $this->database->table('case_category')->insert($values);
    }

    public function updateCategory($values)
    {
        return $this->database->table('case_category')->where('id', $values['id'])->update($values);
    }

    public function getCategoryID($id)
    {
        return $this->database->table('case_category')->where('id', $id)->fetch();
    }


}