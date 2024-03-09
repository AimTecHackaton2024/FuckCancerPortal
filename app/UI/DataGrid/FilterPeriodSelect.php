<?php

namespace App\UI\DataGrid;

use App\Domain\Settings\SettingsProvider;
use App\UI\Control\TSettingsProvider;
use Doctrine\ORM\QueryBuilder;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Filter\FilterSelect;

class FilterPeriodSelect extends FilterSelect
{
    public const FILTER_TSP1 = 'tsp1';
    public const FILTER_TSP2 = 'tsp2';
    public const FILTER_TSP_ALL = 'tsp_all';

    /**
     * @param BaseGrid $grid
     * @param string $key
     * @param string $name
     * @param array<mixed, string> $options
     * @param string $column
     */
    public function __construct(
        BaseGrid         $grid,
        string           $key,
        string           $name,
        array            $options,
        string           $column,
    )
    {

        $newOptions = [
            self::FILTER_TSP1    => $grid->getTranslator()->translate('admin.basegrid.filter_tsp1'),
            self::FILTER_TSP2    => $grid->getTranslator()->translate('admin.basegrid.filter_tsp2'),
            self::FILTER_TSP_ALL => $grid->getTranslator()->translate('admin.basegrid.filter_tsp_all'),
        ];

        foreach ($options as $optionKey => $option)
        {
            $newOptions[$optionKey] = $option;
        }

        $this->setCondition(function(QueryBuilder $source, string|int|null $value) use ($column) {
            if($value === null)
            {
                return;
            }

            /** @var BaseGrid $grid */
            $grid = $this->grid;

            if ($value === self::FILTER_TSP_ALL)
            {
                $source->andWhere($column . ' IN (:period)');
                $source->setParameter('period', [$grid->getSettingsProvider()->getTsp1Period(), $grid->getSettingsProvider()->getTsp2Period()]);
                return;
            }

            if ($value === self::FILTER_TSP1)
            {
                $value = $grid->getSettingsProvider()->getTsp1PeriodId();
            }
            else if ($value === self::FILTER_TSP2)
            {
                $value = $grid->getSettingsProvider()->getTsp2PeriodId();
            }

            $source->andWhere($column . ' = :period');
            $source->setParameter('period', $value);
        });

        parent::__construct($grid, $key, $name, $newOptions, $column);
    }
}