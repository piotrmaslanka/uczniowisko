<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	tplify_posts();
	
	if (isset($_POST['email']))
		conventional_event_call('help.contact.form',array($_POST['email'], $_POST['msg']));
	show_template('contact.form');
?>