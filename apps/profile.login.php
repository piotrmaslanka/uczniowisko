<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (isset($_POST['login']) && isset($_POST['pass']))
		conventional_event_call('profile.login.login',array($_POST['login'], $_POST['pass']));
	
		
				// -- do not have a valid template, there's no need for it. O Blaargag?
				
	$tpl['forcelogin'] = true;				
				
	_show_template('mainpage.index');
	 
	
	/* if (APISession::isLogged()) Location(APPPATH);
	
	_show_template('profile.login'); */
?>