<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Implementation\Column\Formatter;

use srag\CustomInputGUIs\SrContainerObjectMenu\PropertyFormGUI\Items\Items;
use srag\DataTableUI\SrContainerObjectMenu\Component\Column\Column;
use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Row\RowData;
use srag\DataTableUI\SrContainerObjectMenu\Component\Format\Format;

/**
 * Class ChainGetterFormatter
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Implementation\Column\Formatter
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ChainGetterFormatter extends DefaultFormatter
{

    /**
     * @var array
     */
    protected $chain;


    /**
     * @inheritDoc
     *
     * @param array $chain
     */
    public function __construct(array $chain)
    {
        parent::__construct();

        $this->chain = $chain;
    }


    /**
     * @inheritDoc
     */
    public function formatRowCell(Format $format, $value, Column $column, RowData $row, string $table_id) : string
    {
        $chains = $this->chain;

        $value = $row(array_shift($chains));

        foreach ($chains as $chain) {
            if (is_array($value)) {
                $value = $value[$chain];
            } else {
                if (method_exists($value, $chain)) {
                    $value = $value->{$chain}();
                } else {
                    $value = Items::getter($value, $chain);
                }
            }
        }

        return parent::formatRowCell($format, $value, $column, $row, $table_id);
    }
}
