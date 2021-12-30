<?php
	if (!$_SESSION['admin']) Location(APPPATH);
	$ff = new DBfree($db);
	if (!$ff->__load($argv[1])) Location(APPPATH);
	
	$ff->__delete();
	
	_show_template('admin.freedel');
?> 