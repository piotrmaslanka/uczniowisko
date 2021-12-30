<?php
	/**
	 * 	stdlib
	 * 	
	 * Techplatform standard library
	 * Contains mostly syntactic sugar
	 * 
	 * @package techplatform
	 *  */
/**
 * 	Base class implementing last error reporting and passing
 * 
 * @package techplatform
 */	 
class LastErrorImplementation
{
	public $lasterror = '';
	public $lasterrordata = null;
	/**
	 * Sets new error message
	 * @param string $str new error message
	 */
	function setLastError($str, $data=null)
	{
		$this->lasterror = $str;
		$this->lasterrordata = $data;
	}
	/**
	 * Returns current error message
	 * @return string error message
	 */
	function getLastError()
	{
		return $this->lasterror;
	}
	/**
	 * Returns current error data
	 * @return mixed current error data
	 */
	function getLastErrorData()
	{
		return $this->lasterrordata;
	}
	/**
	 * Copies error message from other LastErrorImplementation instance
	 * @param LastErrorImplementation $LEIClass source instance
	 */
	function copyLastError(LastErrorImplementation $LEIClass)
	{
		$this->lasterror = $LEIClass->lasterror;
		$this->lasterrordata = $LEIClass->lasterrordata;
	}
}

/**
 * Performs HTTP header redirection under given address and kills the script
 * @param string $target URL or filename
 */
function Location($target)
{
	header("Location: $target"); 
	die();
}
/**
 * Encodes stuff in quoted_printable encoding
 * NOT-LEAN
 * @param string $string string to be encoded
 * @return string encoded string
 */
if (!function_exists('quoted_printable_encode'))
{	 	 
	function quoted_printable_encode($string) 
	{
	    return preg_replace('/[^\r\n]{73}[^=\r\n]{2}/', "$0=\r\n",
    					  	str_replace("%", "=", str_replace("%0D%0A", "\r\n",
	        				str_replace("%20"," ",rawurlencode($string))))); 	 
	}
}
/**
 * Performs in-place str_replace 
 * NOT-LEAN
 * @param string $search stuff to search
 * @param string $replace stuff to replace
 * @param string $value string to be worked upon
 */	 	 
 function estr_replace($search, $replace, &$value)
 {
 	$value = str_replace($search, $replace, $value);
 }
 /**
  * Given a hash table whose values are arrays if given key exists in the table:
  * 	if exists, value will be appended to key's value array
  * 	if doesn't, an array with single element - value - will be created as value for key
  * NOT-LEAN
  * @param mixed $key key
  * @param mixed $value value
  * @param array $array target array 
  */
 function sapKey($key, $value, &$array)
 {
 	if (empty($array[$key])) $array[$key] = array($value); else $array[$key][] = $value;
 }
 /** 
  * Flattens an array
  * NOT-LEAN
  * @param array $a array to be flattened
  * @return array flattened version of the array
  */
 function array_flatten(array $a)
 {
	$i = 0;
	while ($i < count($a)) 
	{
		if (is_array($a[$i])) 
		{
			array_splice($a, $i, 1, $a[$i]);
		} else 
		{
			$i++;
		}
	}
	return $a;
}
/**
 * Flattens an array in-place
 * NOT-LEAN
 * @param array $a array to be flattened
 */
function qarray_flatten(array &$a)
{
	$a = array_flatten($a);
}

/**
 * Performs a preg_match_all returning all the matches as an array
 * NOT-LEAN
 * @param string $regexp a PCRE string
 * @param string $object object to perform preg_match_all upon
 * @return array array of preg_matches
 */
function apreg_match($regexp, $object)
{
	$matchlist = array();
	preg_match_all($regexp, $object, $matchlist);
	return $matchlist;
}
/**
 * Formats timestamp to an acceptable format
 * NOT-LEAN
 * @param int $ts timestamp
 * @return string string format
 */
function sqlts($ts)
{
	return date('Y-m-d H:i:s', $ts);
}

/**
 * Renders a template
 * @param string $name template name
 */
function show_template($name)
{
	global $tpl;
	require_once('templates/'.$name.'.php');
}
/**
 * Renders a template to a string
 * @param string $name template name
 */
function sshow_template($name)
{
	global $tpl;
	ob_start();
	require_once('templates/'.$name.'.php');
	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
}
/**
 * Transfers values got by $_POST to $tpl with fv_ prefix
 */
function tplify_posts()
{
	global $tpl;
	foreach($_POST as $k=>$v) $tpl['fv_'.$k] = $v;
}
/**
 * Calls an event conventionally
 * @param string $evtname main event name(w/o chk.)
 * @param array $evtdata event data
 * @return bool returns whether the event has failed
 */
function conventional_event_call($evtname, $evtdata)
{
	global $tpl;
	$chk = new EventInstance('chk.'.$evtname, $evtdata);
	if ($chk->wasStopped())
	{
		$tpl['status'] = 'failure';
		$tpl['error'] = $chk->getErrMsg();
		return false;
	} else
	{
		new EventInstance($evtname, $evtdata);
		$tpl['status'] = 'success';
		return true;
	}
}

?>