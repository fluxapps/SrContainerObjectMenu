<?php

namespace srag\DataTable\SrContainerObjectMenu\Implementation\Column\Formatter;

use srag\DataTable\SrContainerObjectMenu\Component\Column\Column;
use srag\DataTable\SrContainerObjectMenu\Component\Data\Row\RowData;
use srag\DataTable\SrContainerObjectMenu\Component\Format\Format;

/**
 * Class LanguageVariableFormatter
 *
 * @package srag\DataTable\SrContainerObjectMenu\Implementation\Column\Formatter
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  Theodor Truffer <tt@studer-raimann.ch>
 */
class LanguageVariableFormatter extends DefaultFormatter
{

    /**
     * @var string
     */
    protected $prefix;


    /**
     * @inheritDoc
     *
     * @param string $prefix
     */
    public function __construct(string $prefix)
    {
        parent::__construct();

        $this->prefix = $prefix;
    }


    /**
     * @inheritDoc
     */
    public function formatRowCell(Format $format, $value, Column $column, RowData $row, string $table_id) : string
    {
        $value = strval($value);

        if (!empty($value)) {
            if (!empty($this->prefix)) {
                $value = rtrim($this->prefix, "_") . "_" . $value;
            }

            $value = self::dic()->language()->txt($value);
        }

        return parent::formatRowCell($format, $value, $column, $row, $table_id);
    }
}
