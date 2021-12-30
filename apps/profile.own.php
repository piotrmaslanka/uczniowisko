<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!APISession::isLogged()) Location(APPPATH);
	
	if (isset($_POST['address']))
		conventional_event_call('profile.edit.own',array($_POST, $_SESSION['dbkeys']['account']));

	$acc = new DBaccount($db);
	if (!$acc->__load($_SESSION['dbkeys']['account'])) Location(APPPATH);
	
	$tpl['db_account_name'] = $acc->name;	/* unchangeable */
	$tpl['db_account_surname'] = $acc->surname;	/* unchangeable */
	$tpl['db_account_address'] = $acc->address;
	$tpl['db_account_postal'] = $acc->postal;
	$tpl['db_account_city'] = $acc->city;
	$tpl['db_account_email'] = $acc->email;
	$tpl['db_account_phone'] = $acc->phone;
	$tpl['db_account_gg'] = $acc->gg;
	$tpl['db_account_bankaccount'] = $acc->bankaccount;
	$tpl['db_account_school'] = $acc->school;
	$tpl['db_account_cash'] = $acc->cash;
	
	_show_template('profile.own');
?>