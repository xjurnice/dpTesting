<?php
/**
 * @testCase
 */

namespace Test;

use App\Model\CaseModel;
use App\Model\ExecutionModel;


use Nette\DI\Container;
use Tester;
use Tester\Assert;


$container = require __DIR__ . '/bootstrap.php';


class CaseTest extends Tester\TestCase
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @var CaseModel
     */
    private $caseModel;




    function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function setUp()
    {
        $this->caseModel = $this->container->getByType(CaseModel::class);


    }

    public function tearDown()
    {

    }



    public function testGetExecutionInCase()
    {

        Assert::equal([], $this->caseModel->getAllExecutions(500));


    }

    public function testGetSetInCase()
    {

        Assert::equal([], $this->caseModel->getAllTestPlans(555,1));


    }

    public function testGetStepsInCase()
    {

        Assert::equal([], $this->caseModel->getAllSteps(555));


    }


}

$test = new CaseTest($container);
$test->run();