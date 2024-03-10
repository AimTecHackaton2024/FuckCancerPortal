<?php

namespace App\UI\Modules\Admin\Organization;

use App\UI\Components\Admin\Blog\BlogPostForm\BlogPostForm;
use App\UI\Components\Admin\Blog\BlogPostForm\BlogPostFormFactory;
use App\UI\Modules\Admin\BaseAdminPresenter;

class OrganizationPresenter extends BaseAdminPresenter
{
    private BlogPostFormFactory $blogPostFormFactory;

    /**
     * @param BlogPostFormFactory $blogPostFormFactory
     */
    public function __construct(BlogPostFormFactory $blogPostFormFactory)
    {
        $this->blogPostFormFactory = $blogPostFormFactory;
    }

    public function createComponentBlogPostForm(): BlogPostForm
    {
        return $this->blogPostFormFactory->create(null);
    }


}
