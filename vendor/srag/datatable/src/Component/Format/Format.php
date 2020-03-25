<?php

namespace srag\DataTable\SrContainerObjectMenu\Component\Format;

use srag\DataTable\SrContainerObjectMenu\Component\Data\Data;
use srag\DataTable\SrContainerObjectMenu\Component\Settings\Settings;
use srag\DataTable\SrContainerObjectMenu\Component\Table;

/**
 * Interface Format
 *
 * @package srag\DataTable\SrContainerObjectMenu\Component\Format
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
interface Format
{

    /**
     * @var string
     */
    const FORMAT_BROWSER = "browser";
    /**
     * @var string
     */
    const FORMAT_CSV = "csv";
    /**
     * @var string
     */
    const FORMAT_EXCEL = "excel";
    /**
     * @var string
     */
    const FORMAT_PDF = "pdf";
    /**
     * @var string
     */
    const FORMAT_HTML = "html";
    /**
     * @var int
     */
    const OUTPUT_TYPE_PRINT = 1;
    /**
     * @var int
     */
    const OUTPUT_TYPE_DOWNLOAD = 2;


    /**
     * @return string
     */
    public function getFormatId() : string;


    /**
     * @param Table $component
     *
     * @return string
     */
    public function getDisplayTitle(Table $component) : string;


    /**
     * @return int
     */
    public function getOutputType() : int;


    /**
     * @return object
     */
    public function getTemplate()/* : object*/;


    /**
     * @param callable  $get_template
     * @param Table     $component
     * @param Data|null $data
     * @param Settings  $settings
     *
     * @return string
     */
    public function render(callable $get_template, Table $component, /*?Data*/ $data, Settings $settings) : string;


    /**
     * @param string $data
     * @param Table  $component
     */
    public function deliverDownload(string $data, Table $component)/* : void*/;
}
