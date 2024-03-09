<?php

namespace App\UI\Components\Admin\Blog\BlogPostListGrid;

use App\Domain\Blog\BlogPostService;
use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;

class BlogPostListGrid extends BaseComponent
{
    private BlogPostService $blogPostService;

    public function __construct(
        BlogPostService $blogPostService,
        Translator $translator,
    )
    {
        $this->blogPostService = $blogPostService;
        $this->translator = $translator;
    }

    public function createComponentGrid(): BaseGrid
    {
        $grid = new BaseGrid();
        $grid->setTranslator($this->translator);
        $grid->setDataSource($this->blogPostService->getAllDataSource());

        $grid->addColumnNumber('id', '#');
        $grid->addColumnText('title', 'Titulek');

        $grid->addAction('edit', 'Upravit', ':edit');
        return $grid;
    }
}
