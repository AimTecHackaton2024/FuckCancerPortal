<?php

namespace App\UI\Components\Admin\Blog\MyBlogListGrid;

interface MyBlogListGridFactory
{
    public function create(int $userId): MyBlogListGrid;
}
