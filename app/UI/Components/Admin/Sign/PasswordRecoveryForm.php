<?php

namespace App\UI\Components\Admin\Sign;

use App\Domain\User\User;
use App\Domain\User\UserService;
use App\UI\Components\Base\BaseComponent;
use App\UI\Form\BaseForm;
use Contributte\Translation\Translator;
use Doctrine\DBAL\Driver\Exception;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\ArrayHash;

class PasswordRecoveryForm extends BaseComponent
{
    private UserService $userFacade;
    private User $user;

    public function __construct(
        UserService $userFacade,
        Translator $translator,
        User       $user,
    )
    {
        $this->userFacade = $userFacade;
        $this->translator = $translator;
        $this->user = $user;
    }

    public function createComponentForm(): BaseForm
    {
        $translator = $this->translator->createPrefixedTranslator('admin.passwordRecoveryForm');
        $form = new BaseForm();

        $form->addPassword('password1', "Zadejte heslo")
            ->setRequired($translator->translate('required_password1'))
            ->addRule(Form::MIN_LENGTH, "Heslo musí být dlouhé alespoň %d znaků.", 8)
            ->addRule(Form::PATTERN, "Heslo obsahuje nepovolené symboly %s", '^[a-zA-Z0-9#?!@$%^&*-]*$')
            ->addRule(Form::PATTERN, "Heslo musí obsahovat alespoň jedno malé písmeno.", '^[a-zA-Z0-9#?!@$%^&*-]*[a-z]+[a-zA-Z0-9#?!@$%^&*-]*$')
            ->addRule(Form::PATTERN, "Heslo musí obsahovat alespoň jedno velké písmeno.", '^[a-zA-Z0-9#?!@$%^&*-]*[A-Z]+[a-zA-Z0-9#?!@$%^&*-]*$')
            ->addRule(Form::PATTERN, "Heslo musí obsahovat alespoň jedna číslice.", '^[a-zA-Z0-9#?!@$%^&*-]*[0-9]+[a-zA-Z0-9#?!@$%^&*-]*$')
        ;

        $form->addPassword('password2', "Zadejte heslo znovu")
            ->setRequired("Heslo je povinný údaj.")
        ;

        $form->addSubmit('send');

        $form->onSuccess[] = [$this, 'formSucceeded'];
        $form->onValidate[] = [$this, 'formValidated'];

        return $form;
    }

    public function formValidated(BaseForm $form, ArrayHash $values): void
    {
        if ($values['password1'] !== $values['password2'])
        {
            /** @var TextInput $passwordField */
            $passwordField = $form['password2'];
            $passwordField->addError('Zadaná hesla se neshodují.');
        }
    }

    public function formSucceeded(BaseForm $form, ArrayHash $values): void
    {
        try
        {
            $this->userFacade->recoverPassword($this->user, $values['password1']);
        }
        catch (Exception)
        {
            $this->flashError('Vyskytla se chyba při zpracování požadavku.');
            $form->addError('Vyskytla se chyba');
            return;
        }

        $this->flashSuccess('Heslo bylo úspěšně obnoveno.');
    }
}
