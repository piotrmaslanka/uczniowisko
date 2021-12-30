<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl

	$res = $db->query('SELECT * FROM worder WHERE (MD5(ordered)=%s) and (id=%s)',array($argv[1], $argv[2]));
	if (!$row = $db->toArray($res)) Location(APPPATH);
	
	new EventInstance('admin.order.perform', array($row));
	

	echo 'OK';
?>