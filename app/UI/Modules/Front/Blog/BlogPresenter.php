<?php

namespace App\UI\Modules\Front\Blog;

use App\Domain\Blog\BlogPostService;
use App\UI\Components\Organization\OrganizationListGrid\OrganizationListGrid;
use App\UI\Components\Organization\OrganizationListGrid\OrganizationListGridFactory;
use App\UI\Modules\Front\BaseFrontPresenter;

class BlogPresenter extends BaseFrontPresenter
{
    private BlogPostService $postService;
    public function __construct(
        BlogPostService $postService,
    )
    {
        $this->postService = $postService;
    }

    public function actionDefault()
    {
        $posts = $this->postService->getAll();

        $this->template->blogPosts = $posts;
    }
}
