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
        return $this->database->table('case')->where('project_id', $id);
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
        //event
        $val = [];
        $val['user_id'] = $values['author_id'];
        $val['project_id'] = $values['project_id'];
        $val['object_id'] = $lastId;
        $val['event_type_id'] = 2;
        $val['event_time'] = new \Nette\Utils\DateTime();

        $this->database->table('event')->insert($val);


        if (sizeof($steps) > 0) {
            $iterator = 1;
            foreach ($steps as $step) {
                $step['case_id'] = $lastId;
                $step['sequence'] = $iterator++;

                $this->database->table('step')->insert($step);
            }

        }

    }

    public function updateCase($values)
    {
        $this->database->table('case')->where('id', $values['id'])->update($values);


    }

    public function getCaseCategory()
    {
        return $this->database->table('case_category');
    }

    public function getProject($user_id)
    {
        return $this->database->query('SELECT project.id, project.name FROM project JOIN project_has_user ON project.id=project_has_user.project_id WHERE user_id=?', $user_id);
    }


    public function getCase($id)
    {
        return $this->database->table('case')->where('id', $id)->fetch();

    }


    public function getAllSteps($id)
    {
        return $this->database->query("SELECT * FROM step WHERE case_id=?", $id)->fetchAll();

    }

    public function getStep($id)
    {
        return $this->database->table('step')->where('id', $id)->fetch();

    }

    public function addStep($values)
    {
        $lastId = $this->database->table('step')->where('case_id', $values['case_id'])->count();
        $values['sequence'] = $lastId + 1;

        $this->database->table('step')->insert($values);

    }

    public function addNote($values)
    {

        $this->database->table('step')->update($values);

    }


    public function updateStep($values)
    {
        return $this->database->table('step')->where('id', $values['id'])->update($values);

    }

    public function deleteStep($id)
    {
        $this->database->table('execution_step')->where('step_id', $id)->delete();
        return $this->database->table('step')->where('id', $id)->delete();

    }

    public function getAllExecutions($id)
    {
        return $this->database->query("SELECT execution.*,user.username,user.id AS ide FROM `execution` JOIN `user` on execution.run_by=user.id WHERE case_id=?", $id)->fetchAll();

    }

    public function getAllTestPlans($id, $project)
    {
        return $this->database->query("SELECT test_plan.* FROM `test_plan` JOIN `test_plan_has_case` on test_plan.id=test_plan_has_case.test_plan_id WHERE case_id=? AND project_id=?", $id, $project)->fetchAll();

    }

    public function getTestPlan($id)
    {
        return $this->database->table('test_plan')->where('project_id', $id);
    }

    public function getUsers($id)
    {
        return $this->database->query('SELECT username, user.id FROM user JOIN project_has_user on user.id=project_has_user.user_id WHERE project_id=?', $id);
    }


    public function getExecutions($id)
    {
        return $this->database->table('execution')->where('case_id', $id);
    }

    public function getCurrentCaseCategory($id)
    {
        return $this->database->query("SELECT case_category.name FROM `case` JOIN `case_category` on case.category_id=case_category.id WHERE case.id=?", $id)->fetch();

    }

    public function getCurrentAuthor($id)
    {
        return $this->database->query("SELECT user.username, user.id FROM `user` JOIN `case` on user.id=case.author_id WHERE case.id=?", $id)->fetch();

    }

    public function getCurrentSet($id)
    {
        return $this->database->query("SELECT set.name, set.id, set.parent_id FROM `set` JOIN `case` on set.id=case.set_id WHERE case.id=?", $id)->fetch();

    }

    public function deleteCase($id)
    {
        $event_type = [2, 3, 4];
        $this->database->table('event')->where('event_type_id IN (?) AND object_id=?', $event_type, $id)->delete();
        $this->database->table('test_plan_has_case')->where('case_id', $id)->delete();
        $this->database->table('execution_step')->where('case_id', $id)->delete();
        $this->database->table('execution')->where('case_id', $id)->delete();
        $this->database->table('step')->where('case_id', $id)->delete();
        $this->database->table('case')->where('id', $id)->delete();

    }

    public function getSets($id)
    {
        return $this->database->table('set')->where('project_id', $id);
    }


    public function updateCaseStatus($ids, $status, $user, $project)
    {

        foreach ($ids as $i) {
            $this->database->query("UPDATE `case` SET status=? WHERE id=?", $status, $i);

            $event_type = 4;

            $this->database->query('INSERT into event (user_id,object_id,event_type_id,project_id) VALUES (?,?,?,?)', $user, $i, $event_type, $project);

        }

    }

    public function caseUpdateEvent($user, $i, $project)
    {


        $event_type = 4;

        $this->database->query('INSERT into event (user_id,object_id,event_type_id,project_id) VALUES (?,?,?,?)', $user, $i, $event_type, $project);
    }

}