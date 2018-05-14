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

        Assert::equal(1, $this->projectModel->isProjectActive(1));
        Assert::equal(0, $this->projectModel->isProjectActive(2));

    }

    public function testSkippedTestInProject()
    {

        Assert::equal(1, $this->projectModel->getSkipeedTestToProject(1));
    }


}

$test = new ProjectTest($container);
$test->run();