<?php
/**
 * @testCase
 */

namespace Test;
use App\Model\PlanModel;
use Tester;
use Tester\Assert;
use Nette\DI\Container;




$container = require __DIR__ . '/bootstrap.php';



class PlanTest extends Tester\TestCase {

    /**
     * @var Container
     */
    private $container;

    /**
     * @var PlanModel
     */
    private $planModel;

    /**
     * @var int
     * Here you can set testing plan
     */
    private $plan =13;

    function __construct(Container $container) {
        $this->container = $container;
    }

    public function setUp() {
        $this->planModel = $this->container->getByType(PlanModel::class);


    }

    public function tearDown() {

    }
/**
 * Test for count executed tests in Plan.
 */
    public function testProcessPlan(){

        Assert::equal(8, $this->planModel->getProcessCaseCount($this->plan));


    }

/**
 * Test for count assigned tests in Plan.
 */
    public function testAssignedPlan(){

        Assert::equal(8, $this->planModel->getAssignCasesCount($this->plan));


    }



    /**
     * Test for count assigned tests in Plan.
     */
    public function testIsExistAnyCaseInPlan(){

        Assert::equal(1, $this->planModel->isAnyCaseInPlanExist($this->plan));


    }

    /**
     * Test for add new plan

    public function testAddNewPlan(){
$values= array();
$values['name']="Test plan testovaci";
$values['description']="Toto je popis";
$values['assign_user_id']=2;
$values['project_id']=1;
$values['planed_time']= new \DateTime();


  $this->planModel->addPlan($values);


    }
*/


    /**
     * Test for set status to plan.
     */
    public function testSetPlanFinished(){
        $s['status']=4; // this have to fail
        Assert::equal(0,$this->planModel->setTestPlanFinished($this->plan,$s));


    }

}

$test = new PlanTest($container);
$test->run();