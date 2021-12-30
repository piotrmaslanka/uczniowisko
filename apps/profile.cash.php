<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	
	$acc = new DBaccount($db);
	if (!$acc->__checkBy('id',$argv[1])) Location(APPPATH);
	
	if (isset($_POST['cash']))
		conventional_event_call('profile.cash.modify',array($argv[1], $_POST['cash']));

	$acc->__sload($argv[1], array('cash'));
	
	$tpl['db_account_cash'] = $acc->cash;
	
	_show_template('profile.cash');
?>