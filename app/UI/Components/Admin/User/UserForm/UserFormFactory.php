<?php

namespace App\UI\Components\Admin\User\UserForm;

use App\Domain\User\User;


interface UserFormFactory
{
    public function create(?User $user = null): UserForm;
}
