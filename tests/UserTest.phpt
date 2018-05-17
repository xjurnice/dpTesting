<?php
/**
 * @testCase
 */

namespace Test;

use App\Model\UserManager;
use App\Model\UserModel;
use Nette\DI\Container;
use Tester;
use Tester\Assert;


$container = require __DIR__ . '/bootstrap.php';


class UserTest extends Tester\TestCase
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var UserManager
     */
    private $userManager;

    private $user = 3; //set user

    function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function setUp()
    {
        $this->userModel = $this->container->getByType(UserModel::class);
        $this->userManager = $this->container->getByType(UserManager::class);

    }

    public function tearDown()
    {

    }

    public function testExistingEmail()
    {

        Assert::equal(1, $this->userModel->isEmailExist('jurnicek.tomas@gmail.com'));
        Assert::equal(0, $this->userModel->isEmailExist('jurnicek.t@gmail.com'));

    }

    public function testExistingUsername()
    {

        Assert::equal(1, $this->userModel->isUsernameExist('manager'));
        Assert::equal(0, $this->userModel->isUsernameExist('jsfag41d5f1g'));

    }

    public function testUserCaseCount()
    {

        Assert::equal(12, $this->userModel->getUserCaseCount($this->user));


    }

    public function testUserExeCount()
    {

        Assert::equal(45, $this->userModel->getUserExeCount($this->user));


    }

}

$test = new UserTest($container);
$test->run();