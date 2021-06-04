<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Implementation\Column;

use srag\DataTableUI\SrContainerObjectMenu\Component\Column\Column as ColumnInterface;
use srag\DataTableUI\SrContainerObjectMenu\Component\Column\Factory as FactoryInterface;
use srag\DataTableUI\SrContainerObjectMenu\Component\Column\Formatter\Factory as FormatterFactoryInterface;
use srag\DataTableUI\SrContainerObjectMenu\Implementation\Column\Formatter\Factory as FormatterFactory;
use srag\DataTableUI\SrContainerObjectMenu\Implementation\Utils\DataTableUITrait;
use srag\DIC\SrContainerObjectMenu\DICTrait;

/**
 * Class Factory
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Implementation\Column
 */
class Factory implements FactoryInterface
{

    use DICTrait;
    use DataTableUITrait;

    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Factory constructor
     */
    private function __construct()
    {

    }


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @inheritDoc
     */
    public function column(string $key, string $title) : ColumnInterface
    {
        return new Column($key, $title);
    }


    /**
     * @inheritDoc
     */
    public function formatter() : FormatterFactoryInterface
    {
        return FormatterFactory::getInstance();
    }
}
