<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!APISession::isLogged()) Location(APPPATH.'profile.login');
	tplify_posts();
	
	if (isset($_POST['name']))
		conventional_event_call('email.cashout.request',array($_SESSION['dbkeys']['account'],$_POST));
	
	_show_template('cashout.request');
?>