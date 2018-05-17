<?php
/**
 * @testCase
 */

namespace Test;

use App\Model\ExecutionModel;


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
     * @var ExecutionModel
     */
    private $executionModel;


    private $execution=126;


    function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function setUp()
    {
        $this->executionModel = $this->container->getByType(ExecutionModel::class);


    }

    public function tearDown()
    {

    }



    public function testGetExecution()
    {

        Assert::equal(false, $this->executionModel->getExecution(230)->get('case_id'));


    }

    public function testFailExecution()
    {

        Assert::equal(1, $this->executionModel->getExecutionFail($this->execution));


    }

    public function testSkipExecution()
    {

        Assert::equal(1, $this->executionModel->getExecutionSkip($this->execution));


    }

    public function testPassExecution()
    {

        Assert::equal(2, $this->executionModel->getExecutionPass($this->execution));


    }

}

$test = new UserTest($container);
$test->run();