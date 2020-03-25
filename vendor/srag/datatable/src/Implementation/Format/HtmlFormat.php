<?php

namespace srag\DataTable\SrContainerObjectMenu\Implementation\Format;

use ILIAS\UI\Implementation\Render\Template;
use srag\DataTable\SrContainerObjectMenu\Component\Column\Column;
use srag\DataTable\SrContainerObjectMenu\Component\Data\Data;
use srag\DataTable\SrContainerObjectMenu\Component\Data\Row\RowData;
use srag\DataTable\SrContainerObjectMenu\Component\Settings\Settings;
use srag\DataTable\SrContainerObjectMenu\Component\Table;

/**
 * Class HtmlFormat
 *
 * @package srag\DataTable\SrContainerObjectMenu\Implementation\Format
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class HtmlFormat extends AbstractFormat
{

    /**
     * @var Template
     */
    protected $tpl;


    /**
     * @inheritDoc
     */
    public function getFormatId() : string
    {
        return self::FORMAT_HTML;
    }


    /**
     * @inheritDoc
     */
    protected function getFileExtension() : string
    {
        return "html";
    }


    /**
     * @inheritDoc
     */
    protected function initTemplate(Table $component, /*?Data*/ $data, Settings $settings)/* : void*/
    {
        $this->tpl = ($this->get_template)("tpl.datatable.html");

        $this->tpl->setVariable("ID", htmlspecialchars($component->getTableId()));

        $this->tpl->setVariable("TITLE", htmlspecialchars($component->getTitle()));

        $this->handleNoDataText($data, $component);
    }


    /**
     * @inheritDoc
     */
    protected function handleColumns(Table $component, array $columns, Settings $settings)/* : void*/
    {
        $this->tpl->setCurrentBlock("header");

        parent::handleColumns($component, $columns, $settings);
    }


    /**
     * @inheritDoc
     */
    protected function handleColumn(string $formatted_column, Table $component, Column $column, Settings $settings)/* : void*/
    {
        $this->tpl->setVariable("HEADER", $formatted_column);

        $this->tpl->parseCurrentBlock();
    }


    /**
     * @inheritDoc
     */
    protected function handleRows(Table $component, array $columns, /*?Data*/ $data)/* : void*/
    {
        $this->tpl->setCurrentBlock("body");

        parent::handleRows($component, $columns, $data);
    }


    /**
     * @inheritDoc
     */
    protected function handleRow(Table $component, array $columns, RowData $row)/* : void*/
    {
        $tpl = $this->tpl;

        $this->tpl = ($this->get_template)("tpl.datatablerow.html");

        $this->handleRowTemplate($component, $row);

        $this->tpl->setCurrentBlock("row");

        parent::handleRow($component, $columns, $row);

        $tpl->setVariable("ROW", self::output()->getHTML($this->tpl));

        $tpl->parseCurrentBlock();

        $this->tpl = $tpl;
    }


    /**
     * @inheritDoc
     */
    protected function handleRowTemplate(Table $component, RowData $row)/* : void*/
    {

    }


    /**
     * @inheritDoc
     */
    protected function handleRowColumn(string $formatted_row_column)/* : void*/
    {
        $this->tpl->setVariable("COLUMN", $formatted_row_column);

        $this->tpl->parseCurrentBlock();
    }


    /**
     * @inheritDoc
     */
    protected function renderTemplate(Table $component) : string
    {
        return self::output()->getHTML($this->tpl);
    }


    /**
     * @param Data|null $data
     * @param Table     $component
     */
    protected function handleNoDataText(/*?Data*/ $data, Table $component)/* : void*/
    {
        if ($data === null || $data->getDataCount() === 0) {
            $this->tpl->setCurrentBlock("no_data");

            $this->tpl->setVariable("NO_DATA_TEXT", htmlspecialchars($component->getDataFetcher()->getNoDataText($component)));

            $this->tpl->parseCurrentBlock();
        }
    }
}
