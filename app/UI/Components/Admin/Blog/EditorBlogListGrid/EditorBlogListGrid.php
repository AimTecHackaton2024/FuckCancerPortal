<?php

namespace App\UI\Components\Admin\Blog\EditorBlogListGrid;

use App\Domain\Blog\BlogPost;
use App\Domain\Blog\BlogPostService;
use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;

class EditorBlogListGrid extends BaseComponent
{
    private BlogPostService $blogPostService;
    private ?int $approverId;

    public function __construct(
        ?int  $approverId,
        BlogPostService $blogPostService,
        Translator $translator,
    )
    {
        $this->blogPostService = $blogPostService;
        $this->translator = $translator;
        $this->approverId = $approverId;
    }

    public function createComponentGrid(): BaseGrid
    {
        bdump($this->approverId);
        $grid = new BaseGrid();
        $grid->setTranslator($this->translator);
        $grid->setDataSource($this->blogPostService->getDataSourceByApprover($this->approverId));

        $grid->addColumnNumber('id', '#');
        $grid->addColumnText('title', 'Titulek');

        $grid->addColumnText('organization_id',  'Organizace')
            ->setRenderer(function (BlogPost $blogPost)
            {
                $organization = $blogPost->getOrganization();


                return $organization?->getTitle();
            });


        if($this->approverId === null)
        {
            $grid->addAction('assign', 'Přiřadit', ':assign');
        }
        else
        {
            $grid->addAction('edit', 'Upravit', ':edit');
        }

        return $grid;
    }
}
