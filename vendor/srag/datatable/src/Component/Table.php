<?php

namespace srag\DataTableUI\SrContainerObjectMenu\Component;

use ILIAS\UI\Component\Component;
use ILIAS\UI\Component\Input\Field\FilterInput;
use ILIAS\UI\Component\Input\Field\Input as FilterInput54;
use srag\DataTableUI\SrContainerObjectMenu\Component\Column\Column;
use srag\DataTableUI\SrContainerObjectMenu\Component\Data\Fetcher\DataFetcher;
use srag\DataTableUI\SrContainerObjectMenu\Component\Format\Browser\BrowserFormat;
use srag\DataTableUI\SrContainerObjectMenu\Component\Format\Format;
use srag\DataTableUI\SrContainerObjectMenu\Component\Settings\Storage\SettingsStorage;
use srag\DIC\SrContainerObjectMenu\Plugin\Pluginable;
use srag\DIC\SrContainerObjectMenu\Plugin\PluginInterface;

/**
 * Interface Table
 *
 * @package srag\DataTableUI\SrContainerObjectMenu\Component
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
interface Table extends Component, Pluginable
{

    /**
     * @var string
     */
    const ACTION_GET_VAR = "row_id";
    /**
     * @var string
     */
    const MULTIPLE_SELECT_POST_VAR = "selected_row_ids";
    /**
     * @var string
     */
    const LANG_MODULE = "datatableui";


    /**
     * @param PluginInterface $plugin
     *
     * @return self
     */
    public function withPlugin(PluginInterface $plugin) : self;


    /**
     * @return string
     */
    public function getTableId() : string;


    /**
     * @param string $table_id
     *
     * @return self
     */
    public function withTableId(string $table_id) : self;


    /**
     * @return string
     */
    public function getActionUrl() : string;


    /**
     * @param string $action_url
     *
     * @return self
     */
    public function withActionUrl(string $action_url) : self;


    /**
     * @return string
     */
    public function getTitle() : string;


    /**
     * @param string $title
     *
     * @return self
     */
    public function withTitle(string $title) : self;


    /**
     * @return Column[]
     */
    public function getColumns() : array;


    /**
     * @param Column[] $columns
     *
     * @return self
     */
    public function withColumns(array $columns) : self;


    /**
     * @return DataFetcher
     */
    public function getDataFetcher() : DataFetcher;


    /**
     * @param DataFetcher $data_fetcher
     *
     * @return self
     */
    public function withFetchData(DataFetcher $data_fetcher) : self;


    /**
     * @return FilterInput[]|FilterInput54[]
     */
    public function getFilterFields() : array;


    /**
     * @param FilterInput[]|FilterInput54[] $filter_fields
     *
     * @return self
     */
    public function withFilterFields(array $filter_fields) : self;


    /**
     * @return BrowserFormat
     */
    public function getBrowserFormat() : BrowserFormat;


    /**
     * @param BrowserFormat $browser_format
     *
     * @return self
     */
    public function withBrowserFormat(BrowserFormat $browser_format) : self;


    /**
     * @return Format[]
     */
    public function getFormats() : array;


    /**
     * @param Format[] $formats
     *
     * @return self
     */
    public function withFormats(array $formats) : self;


    /**
     * @return string[]
     */
    public function getMultipleActions() : array;


    /**
     * @param string[] $multiple_actions
     *
     * @return self
     */
    public function withMultipleActions(array $multiple_actions) : self;


    /**
     * @return SettingsStorage
     */
    public function getSettingsStorage() : SettingsStorage;


    /**
     * @param SettingsStorage $settings_storage
     *
     * @return self
     */
    public function withSettingsStorage(SettingsStorage $settings_storage) : self;
}
