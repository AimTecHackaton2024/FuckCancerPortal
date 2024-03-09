<?php

namespace App\UI\Components\Admin\Sign;

use App\Domain\User\UserService;
use App\UI\Components\Base\BaseComponent;
use App\UI\Form\BaseForm;
use Contributte\Translation\Translator;
use Exception;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

class SignForgotForm extends BaseComponent
{
    private UserService $userFacade;


    public function __construct(
        UserService $userFacade
    )
    {
        $this->userFacade = $userFacade;
    }

    public function createComponentForm(): BaseForm
    {
        $form = new BaseForm();

        $form->addEmail('email',"Email")
            ->setRequired("Email je povinný údaj")
            ->setHtmlAttribute('placeholder', "Zadejte email")
        ;

        $form->addSubmit('send', "Odeslat");

        $form->onSuccess[] = [$this, 'proceedForm'];
        return $form;
    }

    public function proceedForm(Form $form, ArrayHash $values): void
    {
        try
        {
            $this->userFacade->proccessPasswordRecovery($values['email'], $this->getPresenter());
        }
        catch (Exception $e)
        {
            $form->addError('Error occured');
            $this->flashError('Při žádosti o reset hesla se vyskytla chyba.');
            return;
        }

        $this->flashSuccess('Bylo úspěšně zažádáno o reset hesla.');
    }
}
