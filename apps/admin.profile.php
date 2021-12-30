<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	$usr = new DBaccount($db);
	if (!$usr->__load($argv[1])) Location(APPPATH);


	$tpl['db_account_id'] = $usr->id;
	$tpl['db_account_name'] = $usr->name;
	$tpl['db_account_surname'] = $usr->surname;
	$tpl['db_account_postal'] = $usr->postal;
	$tpl['db_account_address'] = $usr->address;
	$tpl['db_account_city'] = $usr->city;
	$tpl['db_account_email'] = $usr->email;
	$tpl['db_account_phone'] = $usr->phone;
	$tpl['db_account_gg'] = $usr->gg;
	$tpl['db_account_bankaccount'] = $usr->bankaccount;
	$tpl['db_account_school'] = $usr->school;
	
	_show_template('admin.profile');	
?>