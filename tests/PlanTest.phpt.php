<?php
/**
 * Created by PhpStorm.
 * User: tjurnicek
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

        Assert::equal(2, $this->planModel->getProcessCaseCount(13));


    }

/**
 * Test for count assigned tests in Plan.
 */
    public function testAssignedPlan(){

        Assert::equal(5, $this->planModel->getAssignCasesCount(13));


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


}

$test = new PlanTest($container);
$test->run();