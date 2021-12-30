<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!APISession::isLogged()) Location(APPPATH.'profile.login');
	
	$wrk = new DBwork($db);
	if (!$wrk->__sload($argv[1],array('title'))) Location(APPPATH);
	
	$tpl['db_work_title'] = strip_tags($wrk->title);
	
	if (isset($_POST['text']))
		conventional_event_call('work.comment.add',array($argv[1], $_POST['nick'], $_POST['text']));
			
	_show_template('comment.add');
?>