<?php
	if (!$_SESSION['admin']) Location(APPPATH);
	
	conventional_event_call('work.work.takedown',array($argv[1]));
	
	_show_template('admin.worktakedown');
?>