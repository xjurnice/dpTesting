<?php

namespace App\Forms;

use App\Model;
use App\Model\UserModel;
use Nette;
use Nette\Application\UI\Form;
use AlesWita;


class SignUpFormFactory
{
	use Nette\SmartObject;

	const PASSWORD_MIN_LENGTH = 6;

	/** @var FormFactory */
	private $factory;

	/** @var Model\UserManager */
	private $userManager;

    /** @var Model\UserModel */
    private $userModel;

	public function __construct(FormFactory $factory, Model\UserManager $userManager, Model\UserModel $userModel)
	{
		$this->factory = $factory;
		$this->userManager = $userManager;
		$this->userModel = $userModel;
	}

    function makeBootstrap4(Form $form)
    {
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = 'container';
        $renderer->wrappers['pair']['container'] = 'div class="form-group row"';
        $renderer->wrappers['pair']['.error'] = 'has-danger';
        $renderer->wrappers['control']['container'] = 'div class=col-sm-8';
        $renderer->wrappers['label']['container'] = 'div class="col-sm-2 col-form-label"';
        $renderer->wrappers['control']['description'] = 'span class=form-text';
        $renderer->wrappers['control']['errorcontainer'] = 'span class=form-control-feedback';
        foreach ($form->getControls() as $control) {
            $type = $control->getOption('type');
            if ($type === 'button') {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-lg btn-primary btn-block' : 'btn btn-secondary');
                $usedPrimary = true;
            } elseif (in_array($type, ['text', 'textarea', 'select'], true)) {
                $control->getControlPrototype()->addClass('form-control');
            } elseif ($type === 'file') {
                $control->getControlPrototype()->addClass('form-control-file');
            } elseif (in_array($type, ['checkbox', 'radio'], true)) {
                if ($control instanceof Nette\Forms\Controls\Checkbox) {
                    $control->getLabelPrototype()->addClass('form-check-label');
                } else {
                    $control->getItemLabelPrototype()->addClass('form-check-label');
                }
                $control->getControlPrototype()->addClass('form-check-input');
                $control->getSeparatorPrototype()->setName('div')->addClass('form-check');
            }
        }
    }

	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{
		$form = $this->factory->create();
        $form->onRender[] = [$this, 'makeBootstrap4'];

        $form->addText('username')
			->setRequired('Prosím zadejte uživ. jméno.')->setHtmlAttribute('placeholder', 'uživatelské jméno')->addRule(function ($control) {
                $username = $control->value;
                if($this->userModel->isUsernameExist($username)){

                    return false;
                }
                    else {
                return true;} //true kdyz uzivatelske jmeno je volne, jinak false
}, 'Uživatelské jméno již existuje');

		$form->addEmail('email')
			->setRequired('Prosím zadejte e-mail.')->setHtmlAttribute('placeholder', 'e-mail')->addRule(function ($control) {
                $email = $control->value;
                if($this->userModel->isEmailExist($email)){

                    return false;
                }
                else {
                    return true;} //true kdyz je email volny, jinak false
            }, 'Účet s takovým e-mailem již existuje.');

		$form->addPassword('password')
			->setOption('description', sprintf('Heslo musí mít alespoň %d znaků', self::PASSWORD_MIN_LENGTH))
			->setRequired('Prosím zadejte heslo.')->setHtmlAttribute('placeholder', 'heslo')
			->addRule($form::MIN_LENGTH, null, self::PASSWORD_MIN_LENGTH);

		$form->addSubmit('send', 'Registrovat se');

		$form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
			try {
				$this->userManager->add($values->username, $values->email, $values->password);
			} catch (Model\DuplicateNameException $e) {
				$form['username']->addError('Username is already taken.');


                return;
			}
			$onSuccess();
		};

		return $form;
	}
}
