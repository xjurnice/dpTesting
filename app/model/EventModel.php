<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;

class EventModel
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

    public function getUserId($username)
    {
        return $this->database->table('user')->select('username')->where('username', $username)->fetchField('id');
    }

    public function addEvent($values)
    {
        return $this->database->table('event')->insert($values);
    }

    public function getEvents($project)
    {
        return $this->database->query('SELECT event.*, user.username FROM event JOIN user on event.user_id=user.id WHERE project_id=? ORDER BY event_time DESC LIMIT 10', $project)->fetchAll();
    }

    public function getAllEvents($project)
    {
        return $this->database->query('SELECT event.*, user.username FROM event JOIN user on event.user_id=user.id WHERE project_id=? ORDER BY event_time DESC', $project)->fetchAll();
    }

    public function getProject($user_id)
    {
        return $this->database->query('SELECT project.id, project.name FROM project JOIN project_has_user ON project.id=project_has_user.project_id WHERE user_id=?', $user_id);
    }

    public function isProjectActive($id)
    {
        if (!empty($this->database->query("SELECT * FROM project WHERE id=? AND DATEDIFF(start_date,CURRENT_DATE)<=0 AND DATEDIFF(end_date,CURRENT_DATE)>=0", $id)->fetch())) {

            return 1;
        } else {
            return 0;
        }
    }
}