<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Implementation\Settings\Storage;

use srag\DataTableUI\SrContainerObjectMenu\Component\Column\Column;
use srag\DataTableUI\SrContainerObjectMenu\Component\Settings\Settings;
use srag\DataTableUI\SrContainerObjectMenu\Component\Settings\Sort\SortField;
use srag\DataTableUI\SrContainerObjectMenu\Component\Settings\Storage\SettingsStorage;
use srag\DataTableUI\SrContainerObjectMenu\Component\Table;
use srag\DataTableUI\SrContainerObjectMenu\Implementation\Utils\DataTableUITrait;
use srag\DIC\SrContainerObjectMenu\DICTrait;

/**
 * Class AbstractSettingsStorage
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Implementation\Settings\Storage
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
abstract class AbstractSettingsStorage implements SettingsStorage
{

    use DICTrait;
    use DataTableUITrait;

    /**
     * AbstractSettingsStorage constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function handleDefaultSettings(Settings $settings, Table $component) : Settings
    {
        if (!$settings->isFilterSet() && empty($settings->getSortFields())) {
            $settings = $settings->withSortFields(array_map(function (Column $column) use ($component) : SortField {
                return self::dataTableUI()->settings()->sort()->sortField($column->getKey(), $column->getDefaultSortDirection());
            }, array_filter($component->getColumns(), function (Column $column) : bool {
                return ($column->isSortable() && $column->isDefaultSort());
            })));
        }

        if (!$settings->isFilterSet() && empty($settings->getSelectedColumns())) {
            $settings = $settings->withSelectedColumns(array_map(function (Column $column) : string {
                return $column->getKey();
            }, array_filter($component->getColumns(), function (Column $column) : bool {
                return ($column->isSelectable() && $column->isDefaultSelected());
            })));
        }

        return $settings;
    }
}
