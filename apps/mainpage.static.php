<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!file_exists('templates/static.'.$argv[1].'.php')) Location(APPPATH);
	
//	$allowed_sites = array('agreement','writtenab');
	
//	if (!in_array($argv[1],$allowed_sites)) Location(APPPATH);
	
	_show_template('static.'.$argv[1]);
?>