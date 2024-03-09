<?php

namespace App\UI\Modules\Admin\BlogTag;

use App\Domain\BlogTag\BlogTag;
use App\Domain\BlogTag\BlogTagService;
use App\UI\Components\Admin\BlogTag\BlogTagForm\BlogTagForm;
use App\UI\Components\Admin\BlogTag\BlogTagForm\BlogTagFormFactory;
use App\UI\Components\Admin\BlogTag\BlogTagListGrid\BlogTagListGrid;
use App\UI\Components\Admin\BlogTag\BlogTagListGrid\BlogTagListGridFactory;
use App\UI\Modules\Admin\BaseAdminPresenter;

class BlogTagPresenter extends BaseAdminPresenter
{

    private BlogTagListGridFactory $blogTagListGridFactory;
    private BlogTagFormFactory $blogTagFormFactory;

    private ?BlogTag $blogTag = null;
    private BlogTagService $blogTagService;

    public function __construct(
        BlogTagListGridFactory $blogTagListGridFactory,
        BlogTagFormFactory $blogTagFormFactory,
        BlogTagService $blogTagService
    )
    {
        $this->blogTagListGridFactory = $blogTagListGridFactory;
        $this->blogTagFormFactory = $blogTagFormFactory;
        $this->blogTagService = $blogTagService;
    }

    public function actionEdit(string $id)
    {
        $this->blogTag = $this->blogTagService->getById($id);
    }

    public function createComponentBlogTagGrid(): BlogTagListGrid
    {
        return $this->blogTagListGridFactory->create();
    }

    public function createComponentBlogTagForm(): BlogTagForm
    {
        return $this->blogTagFormFactory->create($this->blogTag);
    }
}
