<?php

namespace App\UI\Components\Admin\Blog\BlogPostForm;

use App\Domain\Blog\BlogPost;

interface BlogPostFormFactory
{
    public function create(?BlogPost $blogPost = null): BlogPostForm;
}
