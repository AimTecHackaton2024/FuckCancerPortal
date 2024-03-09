<?php

namespace App\UI\Components\Organization\OrganizationListGrid;

use App\Domain\Organization\OrganizationService;
use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;
use Contributte\Translation\Translator;


class OrganizationListGrid extends BaseComponent
{
    private OrganizationService $organizationService;

    public function __construct(OrganizationService $organizationService, Translator $translator)
    {

        $this->organizationService = $organizationService;
        $this->translator = $translator;
    }

    public function createComponentGrid(): BaseGrid
    {
        $grid = new BaseGrid();

        $grid->setTranslator($this->translator);
        $grid->setDataSource($this->organizationService->getAllDataSource());

        $grid->addColumnNumber('id', '#');

        return $grid;
    }
}
