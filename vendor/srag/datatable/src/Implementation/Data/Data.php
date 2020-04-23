<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Implementation\Data;

use ILIAS\UI\Implementation\Component\ComponentHelper;
use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Data as DataInterface;
use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Row\RowData;
use srag\DataTableUI\SrContainerObjectMenu\Implementation\Utils\DataTableUITrait;
use srag\DIC\SrContainerObjectMenu\DICTrait;

/**
 * Class Data
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Implementation\Data
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class Data implements DataInterface
{

    use ComponentHelper;
    use DICTrait;
    use DataTableUITrait;

    /**
     * @var RowData[]
     */
    protected $data = [];
    /**
     * @var int
     */
    protected $max_count = 0;


    /**
     * Data constructor
     *
     * @param RowData[] $data
     * @param int       $max_count
     */
    public function __construct(array $data, int $max_count)
    {
        $this->data = $data;

        $this->max_count = $max_count;
    }


    /**
     * @inheritDoc
     */
    public function getData() : array
    {
        return $this->data;
    }


    /**
     * @inheritDoc
     */
    public function withData(array $data) : DataInterface
    {
        $classes = [RowData::class];
        $this->checkArgListElements("data", $data, $classes);

        $clone = clone $this;

        $clone->data = $data;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getMaxCount() : int
    {
        return $this->max_count;
    }


    /**
     * @inheritDoc
     */
    public function withMaxCount(int $max_count) : DataInterface
    {
        $clone = clone $this;

        $clone->max_count = $max_count;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getDataCount() : int
    {
        return count($this->data);
    }
}
