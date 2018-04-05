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



    public function getCases($id)
    {
        return $this->database->table('case')->where('project_id',$id);
    }


    public function add($values)
    {
        return $this->database->table('set');
    }

    public function addCase($values, $steps)
    {
        unset($values['multiplier']);

        $this->database->table('case')->insert($values);
        $lastId = $this->database->table('case')->select('id')->order('id DESC')->limit(1)->fetch();

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
    public function updateCase($values)
    {
        $this->database->table('case')->where('id',$values['id'])->update($values);


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

    public function getStep($id)
    {
        return $this->database->table('step')->where('id',$id)->fetch();

    }

    public function addStep($values)
    {
        $lastId = $this->database->table('step')->where('case_id',$values['case_id'])->count();
        $values['sequence']= $lastId+1;

       $this->database->table('step')->insert($values);

    }
    public function updateStep($values)
    {
        return $this->database->table('step')->where('id',$values['id'])->update($values);

    }

    public function deleteStep($id)
    {
        return $this->database->table('step')->where('id',$id)->delete();

    }
    public function getAllExecutions($id)
    {
        return $this->database->query("SELECT execution.*,user.username,user.id AS ide FROM `execution` JOIN `user` on execution.run_by=user.id WHERE case_id=?",$id)->fetchAll();

    }
    public function getExecutions($id)
    {
        return $this->database->table('execution')->where('case_id',$id);
    }

    public function getCurrentCaseCategory($id)
    {
        return $this->database->query("SELECT case_category.name FROM `case` JOIN `case_category` on case.category_id=case_category.id WHERE case.id=?",$id)->fetch();

    }

    public function getCurrentAuthor($id)
    {
        return $this->database->query("SELECT user.username, user.id FROM `user` JOIN `case` on user.id=case.author_id WHERE case.id=?",$id)->fetch();

    }
    public function getCurrentSet($id)
    {
        return $this->database->query("SELECT set.name, set.id, set.parent_id FROM `set` JOIN `case` on set.id=case.set_id WHERE case.id=?",$id)->fetch();

    }

    public function deleteCase($id)
    {
        $this->database->table('step')->where('case_id',$id)->delete();
        $this->database->table('case')->where('id',$id)->delete();
    }

    public function getSets($id)
    {
        return $this->database->table('set')->where('project_id',$id);
    }


}