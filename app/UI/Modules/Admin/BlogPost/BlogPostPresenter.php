<?php

namespace App\UI\Modules\Admin\BlogPost;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\UI\Components\Admin\Blog\BlogPostForm\BlogPostForm;
use App\UI\Components\Admin\Blog\BlogPostForm\BlogPostFormFactory;
use App\UI\Components\Admin\Blog\BlogPostListGrid\BlogPostListGrid;
use App\UI\Components\Admin\Blog\BlogPostListGrid\BlogPostListGridFactory;
use App\UI\Modules\Admin\BaseAdminPresenter;

class BlogPostPresenter extends BaseAdminPresenter
{
    private ?BlogPost $blogPost = null;

    private BlogPostService $blogPostService;
    private BlogPostListGridFactory $blogPostListGridFactory;
    private BlogPostFormFactory $blogPostFormFactory;

    public function __construct(
        BlogPostService $blogPostService,
        BlogPostListGridFactory $blogPostListGridFactory,
        BlogPostFormFactory $blogPostFormFactory,
    )
    {
        $this->blogPostService = $blogPostService;
        $this->blogPostListGridFactory = $blogPostListGridFactory;
        $this->blogPostFormFactory = $blogPostFormFactory;
    }

    public function actionEdit(string $id)
    {
        $this->blogPost = $this->blogPostService->getById($id);
    }

    public function createComponentBlogPostListGrid(): BlogPostListGrid
    {
        return $this->blogPostListGridFactory->create();
    }

    public function createComponentBlogPostForm(): BlogPostForm
    {
        return $this->blogPostFormFactory->create($this->blogPost);
    }
}
