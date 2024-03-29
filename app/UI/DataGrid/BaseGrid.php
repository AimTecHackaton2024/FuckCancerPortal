<?php

namespace App\UI\DataGrid;

use App\UI\Control\TSettingsProvider;
use Nette\Localization\ITranslator;
use Nette\Localization\Translator;
use Ublaboo\DataGrid\Column\Action;
use Ublaboo\DataGrid\Column\ActionCallback;
use Ublaboo\DataGrid\Components\DataGridPaginator\DataGridPaginator;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;
use Ublaboo\DataGrid\Filter\FilterDateRange;
use Ublaboo\DataGrid\Filter\FilterText;

class BaseGrid extends DataGrid
{
    const TEST_TYPE_ATTR = 'type';

    public function __construct()
    {
        parent::__construct();
        $this->setTemplateFile(__DIR__ . '/templates/template.latte');
        $this->setRememberState(false);
        $this->setStrictSessionFilterValues(false);
    }

    public function setTranslator(Translator|\Contributte\Translation\Translator $translator): DataGrid
    {
        if ($translator instanceof ITranslator)
        {
            return parent::setTranslator($translator);
        }

        return $this;
    }

    public function createComponentPaginator(): DataGridPaginator
    {
        $paginator = parent::createComponentPaginator();
        $paginator->setTemplateFile(__DIR__ . '/templates/data_grid_paginator.latte');
        return $paginator;
    }

    /**
     * @param array<string> $columns
     */
    public function addFilterText(string $key, string $name, $columns = null): FilterText
    {
        $filter = parent::addFilterText($key, $name, $columns);
        $filter->setTemplate(__DIR__ . '/templates/datagrid_filter_text.latte');
        $filter->setAttribute('placeholder', $name);
        return $filter;
    }

    /**
     * @param string $key
     * @param string $name
     * @param string|null $href
     * @param array<mixed>|null $params
     * @return Action
     */
    public function addAction(string $key, string $name, ?string $href = null, ?array $params = null): Action
    {
        $action = parent::addAction($key, $name, $href, $params);
        $action->setDataAttribute(self::TEST_TYPE_ATTR, $key);
        return $action;
    }

    public function addActionCallback(string $key, string $name, ?callable $callback = null): ActionCallback
    {
        $actionCallback = parent::addActionCallback($key, $name, $callback);
        $actionCallback->setDataAttribute(self::TEST_TYPE_ATTR, $key);
        return $actionCallback;
    }


    public function addFilterDateRange(string $key, string $name, ?string $column = null, string $nameSecond = '-'): FilterDateRange
    {
        $filter = parent::addFilterDateRange($key, $name, $column, $nameSecond);
        //$filter->setAttribute('data-date-language', 'de-DE');
        //$filter->setAttribute('class', 'bootstrap-datepicker');
        $filter->addAttribute('class', 'bootstrap-datepicker');
        $filter->setAttribute('data-date-language', $this->translator?->translate('admin.lang.code_short'));
        $filter->setTemplate(__DIR__ . '/templates/datagrid_filter_daterange.latte');
        return $filter;
    }

    /**
     * @param string $key
     * @param string $name
     * @param array<mixed, string> $options
     * @param string|null $column
     * @return FilterPeriodSelect
     * @throws DataGridException
     */
    public function addFilterPeriodSelect(string $key, string $name, array $options, ?string $column = null): FilterPeriodSelect
    {
        $column = $column ?? $key;

        $this->addFilterCheck($key);

        return $this->filters[$key] = new FilterPeriodSelect($this, $key, $name, $options, $column);
    }
}
