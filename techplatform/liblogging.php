<?php
	/**
	 * liblogging
	 * 
	 * Techplatform's logging library
	 * 
	 * @package techplatform
	 */

/**
 * Class used to log events in a convenient way
 * @package techplatform
 */	 
class APILogEvent
{
	/**
	 * @param int $nature Report nature, 0 - report, 1 - message, 2 - warning, 3 - error, 4- critical error 
	 * @param int $severity Report severity
	 * @param string $shortmsg Short error description
	 * @param string $problem_description Longer problem description
	 * @param array $relateddata Hash array, data name => data value
	 * @param string $targetfile File name in tpmeta/logs of the logfile
	 */
	function __construct($nature, $severity, $shortmsg, $content, $relateddata, $targetfile='logs')
	{
		$logfile = fopen('tpmeta/logs/'.$targetfile, 'ab');
		$natures = array(0 => 'Report', 1=>'Message', 2=>'Warning', 3=>'Error', 4=>'Critical error');
		fwrite($logfile, "-------------\nNature: ".$natures[$nature]."\nMessage ".date('Y-m-d H:i:s')."\nSeverity: ".$severity."\nDescription: ".$shortmsg."\nContent: \n".$content."\n\nRelated data:\n");
		foreach ($relateddata as $k=>$v)
			fwrite($logfile,"   $k: $v\n");
		fclose($logfile);
	}
}
?>
