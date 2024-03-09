<?php

namespace App\UI\Components\Admin\BlogTag\BlogTagForm;


use App\Domain\BlogTag\BlogTag;

interface BlogTagFormFactory
{
    public function create(?BlogTag $blogTag = null): BlogTagForm;
}
