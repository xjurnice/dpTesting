<?php

use Nette\Forms\Container;
use WebChemistry\Forms\Controls\Multiplier;
use Nette\Application\UI\Form;
use WebChemistry\Testing\TUnitTest;

class MultiplierTest extends \Codeception\TestCase\Test {

	use TUnitTest;

	private function createMultiplier(callable $factory, $copyNumber = 1, $maxCopies = NULL) {
		$form = new Form();

		$form['m'] = new Multiplier($factory, $copyNumber, $maxCopies);

		$form->addSubmit('send');

		return $form;
	}

	protected function _before() {
		$form = $this->services->form;

		$form->addForm('base', function ($copyNumber = 1, $maxCopies = NULL) {
			return $this->createMultiplier(function (Container $container) {
				$container->addText('bar');
			}, $copyNumber, $maxCopies);
		});
	}

	public function testRenderBase() {
		$response = $this->services->form->createRequest('base')->render();

		$this->assertDomHas($response->toDomQuery(), 'input[name="m[0][bar]"]');
	}

	public function testSendBase() {
		$response = $this->services->form->createRequest('base')
			->setPost($params = [
				'm' => [
					['bar' => 'foo']
				]
			])->send();

		$this->assertTrue($response->isSuccess());
		$this->assertSame($params, $response->getValues());

		$dom = $response->toDomQuery();

		$this->assertDomHas($dom, 'input[name="m[0][bar]"][value="foo"]');
		$this->assertDomNotHas($dom, 'input[name="m[1][bar]"]');
	}

	public function testRenderCopy2() {
		$response = $this->services->form->createRequest('base', 2)->render();
		$dom = $response->toDomQuery();

		$this->assertDomHas($dom, 'input[name="m[0][bar]"]');
		$this->assertDomHas($dom, 'input[name="m[1][bar]"]');
	}

	public function testSendCopy2() {
		$response = $this->services->form->createRequest('base', 2)
			->setPost($params = [
				'm' => [
					['bar' => 'foo'],
					['bar' => 'bar'],
				]
			])->send();

		$this->assertSame($params, $response->getValues());

		$dom = $response->toDomQuery();

		$this->assertDomHas($dom, 'input[name="m[0][bar]"]');
		$this->assertDomHas($dom, 'input[name="m[1][bar]"]');
		$this->assertDomNotHas($dom, 'input[name="m[2][bar]"]');
	}

	public function testRenderMaxCopy() {
		$response = $this->services->form->createRequest('base', 2, 1)->render();
		$dom = $response->toDomQuery();

		$this->assertDomHas($dom, 'input[name="m[0][bar]"]');
		$this->assertDomNotHas($dom, 'input[name="m[1][bar]"]');
	}

	public function testSendMaxCopy() {
		$response = $this->services->form->createRequest('base', 2, 1)
			->setPost([
				'm' => [
					['bar' => 'foo'],
					['bar' => 'bar'],
				]
			])->send();

		$this->assertSame([
			'm' => [
				['bar' => 'foo'],
			]
		], $response->getValues());

		$dom = $response->toDomQuery();

		$this->assertDomHas($dom, 'input[name="m[0][bar]"]');
		$this->assertDomNotHas($dom, 'input[name="m[1][bar]"]');
	}

}
