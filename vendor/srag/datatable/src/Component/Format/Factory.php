<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Component\Format;

use srag\DataTableUI\SrContainerObjectMenu\Component\Format\Browser\Factory as BrowserFactory;

/**
 * Interface Factory
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Component\Format
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
