<?php
// source: C:\xampp\htdocs\dp-testing\app/config/config.neon 
// source: C:\xampp\htdocs\dp-testing\app/config/config.local.neon 

class Container_0f83cc5e01 extends Nette\DI\Container
{
	protected $meta = [
		'types' => [
			'Nette\Application\Application' => [1 => ['application.application']],
			'Nette\Application\IPresenterFactory' => [1 => ['application.presenterFactory']],
			'Nette\Application\LinkGenerator' => [1 => ['application.linkGenerator']],
			'Nette\Caching\Storages\IJournal' => [1 => ['cache.journal']],
			'Nette\Caching\IStorage' => [1 => ['cache.storage']],
			'Nette\Database\Connection' => [1 => ['database.default.connection']],
			'Nette\Database\IStructure' => [1 => ['database.default.structure']],
			'Nette\Database\Structure' => [1 => ['database.default.structure']],
			'Nette\Database\IConventions' => [1 => ['database.default.conventions']],
			'Nette\Database\Conventions\DiscoveredConventions' => [1 => ['database.default.conventions']],
			'Nette\Database\Context' => [1 => ['database.default.context']],
			'Nette\Http\RequestFactory' => [1 => ['http.requestFactory']],
			'Nette\Http\IRequest' => [1 => ['http.request']],
			'Nette\Http\Request' => [1 => ['http.request']],
			'Nette\Http\IResponse' => [1 => ['http.response']],
			'Nette\Http\Response' => [1 => ['http.response']],
			'Nette\Http\Context' => [1 => ['http.context']],
			'Nette\Bridges\ApplicationLatte\ILatteFactory' => [1 => ['latte.latteFactory']],
			'Nette\Application\UI\ITemplateFactory' => [1 => ['latte.templateFactory']],
			'Nette\Mail\IMailer' => [1 => ['mail.mailer']],
			'Nette\Application\IRouter' => [1 => ['routing.router']],
			'Nette\Security\IUserStorage' => [1 => ['security.userStorage']],
			'Nette\Security\User' => [1 => ['security.user']],
			'Nette\Http\Session' => [1 => ['session.session']],
			'Tracy\ILogger' => [1 => ['tracy.logger']],
			'Tracy\BlueScreen' => [1 => ['tracy.blueScreen']],
			'Tracy\Bar' => [1 => ['tracy.bar']],
			'Kdyby\Events\EventManager' => [1 => ['events.manager']],
			'Doctrine\Common\EventManager' => [1 => ['events.manager']],
			'Kdyby\Events\LazyEventManager' => [1 => ['events.manager']],
			'App\Forms\FormFactory' => [1 => ['25_App_Forms_FormFactory']],
			'App\Forms\SignInFormFactory' => [1 => ['26_App_Forms_SignInFormFactory']],
			'App\Forms\SignUpFormFactory' => [1 => ['27_App_Forms_SignUpFormFactory']],
			'App\Model\CaseModel' => [1 => ['28_App_Model_CaseModel']],
			'App\Model\EventModel' => [1 => ['29_App_Model_EventModel']],
			'App\Model\ExecutionModel' => [1 => ['30_App_Model_ExecutionModel']],
			'App\Model\PlanModel' => [1 => ['31_App_Model_PlanModel']],
			'App\Model\ProjectModel' => [1 => ['32_App_Model_ProjectModel']],
			'App\Model\RequestModel' => [1 => ['33_App_Model_RequestModel']],
			'App\Model\SetModel' => [1 => ['34_App_Model_SetModel']],
			'App\Model\SettingModel' => [1 => ['35_App_Model_SettingModel']],
			'Nette\Security\IAuthenticator' => [1 => ['36_App_Model_UserManager']],
			'App\Model\UserManager' => [1 => ['36_App_Model_UserManager']],
			'App\Model\UserModel' => [1 => ['37_App_Model_UserModel']],
			'App\Presenters\BasePresenter' => [
				1 => [
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\Application\UI\Presenter' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\Application\UI\Control' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\Application\UI\Component' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\ComponentModel\Container' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\ComponentModel\Component' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\Application\UI\IRenderable' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\ComponentModel\IContainer' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\ComponentModel\IComponent' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\Application\UI\ISignalReceiver' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\Application\UI\IStatePersistent' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'ArrayAccess' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
				],
			],
			'Nette\Application\IPresenter' => [
				[
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
				],
			],
			'App\Presenters\CasePresenter' => [1 => ['application.1']],
			'App\Presenters\DashboardPresenter' => [1 => ['application.2']],
			'App\Presenters\Error4xxPresenter' => [1 => ['application.3']],
			'App\Presenters\ErrorPresenter' => [1 => ['application.4']],
			'App\Presenters\EventPresenter' => [1 => ['application.5']],
			'App\Presenters\ExecutionPresenter' => [1 => ['application.6']],
			'App\Presenters\PlanPresenter' => [1 => ['application.7']],
			'App\Presenters\ProjectPresenter' => [1 => ['application.8']],
			'App\Presenters\RequestPresenter' => [1 => ['application.9']],
			'App\Presenters\SetPresenter' => [1 => ['application.10']],
			'App\Presenters\SettingPresenter' => [1 => ['application.11']],
			'App\Presenters\SignPresenter' => [1 => ['application.12']],
			'App\Presenters\UserPresenter' => [1 => ['application.13']],
			'NetteModule\ErrorPresenter' => [1 => ['application.14']],
			'NetteModule\MicroPresenter' => [1 => ['application.15']],
			'Nette\DI\Container' => [1 => ['container']],
		],
		'services' => [
			'25_App_Forms_FormFactory' => 'App\Forms\FormFactory',
			'26_App_Forms_SignInFormFactory' => 'App\Forms\SignInFormFactory',
			'27_App_Forms_SignUpFormFactory' => 'App\Forms\SignUpFormFactory',
			'28_App_Model_CaseModel' => 'App\Model\CaseModel',
			'29_App_Model_EventModel' => 'App\Model\EventModel',
			'30_App_Model_ExecutionModel' => 'App\Model\ExecutionModel',
			'31_App_Model_PlanModel' => 'App\Model\PlanModel',
			'32_App_Model_ProjectModel' => 'App\Model\ProjectModel',
			'33_App_Model_RequestModel' => 'App\Model\RequestModel',
			'34_App_Model_SetModel' => 'App\Model\SetModel',
			'35_App_Model_SettingModel' => 'App\Model\SettingModel',
			'36_App_Model_UserManager' => 'App\Model\UserManager',
			'37_App_Model_UserModel' => 'App\Model\UserModel',
			'application.1' => 'App\Presenters\CasePresenter',
			'application.10' => 'App\Presenters\SetPresenter',
			'application.11' => 'App\Presenters\SettingPresenter',
			'application.12' => 'App\Presenters\SignPresenter',
			'application.13' => 'App\Presenters\UserPresenter',
			'application.14' => 'NetteModule\ErrorPresenter',
			'application.15' => 'NetteModule\MicroPresenter',
			'application.2' => 'App\Presenters\DashboardPresenter',
			'application.3' => 'App\Presenters\Error4xxPresenter',
			'application.4' => 'App\Presenters\ErrorPresenter',
			'application.5' => 'App\Presenters\EventPresenter',
			'application.6' => 'App\Presenters\ExecutionPresenter',
			'application.7' => 'App\Presenters\PlanPresenter',
			'application.8' => 'App\Presenters\ProjectPresenter',
			'application.9' => 'App\Presenters\RequestPresenter',
			'application.application' => 'Nette\Application\Application',
			'application.linkGenerator' => 'Nette\Application\LinkGenerator',
			'application.presenterFactory' => 'Nette\Application\IPresenterFactory',
			'cache.journal' => 'Nette\Caching\Storages\IJournal',
			'cache.storage' => 'Nette\Caching\IStorage',
			'container' => 'Nette\DI\Container',
			'database.default.connection' => 'Nette\Database\Connection',
			'database.default.context' => 'Nette\Database\Context',
			'database.default.conventions' => 'Nette\Database\Conventions\DiscoveredConventions',
			'database.default.structure' => 'Nette\Database\Structure',
			'events.manager' => 'Kdyby\Events\LazyEventManager',
			'http.context' => 'Nette\Http\Context',
			'http.request' => 'Nette\Http\Request',
			'http.requestFactory' => 'Nette\Http\RequestFactory',
			'http.response' => 'Nette\Http\Response',
			'latte.latteFactory' => 'Latte\Engine',
			'latte.templateFactory' => 'Nette\Application\UI\ITemplateFactory',
			'mail.mailer' => 'Nette\Mail\IMailer',
			'routing.router' => 'Nette\Application\IRouter',
			'security.user' => 'Nette\Security\User',
			'security.userStorage' => 'Nette\Security\IUserStorage',
			'session.session' => 'Nette\Http\Session',
			'tracy.bar' => 'Tracy\Bar',
			'tracy.blueScreen' => 'Tracy\BlueScreen',
			'tracy.logger' => 'Tracy\ILogger',
		],
		'tags' => [
			'inject' => [
				'application.1' => true,
				'application.10' => true,
				'application.11' => true,
				'application.12' => true,
				'application.13' => true,
				'application.14' => true,
				'application.15' => true,
				'application.2' => true,
				'application.3' => true,
				'application.4' => true,
				'application.5' => true,
				'application.6' => true,
				'application.7' => true,
				'application.8' => true,
				'application.9' => true,
			],
			'nette.presenter' => [
				'application.1' => 'App\Presenters\CasePresenter',
				'application.10' => 'App\Presenters\SetPresenter',
				'application.11' => 'App\Presenters\SettingPresenter',
				'application.12' => 'App\Presenters\SignPresenter',
				'application.13' => 'App\Presenters\UserPresenter',
				'application.14' => 'NetteModule\ErrorPresenter',
				'application.15' => 'NetteModule\MicroPresenter',
				'application.2' => 'App\Presenters\DashboardPresenter',
				'application.3' => 'App\Presenters\Error4xxPresenter',
				'application.4' => 'App\Presenters\ErrorPresenter',
				'application.5' => 'App\Presenters\EventPresenter',
				'application.6' => 'App\Presenters\ExecutionPresenter',
				'application.7' => 'App\Presenters\PlanPresenter',
				'application.8' => 'App\Presenters\ProjectPresenter',
				'application.9' => 'App\Presenters\RequestPresenter',
			],
		],
		'aliases' => [
			'application' => 'application.application',
			'cacheStorage' => 'cache.storage',
			'database.default' => 'database.default.connection',
			'httpRequest' => 'http.request',
			'httpResponse' => 'http.response',
			'nette.cacheJournal' => 'cache.journal',
			'nette.database.default' => 'database.default',
			'nette.database.default.context' => 'database.default.context',
			'nette.httpContext' => 'http.context',
			'nette.httpRequestFactory' => 'http.requestFactory',
			'nette.latteFactory' => 'latte.latteFactory',
			'nette.mailer' => 'mail.mailer',
			'nette.presenterFactory' => 'application.presenterFactory',
			'nette.templateFactory' => 'latte.templateFactory',
			'nette.userStorage' => 'security.userStorage',
			'router' => 'routing.router',
			'session' => 'session.session',
			'user' => 'security.user',
		],
	];


