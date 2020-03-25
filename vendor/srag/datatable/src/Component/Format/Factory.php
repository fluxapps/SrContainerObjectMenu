<?php

namespace srag\DataTable\SrContainerObjectMenu\Component\Format;

use srag\DataTable\SrContainerObjectMenu\Component\Format\Browser\Factory as BrowserFactory;

/**
 * Interface Factory
 *
 * @package srag\DataTable\SrContainerObjectMenu\Component\Format
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
interface Factory
{

    /**
     * @return BrowserFactory
     */
    public function browser() : BrowserFactory;


    /**
     * @return Format
     */
    public function csv() : Format;


    /**
     * @return Format
     */
    public function excel() : Format;


    /**
     * @return Format
     */
    public function html() : Format;


    /**
     * @return Format
     */
    public function pdf() : Format;
}
