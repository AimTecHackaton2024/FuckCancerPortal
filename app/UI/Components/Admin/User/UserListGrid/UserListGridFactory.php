<?php

namespace App\UI\Components\Admin\User\UserListGrid;

interface UserListGridFactory
{
    public function create(): UserListGrid;
}