	public function __construct(array $params = [])
	{
		$this->parameters = $params;
		$this->parameters += [
			'appDir' => 'C:\xampp\htdocs\dp-testing\app',
			'wwwDir' => 'C:\xampp\htdocs\dp-testing\www',
			'debugMode' => true,
			'productionMode' => false,
			'consoleMode' => false,
			'tempDir' => 'C:\xampp\htdocs\dp-testing\app/../temp',
		];
	}


	public function createService__25_App_Forms_FormFactory(): App\Forms\FormFactory
	{
		$service = new App\Forms\FormFactory;
		return $service;
	}


	public function createService__26_App_Forms_SignInFormFactory(): App\Forms\SignInFormFactory
	{
		$service = new App\Forms\SignInFormFactory($this->getService('25_App_Forms_FormFactory'),
			$this->getService('security.user'));
		return $service;
	}


	public function createService__27_App_Forms_SignUpFormFactory(): App\Forms\SignUpFormFactory
	{
		$service = new App\Forms\SignUpFormFactory($this->getService('25_App_Forms_FormFactory'),
			$this->getService('36_App_Model_UserManager'), $this->getService('37_App_Model_UserModel'));
		return $service;
	}


	public function createService__28_App_Model_CaseModel(): App\Model\CaseModel
	{
		$service = new App\Model\CaseModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__29_App_Model_EventModel(): App\Model\EventModel
	{
		$service = new App\Model\EventModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__30_App_Model_ExecutionModel(): App\Model\ExecutionModel
	{
		$service = new App\Model\ExecutionModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__31_App_Model_PlanModel(): App\Model\PlanModel
	{
		$service = new App\Model\PlanModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__32_App_Model_ProjectModel(): App\Model\ProjectModel
	{
		$service = new App\Model\ProjectModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__33_App_Model_RequestModel(): App\Model\RequestModel
	{
		$service = new App\Model\RequestModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__34_App_Model_SetModel(): App\Model\SetModel
	{
		$service = new App\Model\SetModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__35_App_Model_SettingModel(): App\Model\SettingModel
	{
		$service = new App\Model\SettingModel($this->getService('database.default.context'));
		return $service;
	}


	public function createService__36_App_Model_UserManager(): App\Model\UserManager
	{
		$service = new App\Model\UserManager($this->getService('database.default.context'),
			$this->getService('29_App_Model_EventModel'));
		return $service;
	}


	public function createService__37_App_Model_UserModel(): App\Model\UserModel
	{
		$service = new App\Model\UserModel($this->getService('database.default.context'));
		return $service;
	}


	public function createServiceApplication__1(): App\Presenters\CasePresenter
	{
		$service = new App\Presenters\CasePresenter($this->getService('28_App_Model_CaseModel'),
			$this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\CasePresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\CasePresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\CasePresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__10(): App\Presenters\SetPresenter
	{
		$service = new App\Presenters\SetPresenter($this->getService('34_App_Model_SetModel'),
			$this->getService('28_App_Model_CaseModel'), $this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\SetPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\SetPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\SetPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__11(): App\Presenters\SettingPresenter
	{
		$service = new App\Presenters\SettingPresenter($this->getService('35_App_Model_SettingModel'),
			$this->getService('32_App_Model_ProjectModel'), $this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\SettingPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\SettingPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\SettingPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__12(): App\Presenters\SignPresenter
	{
		$service = new App\Presenters\SignPresenter($this->getService('26_App_Forms_SignInFormFactory'),
			$this->getService('27_App_Forms_SignUpFormFactory'), $this->getService('37_App_Model_UserModel'),
			$this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->mailer = $this->getService('mail.mailer');
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\SignPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\SignPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\SignPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__13(): App\Presenters\UserPresenter
	{
		$service = new App\Presenters\UserPresenter($this->getService('37_App_Model_UserModel'),
			$this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\UserPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\UserPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\UserPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__14(): NetteModule\ErrorPresenter
	{
		$service = new NetteModule\ErrorPresenter($this->getService('tracy.logger'));
		return $service;
	}


	public function createServiceApplication__15(): NetteModule\MicroPresenter
	{
		$service = new NetteModule\MicroPresenter($this, $this->getService('http.request'),
			$this->getService('routing.router'));
		return $service;
	}


	public function createServiceApplication__2(): App\Presenters\DashboardPresenter
	{
		$service = new App\Presenters\DashboardPresenter($this->getService('28_App_Model_CaseModel'),
			$this->getService('32_App_Model_ProjectModel'), $this->getService('session.session'),
			$this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\DashboardPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\DashboardPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\DashboardPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__3(): App\Presenters\Error4xxPresenter
	{
		$service = new App\Presenters\Error4xxPresenter($this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\Error4xxPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\Error4xxPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\Error4xxPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__4(): App\Presenters\ErrorPresenter
	{
		$service = new App\Presenters\ErrorPresenter($this->getService('tracy.logger'));
		return $service;
	}


	public function createServiceApplication__5(): App\Presenters\EventPresenter
	{
		$service = new App\Presenters\EventPresenter($this->getService('31_App_Model_PlanModel'),
			$this->getService('32_App_Model_ProjectModel'), $this->getService('28_App_Model_CaseModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\EventPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\EventPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\EventPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__6(): App\Presenters\ExecutionPresenter
	{
		$service = new App\Presenters\ExecutionPresenter($this->getService('28_App_Model_CaseModel'),
			$this->getService('30_App_Model_ExecutionModel'), $this->getService('31_App_Model_PlanModel'),
			$this->getService('session.session'), $this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\ExecutionPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\ExecutionPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\ExecutionPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__7(): App\Presenters\PlanPresenter
	{
		$service = new App\Presenters\PlanPresenter($this->getService('31_App_Model_PlanModel'),
			$this->getService('32_App_Model_ProjectModel'), $this->getService('28_App_Model_CaseModel'),
			$this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\PlanPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\PlanPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\PlanPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__8(): App\Presenters\ProjectPresenter
	{
		$service = new App\Presenters\ProjectPresenter($this->getService('32_App_Model_ProjectModel'),
			$this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\ProjectPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\ProjectPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\ProjectPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__9(): App\Presenters\RequestPresenter
	{
		$service = new App\Presenters\RequestPresenter($this->getService('33_App_Model_RequestModel'),
			$this->getService('28_App_Model_CaseModel'), $this->getService('32_App_Model_ProjectModel'),
			$this->getService('29_App_Model_EventModel'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->invalidLinkMode = 5;
		$service->onStartup = $this->getService('events.manager')->createEvent(['App\Presenters\RequestPresenter', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['App\Presenters\RequestPresenter', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onAnchor = $this->getService('events.manager')->createEvent(['App\Presenters\RequestPresenter', 'onAnchor'],
			$service->onAnchor, null, false);
		return $service;
	}


	public function createServiceApplication__application(): Nette\Application\Application
	{
		$service = new Nette\Application\Application($this->getService('application.presenterFactory'),
			$this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('http.response'));
		$service->catchExceptions = false;
		$service->errorPresenter = 'Error';
		Nette\Bridges\ApplicationTracy\RoutingPanel::initializePanel($service);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\ApplicationTracy\RoutingPanel($this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('application.presenterFactory')));
		$service->onStartup = $this->getService('events.manager')->createEvent(['Nette\Application\Application', 'onStartup'],
			$service->onStartup, null, false);
		$service->onShutdown = $this->getService('events.manager')->createEvent(['Nette\Application\Application', 'onShutdown'],
			$service->onShutdown, null, false);
		$service->onRequest = $this->getService('events.manager')->createEvent(['Nette\Application\Application', 'onRequest'],
			$service->onRequest, null, false);
		$service->onPresenter = $this->getService('events.manager')->createEvent(['Nette\Application\Application', 'onPresenter'],
			$service->onPresenter, null, false);
		$service->onResponse = $this->getService('events.manager')->createEvent(['Nette\Application\Application', 'onResponse'],
			$service->onResponse, null, false);
		$service->onError = $this->getService('events.manager')->createEvent(['Nette\Application\Application', 'onError'],
			$service->onError, null, false);
		return $service;
	}


	public function createServiceApplication__linkGenerator(): Nette\Application\LinkGenerator
	{
		$service = new Nette\Application\LinkGenerator($this->getService('routing.router'),
			$this->getService('http.request')->getUrl(), $this->getService('application.presenterFactory'));
		return $service;
	}


	public function createServiceApplication__presenterFactory(): Nette\Application\IPresenterFactory
	{
		$service = new Nette\Application\PresenterFactory(new Nette\Bridges\ApplicationDI\PresenterFactoryCallback($this, 5, 'C:\xampp\htdocs\dp-testing\app/../temp/cache/Nette%5CBridges%5CApplicationDI%5CApplicationExtension'));
		$service->setMapping(['*' => 'App\*Module\Presenters\*Presenter']);
		return $service;
	}


	public function createServiceCache__journal(): Nette\Caching\Storages\IJournal
	{
		$service = new Nette\Caching\Storages\SQLiteJournal('C:\xampp\htdocs\dp-testing\app/../temp/cache/journal.s3db');
		return $service;
	}


	public function createServiceCache__storage(): Nette\Caching\IStorage
	{
		$service = new Nette\Caching\Storages\FileStorage('C:\xampp\htdocs\dp-testing\app/../temp/cache',
			$this->getService('cache.journal'));
		return $service;
	}


	public function createServiceContainer(): Nette\DI\Container
	{
		return $this;
	}


	public function createServiceDatabase__default__connection(): Nette\Database\Connection
	{
		$service = new Nette\Database\Connection('mysql:host=127.0.0.1;dbname=main', 'root',
			null, ['lazy' => true]);
		$this->getService('tracy.blueScreen')->addPanel('Nette\Bridges\DatabaseTracy\ConnectionPanel::renderException');
		Nette\Database\Helpers::createDebugPanel($service, true, 'default');
		$service->onConnect = $this->getService('events.manager')->createEvent(['Nette\Database\Connection', 'onConnect'],
			$service->onConnect, null, false);
		$service->onQuery = $this->getService('events.manager')->createEvent(['Nette\Database\Connection', 'onQuery'],
			$service->onQuery, null, false);
		return $service;
	}


	public function createServiceDatabase__default__context(): Nette\Database\Context
	{
		$service = new Nette\Database\Context($this->getService('database.default.connection'),
			$this->getService('database.default.structure'), $this->getService('database.default.conventions'),
			$this->getService('cache.storage'));
		return $service;
	}


	public function createServiceDatabase__default__conventions(): Nette\Database\Conventions\DiscoveredConventions
	{
		$service = new Nette\Database\Conventions\DiscoveredConventions($this->getService('database.default.structure'));
		return $service;
	}


	public function createServiceDatabase__default__structure(): Nette\Database\Structure
	{
		$service = new Nette\Database\Structure($this->getService('database.default.connection'),
			$this->getService('cache.storage'));
		return $service;
	}


	public function createServiceEvents__manager(): Kdyby\Events\LazyEventManager
	{
		$service = new Kdyby\Events\LazyEventManager([], $this);
		Kdyby\Events\Diagnostics\Panel::register($service, $this)->renderPanel = true;
		return $service;
	}


	public function createServiceHttp__context(): Nette\Http\Context
	{
		$service = new Nette\Http\Context($this->getService('http.request'), $this->getService('http.response'));
		trigger_error('Service http.context is deprecated.', 16384);
		return $service;
	}


	public function createServiceHttp__request(): Nette\Http\Request
	{
		$service = $this->getService('http.requestFactory')->createHttpRequest();
		return $service;
	}


	public function createServiceHttp__requestFactory(): Nette\Http\RequestFactory
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy([]);
		return $service;
	}


	public function createServiceHttp__response(): Nette\Http\Response
	{
		$service = new Nette\Http\Response;
		return $service;
	}


	public function createServiceLatte__latteFactory(): Nette\Bridges\ApplicationLatte\ILatteFactory
	{
		return new class ($this) implements Nette\Bridges\ApplicationLatte\ILatteFactory {
			private $container;


			public function __construct(Container_0f83cc5e01 $container)
			{
				$this->container = $container;
			}


			public function create(): Latte\Engine
			{
				$service = new Latte\Engine;
				$service->setTempDirectory('C:\xampp\htdocs\dp-testing\app/../temp/cache/latte');
				$service->setAutoRefresh(true);
				$service->setContentType('html');
				Nette\Utils\Html::$xhtml = false;
				$service->onCompile = $this->container->getService('events.manager')->createEvent(['Latte\Engine', 'onCompile'],
					$service->onCompile, null, false);
				return $service;
			}
		};
	}


	public function createServiceLatte__templateFactory(): Nette\Application\UI\ITemplateFactory
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory($this->getService('latte.latteFactory'),
			$this->getService('http.request'), $this->getService('security.user'),
			$this->getService('cache.storage'), null);
		return $service;
	}


	public function createServiceMail__mailer(): Nette\Mail\IMailer
	{
		$service = new Nextras\MailPanel\FileMailer('C:\xampp\htdocs\dp-testing\app/../temp/mail-panel-mails');
		return $service;
	}


	public function createServiceRouting__router(): Nette\Application\IRouter
	{
		$service = App\RouterFactory::createRouter();
		return $service;
	}


	public function createServiceSecurity__user(): Nette\Security\User
	{
		$service = new Nette\Security\User($this->getService('security.userStorage'), $this->getService('36_App_Model_UserManager'));
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\SecurityTracy\UserPanel($service));
		$service->onLoggedIn = $this->getService('events.manager')->createEvent(['Nette\Security\User', 'onLoggedIn'],
			$service->onLoggedIn, null, false);
		$service->onLoggedOut = $this->getService('events.manager')->createEvent(['Nette\Security\User', 'onLoggedOut'],
			$service->onLoggedOut, null, false);
		return $service;
	}


	public function createServiceSecurity__userStorage(): Nette\Security\IUserStorage
	{
		$service = new Nette\Http\UserStorage($this->getService('session.session'));
		return $service;
	}


	public function createServiceSession__session(): Nette\Http\Session
	{
		$service = new Nette\Http\Session($this->getService('http.request'), $this->getService('http.response'));
		$service->setExpiration('14 days');
		return $service;
	}


	public function createServiceTracy__bar(): Tracy\Bar
	{
		$service = Tracy\Debugger::getBar();
		return $service;
	}


	public function createServiceTracy__blueScreen(): Tracy\BlueScreen
	{
		$service = Tracy\Debugger::getBlueScreen();
		return $service;
	}


	public function createServiceTracy__logger(): Tracy\ILogger
	{
		$service = Tracy\Debugger::getLogger();
		return $service;
	}


	public function initialize()
	{
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\DITracy\ContainerPanel($this));
		$this->getService('events.manager')->createEvent(['Nette\DI\Container', 'onInitialize'])->dispatch($this);
		$this->getService('http.response')->setHeader('X-Powered-By', 'Nette Framework');
		$this->getService('http.response')->setHeader('Content-Type', 'text/html; charset=utf-8');
		$this->getService('http.response')->setHeader('X-Frame-Options', 'SAMEORIGIN');
		$this->getService('session.session')->exists() && $this->getService('session.session')->start();
		Tracy\Debugger::$editorMapping = [];
		Tracy\Debugger::setLogger($this->getService('tracy.logger'));
		$this->getService('tracy.bar')->addPanel(new Nextras\MailPanel\MailPanel('C:\xampp\htdocs\dp-testing\app/../temp/mail-panel-latte',
			$this->getService('http.request'), $this->getService('mail.mailer')));
		if ($tmp = $this->getByType("Nette\Http\Session", false)) { $tmp->start(); Tracy\Debugger::dispatch(); };
		WebChemistry\Forms\Controls\Multiplier::register('addMultiplier');;
	}
}
