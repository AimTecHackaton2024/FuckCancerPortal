<?php declare(strict_types = 1);

namespace App\UI\Modules\Admin\Sign;

use App\Domain\User\UserService;
use App\Model\App;
use App\Model\Exception\Runtime\AuthenticationException;
use App\UI\Components\Admin\Sign\PasswordRecoveryForm;
use App\UI\Components\Admin\Sign\PasswordRecoveryFormFactory;
use App\UI\Components\Admin\Sign\SignForgotForm;
use App\UI\Components\Admin\Sign\SignForgotFormFactory;
use App\UI\Components\Admin\Sign\SignInForm;
use App\UI\Components\Admin\Sign\SignInFormFactory;
use App\UI\Form\BaseForm;
use App\UI\Form\FormFactory;
use App\UI\Modules\Admin\BaseAdminPresenter;
use Doctrine\DBAL\Driver\PDO\Exception;

final class SignPresenter extends BaseAdminPresenter
{

	/** @var string @persistent */
	public string $backlink;

    private SignInFormFactory $signInFormFactory;
    private PasswordRecoveryFormFactory $passwordRecoveryFormFactory;
    private SignForgotFormFactory $signForgotFormFactory;

    private ?string $restoreKey;
    protected ?\App\Domain\User\User $userEntity;

    public function __construct(
        SignInFormFactory $signInFormFactory,
        UserService $userService,
        PasswordRecoveryFormFactory $passwordRecoveryFormFactory,
        SignForgotFormFactory $signForgotFormFactory
    )
    {
        $this->signInFormFactory = $signInFormFactory;
        $this->userService = $userService;
        $this->passwordRecoveryFormFactory = $passwordRecoveryFormFactory;
        $this->signForgotFormFactory = $signForgotFormFactory;
    }

    public function checkRequirements(mixed $element): void
	{
		// Disable auth
	}

	public function actionIn(): void
	{
		if ($this->user->isLoggedIn()) {
			$this->redirect(App::DESTINATION_AFTER_SIGN_IN);
		}
	}

	public function actionOut(): void
	{
		if ($this->user->isLoggedIn()) {
			$this->user->logout();
			$this->flashSuccess('Odhlášení proběhlo úspěšně.');
		}

		$this->redirect(App::DESTINATION_AFTER_SIGN_OUT);
	}

	public function processLoginForm(BaseForm $form): void
	{
		try {
			$this->user->setExpiration($form->values->remember ? '14 days' : '20 minutes');
			$this->user->login($form->values->email, $form->values->password);
		} catch (AuthenticationException $e) {
			$form->addError('Invalid username or password');

			return;
		}

		$this->redirect(App::DESTINATION_AFTER_SIGN_IN);
	}

	protected function createComponentLoginForm(): BaseForm
	{
		$form = $this->formFactory->forBackend();
		$form->addEmail('email')
			->setRequired(true);
		$form->addPassword('password')
			->setRequired(true);
		$form->addCheckbox('remember')
			->setDefaultValue(true);
		$form->addSubmit('submit');
		$form->onSuccess[] = [$this, 'processLoginForm'];

		return $form;
	}

    public function createComponentSignInForm(): SignInForm
    {
        return $this->signInFormFactory->create();
    }

    public function createComponentForgotForm(): SignForgotForm
    {
        $form = $this->signForgotFormFactory->create();
        $form['form']->onSuccess[] = function() {
            $this->redirect(':recoveryEmailSent');
        };

        return $form;
    }

    public function createComponentPasswordRecoveryForm(): PasswordRecoveryForm
    {
        if ($this->userEntity === null)
        {
            throw new Exception('User not exists');
        }

        $form = $this->passwordRecoveryFormFactory->create($this->userEntity);

        $form['form']->onSuccess[] = function() {
            $this->redirect(':in');
        };

        return $form;
    }

    public function actionRecovery(?string $token): void
    {
        if ($token === null)
        {
            $this->flashWarning('Nelze resetovat heslo bez platného tokenu.');
            $this->redirect('forgot');
        }

        $user = $this->userService->getUserByValidRecoveryToken($token);

        if ($user === null)
        {
            $this->flashWarning('Nelze resetovat heslo bez platného tokenu.');
            $this->redirect(':forgot');
        }

        if (!$user->isActive())
        {
            $this->flashWarning('Účet již nemá možnost přihlášení');
            $this->redirect(App::DESTINATION_ADMIN_HOMEPAGE);
        }

        $this->userEntity = $user;
    }



}
