<?php

namespace App\UI\Components\Admin\Sign;

use App\Model\Exception\Logic\EntityNotFoundException;
use App\Model\Exception\LogicException;
use App\Model\Exception\Runtime\AuthenticationException;
use App\UI\Components\Base\BaseComponent;
use App\UI\Form\BaseForm;
use Nette\Security\User;
use Nette\Utils\ArrayHash;

class SignInForm extends BaseComponent
{
    private User $user;

    public function __construct(
        User $user,
    )
    {
        $this->user = $user;

        if($user->isLoggedIn())
        {
            throw new LogicException('User is already logged');
        }
    }

    public function createComponentForm(): BaseForm
    {
        $form = new BaseForm();

        $form->addEmail('email', 'Email')
            ->setRequired(true);
        
        $form->addPassword('password', 'Heslo')
            ->setRequired(true);
        
        $form->addSubmit('send', 'Přihlásit se');
        
        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(BaseForm $form, ArrayHash $values): void
    {
        try {
            $this->user->login($values['email'], $values['password']);
        } catch(AuthenticationException|EntityNotFoundException $e)
        {
            $this->flashWarning('Přihlášení selhalo. Nesprávné jméno nebo heslo.');
            $form->addError('Přihlášení selhalo. Nesprávné jméno nebo heslo.');
        }

        $this->flashSuccess('Úspěšně přihlášen.');
        $this->presenter->redirect(':Admin:Home:');
    }
}
