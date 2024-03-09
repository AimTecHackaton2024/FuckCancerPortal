<?php

namespace App\UI\Modules\Admin\User;

use App\Domain\User\User;

use App\Domain\User\UserService;
use App\UI\Components\Admin\User\UserForm\UserForm;
use App\UI\Components\Admin\User\UserForm\UserFormFactory;
use App\UI\Components\Admin\User\UserListGrid\UserListGrid;
use App\UI\Components\Admin\User\UserListGrid\UserListGridFactory;
use App\UI\Modules\Admin\BaseAdminPresenter;

class UserPresenter extends BaseAdminPresenter
{
    private UserListGridFactory $userListGridFactory;
    private UserFormFactory $userFormFactory;

    private ?User $user = null;

    public function __construct(
        UserListGridFactory $userListGridFactory,
        UserFormFactory $userFormFactory,
        UserService $userService
    )
    {
        $this->userListGridFactory = $userListGridFactory;
        $this->userFormFactory = $userFormFactory;
        $this->userService = $userService;
    }

    public function actionEdit(int $id)
    {

        $this->user = $this->userService->getById($id);
        $this->template->userEmail = $this->user->getEmail();
    }

    public function createComponentUserForm(): UserForm
    {
        return $this->userFormFactory->create($this->user);
    }

    public function createComponentUserListGrid(): UserListGrid
    {
        return $this->userListGridFactory->create();
    }
}
