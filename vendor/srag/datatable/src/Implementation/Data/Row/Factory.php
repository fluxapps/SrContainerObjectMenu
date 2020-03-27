<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Implementation\Data\Row;

use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Row\Factory as FactoryInterface;
use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Row\RowData;
use srag\DataTableUI\SrContainerObjectMenu\Implementation\Utils\DataTableUITrait;
use srag\DIC\SrContainerObjectMenu\DICTrait;

/**
 * Class Factory
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Implementation\Data\Row
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
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
     * Factory constructor
     */
    private function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function getter(string $row_id, /*object*/ $original_data) : RowData
    {
        return new GetterRowData($row_id, $original_data);
    }


    /**
     * @inheritDoc
     */
    public function property(string $row_id, /*object*/ $original_data) : RowData
    {
        return new PropertyRowData($row_id, $original_data);
    }
}
