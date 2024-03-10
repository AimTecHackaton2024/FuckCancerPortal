<?php

namespace App\UI\Components\Admin\BlogTag\BlogTagListGrid;

use App\Domain\BlogTag\BlogTagService;
use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;
use Ublaboo\DataGrid\Column\Action\Confirmation\CallbackConfirmation;

class BlogTagListGrid extends BaseComponent
{
    private BlogTagService $blogTagService;

    public function __construct(
        BlogTagService $blogTagService,
        Translator $translator,
    )
    {
        $this->blogTagService = $blogTagService;
        $this->translator = $translator;
    }

    public function createComponentGrid(): BaseGrid
    {
        $grid = new BaseGrid();
        $grid->setTranslator($this->translator);
        $grid->setDataSource($this->blogTagService->getAllDataSource());
        $grid->setPagination(true);


        $grid->addFilterText('title', 'Titulek','title');
        $grid->addColumnText('title', 'Titulek')
        ->setSortable(true);

        $grid->addAction(':edit', '')
            ->setIcon('edit')
            ->setTitle('Editace')
            ->setClass('btn btn-sm btn-secondary');

        $grid->addActionCallback('delete', '', function($id) use ($grid) {
            $student = $this->blogTagService->getById($id);
            if (!$student)
            {
                return;
            }

            $this->blogTagService->removeTag($id);
            $this->flashSuccess('Ostranění studenta proběhlo úspěšně.');
            $grid->reload();
        })->setIcon('trash')
            ->setTitle('Smazat')
            ->setClass('btn btn-sm btn-danger')
            ->setConfirmation(
            new CallbackConfirmation(
                function($item) {
                    return 'Opravdu chcete smazat tag ' . $item->getTitle() . '?';
                }
            )
        );


        return $grid;
    }
}
