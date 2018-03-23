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

    public function getCases()
    {
        return $this->database->table('case');
    }
    public function findById($id)
    {
        return $this->database->table('set')->where('id',$id)->fetch();
    }

    public function notThisId($id)
    {
        return $this->database->table('set')->where('id <> ? ',$id);
    }



    public function add($values)
    {
        return $this->database->table('set');
    }

    public function updateSet($values)
    {
        return $this->database->table('set')->where('id',$values['id'])->update($values);
    }
    public function addCase($values, $steps)
    {
        unset($values['multiplier']);

        $this->database->table('case')->insert($values);
      $lastId = $this->database->table('case')->count();

        if(sizeof($steps)>0)
        {
        $iterator =1;
        foreach ($steps as $step){
            $step['case_id'] = $lastId;
            $step['sequence'] = $iterator++;

            $this->database->table('step')->insert($step);
        }

        }

    }

    public function getCaseCategory()
    {
        return $this->database->table('case_category');
    }
    public function getProject()
    {
        return $this->database->table('project');
    }
    public function getCase($id)
    {
        return $this->database->table('case')->where('id',$id)->fetch();

    }

    public function getAllSteps($id)
    {
        return $this->database->table('step')->where('case_id',$id)->order('sequence')->fetchAll();

    }


    public function deleteCase($id)
    {
        $this->database->table('step')->where('case_id',$id)->delete();
     $this->database->table('case')->where('id',$id)->delete();
    }
}