<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use App\Model\EventModel;


/**
 * Users management.
 */
class UserManager implements Nette\Security\IAuthenticator
{
	use Nette\SmartObject;

	const
		TABLE_NAME = 'user',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'username',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_EMAIL = 'email',
		COLUMN_ROLE_ID = 'role_id',
	    COLUMN_LAST_LOGIN_TIME = 'last_login_time';


	/** @var Nette\Database\Context */
	private $database;

    /** @var EventModel */
    private $eventModel;


	public function __construct(Nette\Database\Context $database, EventModel $eventModel)
	{
		$this->database = $database;
		$this->eventModel = $eventModel;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{

		list($username, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)
			->where(self::COLUMN_NAME, $username)
			->fetch();




		if (!$row) {
			throw new Nette\Security\AuthenticationException('Uživatelské jméno je nesprávné.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('Heslo je nesprávné.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update([
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
        			]);

       		}else{
            $values=[];
            $values['user_id']=$this->eventModel->getUserId($username);
            $values['event_type_id']=1;
            $values['event_time']= new \Nette\Utils\DateTime();


            $this->eventModel->addEvent($values);

            $row->update([
                self::COLUMN_LAST_LOGIN_TIME =>new Nette\Utils\DateTime,
            ]);

        }

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID],  (string) $row[self::COLUMN_ROLE_ID], $arr);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return void
	 * @throws DuplicateNameException
	 */
	public function add($username, $email, $password)
	{
		try {
			$this->database->table(self::TABLE_NAME)->insert([
				self::COLUMN_NAME => $username,
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
				self::COLUMN_EMAIL => $email,
                self::COLUMN_ROLE_ID => "1",
			]);

		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}
}



class DuplicateNameException extends \Exception
{
}
