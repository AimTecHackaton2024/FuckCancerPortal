<?php

namespace App\UI\Components\Admin\User\UserListGrid;

use App\Domain\User\UserService;
use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;

class UserListGrid extends BaseComponent
{
    private UserService $userService;

    public function __construct(
        UserService $userService,
        Translator $translator,
    )
    {
        $this->userService = $userService;
        $this->translator = $translator;
    }

    public function createComponentGrid(): BaseGrid
    {
        $grid = new BaseGrid();
        $grid->setTranslator($this->translator);
        $grid->setDataSource($this->userService->getAllDataSource());

        $grid->addColumnNumber('id', '#');
        $grid->addColumnText('name', 'Jméno');
        $grid->addColumnText('email', 'E-mail');
        $grid->addColumnText('role', 'Role');
        $grid->addColumnNumber('status', 'Stav');

        return $grid;
    }
}
