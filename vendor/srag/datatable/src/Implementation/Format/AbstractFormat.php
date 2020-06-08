<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Implementation\Format;

use ilUtil;
use srag\DataTableUI\SrContainerObjectMenu\Component\Column\Column;
use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Data;
use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Row\RowData;
use srag\DataTableUI\SrContainerObjectMenu\Component\Format\Format;
use srag\DataTableUI\SrContainerObjectMenu\Component\Settings\Settings;
use srag\DataTableUI\SrContainerObjectMenu\Component\Table;
use srag\DataTableUI\SrContainerObjectMenu\Implementation\Utils\DataTableUITrait;
use srag\DIC\SrContainerObjectMenu\DICTrait;

/**
 * Class AbstractFormat
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Implementation\Format
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
abstract class AbstractFormat implements Format
{

    use DICTrait;
    use DataTableUITrait;

    /**
     * @var object
     */
    protected $tpl;


    /**
     * AbstractFormat constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function getDisplayTitle(Table $component) : string
    {
        return $component->getPlugin()->translate("format_" . $this->getFormatId(), Table::LANG_MODULE);
    }


    /**
     * @inheritDoc
     */
    public function getOutputType() : int
    {
        return self::OUTPUT_TYPE_DOWNLOAD;
    }


    /**
     * @inheritDoc
     */
    public function getTemplate()/* : object*/
    {
        return $this->tpl;
    }


    /**
     * @return string
     */
    protected abstract function getFileExtension() : string;


    /**
     * @inheritDoc
     */
    public function render(Table $component, /*?Data*/ $data, Settings $settings) : string
    {
        $this->initTemplate($component, $data, $settings);

        $columns = $this->getColumns($component, $settings);

        $this->handleColumns($component, $columns, $settings);

        $this->handleRows($component, $columns, $data);

        return $this->renderTemplate($component);
    }


    /**
     * @inheritDoc
     */
    public function deliverDownload(string $data, Table $component)/* : void*/
    {
        $filename = $component->getTitle() . "." . $this->getFileExtension();

        ilUtil::deliverData($data, $filename);
    }


    /**
     * @param Table    $component
     * @param Settings $settings
     *
     * @return Column[]
     */
    protected function getColumnsBase(Table $component, Settings $settings) : array
    {
        return array_filter($component->getColumns(), function (Column $column) use ($settings) : bool {
            if ($column->isSelectable()) {
                return in_array($column->getKey(), $settings->getSelectedColumns());
            } else {
                return true;
            }
        });
    }


    /**
     * @param Table    $component
     * @param Settings $settings
     *
     * @return Column[]
     */
    protected function getColumnsForExport(Table $component, Settings $settings) : array
    {
        return array_filter($this->getColumnsBase($component, $settings), function (Column $column) : bool {
            return $column->isExportable();
        });
    }


    /**
     * @param Table    $component
     * @param Settings $settings
     *
     * @return Column[]
     */
    protected function getColumns(Table $component, Settings $settings) : array
    {
        return $this->getColumnsForExport($component, $settings);
    }


    /**
     * @param Table     $component
     * @param Data|null $data
     * @param Settings  $settings
     */
    protected abstract function initTemplate(Table $component, /*?Data*/ $data, Settings $settings)/* : void*/;


    /**
     * @param Table    $component
     * @param Column[] $columns
     * @param Settings $settings
     */
    protected function handleColumns(Table $component, array $columns, Settings $settings)/* : void*/
    {
        foreach ($columns as $column) {
            $this->handleColumn($column->getFormatter()->formatHeaderCell($this, $column, $component->getTableId()), $component, $column, $settings);
        }
    }


    /**
     * @param string   $formatted_column
     * @param Table    $component
     * @param Column   $column
     * @param Settings $settings
     */
    protected abstract function handleColumn(string $formatted_column, Table $component, Column $column, Settings $settings)/* : void*/;


    /**
     * @param Table     $component
     * @param Column[]  $columns
     * @param Data|null $data
     */
    protected function handleRows(Table $component, array $columns, /*?Data*/ $data)/* : void*/
    {
        if ($data !== null) {
            foreach ($data->getData() as $row) {
                $this->handleRow($component, $columns, $row);
            }
        }
    }


    /**
     * @param Table    $component
     * @param Column[] $columns
     * @param RowData  $row
     */
    protected function handleRow(Table $component, array $columns, RowData $row)/* : void*/
    {
        foreach ($columns as $column) {
            $this->handleRowColumn($column->getFormatter()->formatRowCell($this, $row($column->getKey()), $column, $row, $component->getTableId()));
        }
    }


    /**
     * @param string $formatted_row_column
     */
    protected abstract function handleRowColumn(string $formatted_row_column);


    /**
     * @param Table $component
     *
     * @return string
     */
    protected abstract function renderTemplate(Table $component) : string;
}
