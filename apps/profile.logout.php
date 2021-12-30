<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!APISession::isLogged()) Location(APPPATH.'profile.login');
	APISession::logoutUser();
	$_SESSION = array();
	Location(APPPATH);
?>