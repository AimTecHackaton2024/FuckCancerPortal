<?php

namespace App\UI\Components\Admin\Blog\MyBlogListGrid;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;

class MyBlogListGrid extends BaseComponent
{
    private BlogPostService $blogPostService;
    private int $userId;

    public function __construct(int $userId,
        BlogPostService $blogPostService,
        Translator $translator,
    )
    {
        $this->blogPostService = $blogPostService;
        $this->translator = $translator;
        $this->userId = $userId;
    }

    public function createComponentGrid(): BaseGrid
    {
        $grid = new BaseGrid();
        $grid->setTranslator($this->translator);
        $grid->setDataSource($this->blogPostService->getPersonalisedDataSource($this->userId));

        $grid->addColumnText('title', 'Titulek');

        $grid->addColumnText('status', 'Stav')
        ->setRenderer(function (BlogPost $blogPost) {

            $status = $blogPost->getStatus();
            if(array_key_exists($status, BlogPost::$statusToText))
            {
                return BlogPost::$statusToText[$status];
            }
            return 'Neznámý';
        });

        return $grid;
    }
}
