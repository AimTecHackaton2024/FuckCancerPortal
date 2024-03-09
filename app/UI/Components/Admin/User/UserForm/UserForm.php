<?php

namespace App\UI\Components\Admin\User\UserForm;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\Domain\BlogTag\BlogTag;
use App\Domain\BlogTag\BlogTagService;
use App\Domain\User\User;
use App\Domain\User\UserService;
use App\UI\Components\Base\BaseComponent;
use App\UI\Form\BaseForm;
use Nette\Utils\ArrayHash;

class UserForm extends BaseComponent
{


    private ?User $user;
    private UserService $userService;

    public function __construct(?User $user,
    UserService $userService)
    {
        $this->user = $user;
        $this->userService = $userService;
    }

    public function render(mixed $params = null): void
    {
        /** @var BaseForm $form */
        $form = $this['form'];

        if ($this->user)
        {
            $form->setDefaults([
                'send_new_blog_notification' => $this->user->isSendNewBlogNotification(),
                'role' => $this->user->getRole()
            ]);
        }

        parent::render($params);
    }

    public function createComponentForm(): BaseForm
    {
        $form = new BaseForm();

        $form->addCheckbox('send_new_blog_notification', 'Odeslat notifikaci při vytovření článku?');

        $form->addSelect('role', 'Role', User::$rolesForSelect);

        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(BaseForm $form, ArrayHash $values)
    {

        try {
            if($this->user === null)
            {
                $this->flashError("Tento formulář slouží pouze k editaci");

            }
            else
            {
                $this->userService->updateUser($this->user, $values['role'], $values['send_new_blog_notification']);
            }
        }
        catch (\Exception $e)
        {
            $this->flashError("Ukládání dat se nezdařilo");
        }

        $this->flashSuccess('Ukložení tagu proběhlo úspěšně');


        $this->presenter->redirect(':list');
    }
}
