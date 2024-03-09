<?php

namespace App\UI\Components\Admin\User\UserListGrid;

use App\Domain\User\User;
use App\Domain\User\UserService;
use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;
use Nette\Utils\Html;

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
        $grid->addColumnText('active', 'Aktivní')
        ->setRenderer(function (User $user) {
            if($user->isActive())
            {
                return Html::el('i')->setAttribute('class','fa fa-check');
            }
            else
            {
                return Html::el('i')->setAttribute('class','fa fa-times');
            }

        });

        $grid->addColumnText('send_new_blog_notifications', 'Odesílat notifikace o nových článcích')
            ->setRenderer(function (User $user) {
                if($user->isSendNewBlogNotification())
                {
                    return Html::el('i')->setAttribute('class','fa fa-check');
                }
                else
                {
                    return Html::el('i')->setAttribute('class','fa fa-times');
                }

            });

        $grid->addAction(':edit', '')
            ->setIcon('edit')
            ->setTitle('Editace')
            ->setClass('btn btn-sm btn-secondary');



        return $grid;
    }
}
