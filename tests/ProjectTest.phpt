<?php
/**
 * @testCase
 */

namespace Test;

use App\Model\ProjectModel;
use Nette\DI\Container;
use Tester;
use Tester\Assert;


$container = require __DIR__ . '/bootstrap.php';


class ProjectTest extends Tester\TestCase
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @var ProjectModel
     */
    private $projectModel;

    /**
     * @var int
     * Here you can set testing project
     */
    private $project =1;


    function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function setUp()
    {
        $this->projectModel = $this->container->getByType(ProjectModel::class);


    }

    public function tearDown()
    {

    }

    public function testActiveProject()
    {

        Assert::equal(1, $this->projectModel->isProjectActive($this->project));
        Assert::equal(0, $this->projectModel->isProjectActive(2));

    }

    public function testSkippedTestInProject()
    {

        Assert::equal(3, $this->projectModel->getSkipeedTestToProject($this->project));
    }

    public function testUsersInProject()
    {

        Assert::equal(6, $this->projectModel->getUsersToProject($this->project));
    }


    public function testPassTestInProject()
    {

        Assert::equal(42, $this->projectModel->getPassTestToProject($this->project));
    }


    public function testPlanInProject()
    {

        Assert::equal(5, $this->projectModel->getNumberTestPlan($this->project));
    }

    public function testFailInProject()
    {

        Assert::equal(13, $this->projectModel->getFailedTestToProject($this->project));
    }




}

$test = new ProjectTest($container);
$test->run();