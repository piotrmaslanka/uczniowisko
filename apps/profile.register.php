<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['justregistered'])
			if (APISession::isLogged()) Location(APPPATH);
	
	if ($_SESSION['justregistered']) unset($_SESSION['justregistered']);
	
	tplify_posts();
	
	if (isset($_POST['username']))
		conventional_event_call('profile.register.user',array($_POST));
		
	if ($tpl['status']=='success') Location(APPPATH);
		
	_show_template('profile.register');
?>