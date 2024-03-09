<?php

namespace App\UI\Components\Organization\OrganizationListGrid;

use App\UI\Components\Base\BaseComponent;
use App\UI\DataGrid\BaseGrid;

class OrganizationListGrid extends BaseComponent
{
    public function __construct()
    {

    }

    public function createComponentGrid(): BaseGrid
    {
        $grid = new BaseGrid();

        return $grid;
    }
}
