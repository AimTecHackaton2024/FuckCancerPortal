<?php

namespace App\UI\Components\Admin\Sign;



use App\Domain\User\User;

interface PasswordRecoveryFormFactory
{
    public function create(User $user): PasswordRecoveryForm;
}
