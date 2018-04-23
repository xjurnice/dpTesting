<?php

namespace App\Presenters;

use App\Forms;
use App\Model\EventModel;
use Nette\Application\UI\Form;
use Nette\Utils;
use App\Model\UserModel;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette;
use AlesWita;


class SignPresenter extends BasePresenter
{
	/** @var Forms\SignInFormFactory */
	private $signInFactory;

	/** @var Forms\SignUpFormFactory */
	private $signUpFactory;

    /** @var UserModel */
    private $userModel;



    /** @var Nette\Mail\IMailer @inject */
    public $mailer;

    public $token;

	public function __construct(Forms\SignInFormFactory $signInFactory, Forms\SignUpFormFactory $signUpFactory, UserModel $userModel, EventModel $eventModel)
    {
        parent::__construct($eventModel);
        $this->userModel = $userModel;

		$this->signInFactory = $signInFactory;
		$this->signUpFactory = $signUpFactory;
	}


    protected function createComponentForgottenPasswordForm() {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);

        $form->addText('mail', 'E-mail:', 35)
            ->setEmptyValue('@')
            ->addRule(Form::FILLED, 'Vyplňte Váš email')
            ->addCondition(Form::FILLED)
            ->addRule(Form::EMAIL, 'Neplatná emailová adresa');

        $form->addSubmit('add', 'Odeslat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = array($this, 'verifyEmailSuccess');
        return $form;
    }

    public function actionNewPass($token)
    {
        $this->token = $token;
        if ($this->userModel->isTokenExist($token)) {

        } else {
            $this->flashMessage('Změna údajů není možná! Žádost o změnu hesla již není platná.');
            $this->redirect('Sign:in');
        }
    }

        public function verifyEmailSuccess(Form $form, $values) {
        // ...
        if ($this->userModel->getEmails($values['mail'])) {
            $token = Utils\Random::generate(32);
            $id = $this->userModel->getId($values['mail']);

            $this->userModel->setToken($token,$id);
            $mail = new Message;
            $mail->setFrom('info@TestOne.cz');
            $mail->addTo($values['mail']);
            $mail->setSubject('Žádost o změnu hesla na TestOne');
            $mail->setBody("Dobrý den,\nprávě jste požádal/a o změnu hesla na Test0ne. Pro změnu použíjte následující odkaz URL.\n  http://localhost/dp-testing/www/sign/newpass?token=".$token);


            $this->mailer->send($mail);
            $this->flashMessage('Na Váš e-mail byly zaslány další instrukce');
            $this->redirect('Sign:in');
        } else {

            $this->flashMessage('Takový e-mail není evidovaný u žádného účtu!');
        }
    }

    protected function createComponentEditPassForm()
    {
        $form = new Form;
        $form->setRenderer(new AlesWita\FormRenderer\BootstrapV4Renderer);

        $form->addProtection();

        $form->addPassword('heslo', 'Nové heslo', 20)
            ->setOption('description', 'Alespoň 6 znaků')
            ->addRule(Form::FILLED, 'Vyplňte Vaše heslo')
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 4);
        $form->addPassword('heslo2', 'Nové heslo znovu', 20)
            ->addConditionOn($form['heslo'], Form::VALID)
            ->addRule(Form::FILLED, 'Heslo znovu')
            ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['heslo']);
        $form->addHidden('token')->setDefaultValue($this->token);
        $form->addSubmit('edit', 'Editovat')->getControlPrototype()->setClass('btn btn-primary btn-lg btn-block');
        $form->onSuccess[] = [$this, 'editPassSuccess'];
        return $form;
    }

    public function editPassSuccess(Form $form, $values) {
        $values = $form->getValues();


        $this->userModel->setNewPass($values);

        $this->flashMessage('Heslo bylo úspěšně změněno, nyní se můžete přihlásit');
        $this->userModel->deleteToken($values['token']);
        $this->redirect('Sign:in');

    }
	/**
	 * Sign-in form factory.
	 * @return Form
	 */
	protected function createComponentSignInForm()
	{

		return $this->signInFactory->create(function () {

					$this->redirect('Dashboard:');
		});
	}


	/**
	 * Sign-up form factory.
	 * @return Form
	 */
	protected function createComponentSignUpForm()
	{
		return $this->signUpFactory->create(function () {
			$this->redirect('Dashboard:');
		});
	}


	public function actionOut()
	{
        $session = $this->getSession();
        $sessionSection = $session->getSection('sekcePromenna');
        $sessionSection->project = 0;
		$this->getUser()->logout();
        $this->flashMessage('Byl jsi odhlášen');

	}


}
