<?php

namespace App\UI\Components\Admin\Blog\EditorBlogListGrid;

interface EditorBlogListGridFactory
{
    public function create(?int $approverId): EditorBlogListGrid;
}
