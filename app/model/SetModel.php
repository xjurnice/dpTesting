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

    public function getSets($id)
    {
        return $this->database->table('set')->where('project_id', $id);
    }

    public function findById($id)
    {
        return $this->database->table('set')->where('id', $id)->fetch();
    }

    public function notThisId($id, $project)
    {
        return $this->database->table('set')->where('id <> ? ', $id)->where('project_id', $project);
    }

    public function updateSet($values)
    {
        return $this->database->table('set')->where('id', $values['id'])->update($values);
    }

    public function addSet($values)
    {
        return $this->database->table('set')->insert($values);
    }

    public function getTreeSet($id)
    {
        $result = null;
        while ($id != null) {
            $result = $this->database->table('set')->where('id', $id)->fetch();
            $id = $this->database->table('set')->select('id')->where('parent_id', $id)->fetch();
        }
        return $id;
    }


}