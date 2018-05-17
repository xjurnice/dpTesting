<?php
/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 15.03.2018
 * Time: 18:44
 */

namespace App\Model;

use Nette;
use Nette\Security\Passwords;

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
        return $this->database->table('user')->where('id', $id)->fetch();
    }

    public function getUserCaseCount($id)
    {
        return $this->database->table('case')->where('author_id', $id)->count();
    }

    public function getUserExeCount($id)
    {
        return $this->database->table('execution')->where('run_by', $id)->count();
    }

    public function getUsers()
    {
        return $this->database->table('user');
    }

    public function getProjects()
    {
        return $this->database->table('project');
    }

    public function getAssignProjects($id)
    {
        $ids = $this->database->table('project_has_user')->select('project_id')->where('user_id', $id);

        return $this->database->table('project')->where('(id ?)', $ids);
    }

    public function getNotAssignProjects($id)
    {
        $ids = $this->database->table('project_has_user')->select('project_id')->where('user_id', $id);

        return $this->database->table('project')->where('NOT (id ?)', $ids);
    }


    public function addProjectsToUser($ids, $id)
    {

        foreach ($ids as $i) {
            $this->database->query("INSERT INTO project_has_user (project_id,user_id) VALUES ($i,$id)");
        }

    }

    public function deleteProjectsToUser($ids, $id)
    {

        foreach ($ids as $i) {
            $this->database->query('DELETE FROM project_has_user WHERE project_id=? AND user_id=?', $i, $id);
        }

    }

    public function getAssignProjectToUser($id)
    {
        return $this->database->query('SELECT name from project JOIN project_has_user ON project.id=project_has_user.project_id WHERE user_id=?', $id)->fetchPairs();
    }

    public function getProjectToUser($id)
    {
        return $this->database->query('SELECT * from project JOIN project_has_user ON project.id=project_has_user.project_id WHERE user_id=?', $id)->fetchAll();
    }

    public function updateUser($values)
    {
        return $this->database->table('user')->where('id', $values['id'])->update($values);
    }


    public function getEmails($mail)
    {
        if (!empty($this->database->query("SELECT email FROM user WHERE email=?", $mail)->fetchAll())) {

            return 1;
        } else {
            return 0;
        }
    }

    public function getId($mail)
    {
        return $this->database->query("SELECT id FROM user WHERE email=?", $mail)->fetch();

    }

    public function isTokenExist($token)
    {
        if (!empty($this->database->query("SELECT token FROM user WHERE token=?", $token)->fetchAll())) {

            return 1;
        } else {
            return 0;
        }
    }

    public function editPass($data)
    {
        unset($data["password2"]);

        $data["password"] = Passwords::hash($data["password"]);
        return $this->database->query("UPDATE user SET password=?
              WHERE id=?", $data['password'], $data['id']);
    }

    public function setToken($token, $id)
    {
        return $this->database->query("UPDATE user SET token=?
              WHERE ", $token, $id);
    }

    public function deleteToken($token)
    {
        return $this->database->query("UPDATE user SET token=NULL
              WHERE token=? ", $token);
    }

    public function setNewPass($data)
    {
        unset($data["heslo2"]);
        $data["heslo"] = Passwords::hash($data["heslo"]);
        return $this->database->query("UPDATE user SET password=?
              WHERE token=?", $data['heslo'], $data['token']);
    }

    public function isUsernameExist($login)
    {
        if (!empty($this->database->query("SELECT username FROM user WHERE username LIKE '$login'")->fetchAll())) {

            return 1;
        } else {
            return 0;
        }
    }

    public function isEmailExist($email)
    {
        if (!empty($this->database->query("SELECT email FROM user WHERE email LIKE '$email'")->fetchAll())) {

            return 1;
        } else {
            return 0;
        }
    }
}