<?php
	/**
	 * Library for filter support
	 * 
	 * @package techplatform
	 */

/**
 * Single filter instance, used as an indirect way to conveniently invoke filters
 * @package techplatform
 */
class FilterInstance
{
	/**
	 * Invokes a filter
	 * @param string $name filter-to-be-invoked name
	 * @param array $data static data to be passed to filter
	 * @param array $filterdata dynamic data(which is expected to be changed) to be passed to filter 
	 */
	function __construct($name, $data, &$filterdata)
	{
		FilterManager::prefetch($name);
		$hooks = FilterManager::$filter_data[$name];
		if (!$hooks) return;
		foreach ($hooks as $hook)
		{
			$hook[0]($this, $data, $filterdata);
		}
	}
}

/**
 * Global static class which manages registered filters
 * @package techplatform
 */
class FilterManager
{
	static public $filter_data;
	/**
	 * Registers a new filter
	 * @param string $filter_name filter name
	 * @param string $filter_proc name of filter procedure
	 * @param string $docstring a documentation string for the filter
	 */
	static function addHook($filter_name, $filter_proc)
	{
		sapKey($filter_name, array($filter_proc), self::$filter_data);
	}
    /**
     * Prefetches given filter
     * @param string $filter_name filter name
     */
    static function prefetch($filter_name)
    {
    	list($pkg, $action, $order) = explode('.',$filter_name);
    	require_once("filters/$pkg.$action.$order.php");
    }	
}
?>