<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	
	conventional_event_call('admin.profile.takedown',array($argv[1]));
	
	_show_template('admin.profiletakedown');
?>