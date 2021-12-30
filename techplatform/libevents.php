<?php
	/**
	 * Library for event support
	 * 
	 * @package techplatform
	 */
	
/**
 * Class used to indirectly invoke events(processes) in a convenient way
 * @package techplatform
 */ 
class EventInstance
{
	/**
	 * Says whether an error in event has occurred, event will be halted
	 * @var bool
	 */
	protected $wasError = false;
	/**
	 * Records error name
	 * @var array
	 */
	protected $errName = false;
	/**
	 * Records error data
	 * @var array
	 */
	protected $errData = false;
	/**
	 * Records return data. Array entry per event.
	 * @var array
	 */
	protected $returnData = array();
	/**
	 * Does an event with given name and params
	 */
	function __construct($name, $params)
	{
		EventManager::prefetch($name);
		$hooks = EventManager::$event_data[$name];
		if (!$hooks) return;	
		foreach ($hooks as $hook)
		{
			$ret = $hook[0]($this, $params);
			if (is_string($ret)) $this->signalError($ret);
			if ($this->wasError) break;
		}
	}
	/**
	 * Records data
	 */
	function addData($data)
	{
		$this->returnData[] = $data;
	}
	/**
	 * Records an error
	 * @param string $errmsg error message
	 */
	function signalError($errmsg, $errdata=null)
	{
		$this->wasError = true;
		$this->errName = $errmsg;
		$this->errData = $errdata;	
	}
	/**
	 * Checks whether the function was stopped by an error
	 * @return bool returns whether the function was stopped by an error
	 */
	function wasStopped()
	{
		return ($this->wasError);
	}
	/**
	 * Gets error name
	 * @return string error message
	 */
	function getErrMsg()
	{
		return $this->errName;
	}
	/**
	 * Checks whether the error message was the same as passed
	 * @param string $error desired error
	 * @return bool returns true if an error occurred and was the same as given
	 */
	function wasError($error)
	{
		return (($this->wasError) && ($this->errName == $error));
	}
	/**
	 * Returns data accumulated by the event
	 * @return array data produced by the event
	 */
	function getData()
	{
		return $this->returnData;
	}
	
}

/**
 * Static class for managing events
 * @package techplatform
 */
class EventManager
{
	/**
	 * Events data
	 * Hasharray - 'event_name' = array(array(event_proc, event_doc) times n)
	 * @var array 
	 */
	static public $event_data = array();
	/**
	 * Registers an event
	 * @param string $event_name event's name
	 * @param string $event_proc callback to be called
	 * @param string $docstring documentation inline
	 */
    static function addHook($event_name, $event_proc)
    {
    	sapKey($event_name, array($event_proc), self::$event_data);
    }
    /**
     * Prefetches given event
     * @param string $event_name event name
     */
    static function prefetch($event_name)
    {
    	if (substr($event_name, 0, 4)=='chk.') $event_name = substr($event_name, 4);
    	list($pkg, $action, $order) = explode('.',$event_name);
    	require_once("processes/$pkg/$action.$order.php");
    }
}

?>