<?php
	/**
	 * Bootstrap for programs
	 * @package techplatform
	 */
	 
	require_once('config.php');
	require_once('stdlib.php');
	
	require_once('libdbapi.php');
	require_once('libsession.php');
	require_once('libuser.php');
	require_once('libevents.php');
	require_once('liblogging.php');
	require_once('libfilters.php');
	require_once('libusermanagement.php');

	
	$tpInternal['db'] = new APIDatabase(
	$tpInternal['cfg']['database_host'],
	$tpInternal['cfg']['database_user'],
	$tpInternal['cfg']['database_pass']);
	
	$tpInternal['db']->connect();
	$tpInternal['db']->selectDatabase($tpInternal['cfg']['database_dbase']);
	
	$tpl = array();			/* a dictionary, will be used in templating */
?>
