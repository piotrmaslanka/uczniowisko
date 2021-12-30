<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);		// this also verifies the user is logged
	_show_template('admin.panel');
?>