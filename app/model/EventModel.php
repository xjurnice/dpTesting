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
        return $this->database->table('user')->select('username')->where('username',$username)->fetchField('id');
    }

    public function addEvent($values)
    {
        return $this->database->table('event')->insert($values);
    }
    public function getEvents()
    {
        return $this->database->query('SELECT event.*, user.username FROM event JOIN user on event.user_id=user.id ORDER BY event_time DESC LIMIT 10')->fetchAll();
    }

    public function getAllEvents()
    {
        return $this->database->query('SELECT event.*, user.username FROM event JOIN user on event.user_id=user.id ORDER BY event_time DESC')->fetchAll();
    }




}