<?php
	/**
	 * @param array $params array(account_id, $_POST)
	 */
    function evtemail_cashout_request(&$parent, $params)
    {
    	include_once('includes/email.php');
    	global $cfg;
    	list($accid,$posts) = $params;
    
        $adminmail = null;
        new FilterInstance('admin.email.get',null,$adminmail);
   
   		ini_set('display_errors',1);
   		error_reporting(E_ALL);
    
        MAILsend($adminmail,
        		'Uczniowisko.pl - cashout',
        		"Użytkownik chce cashoutu. \n".
        		"Imię: ".$posts['name']."\n".
        		"Ulica: ".$posts['street']."\n".
        		"Miasto: ".$posts['city']."\n".
        		"Kod pocztowy: ".$posts['postal']."\n".
        		"E-mail: ".$posts['email']."\n".
        		"Po zalogowaniu się odwiedź ".SRCPATH."index.php/profile.cash/".$accid." i dokonaj odpowiednich ustawień");
        		
    }

	/**
	 * @param array $params array(account_id,$_POST)
	 */
    function chk_evtemail_cashout_request(&$parent, $params)
    {
    	global $db;
    	list($accid, $posts) = $params;
    	$acc = new DBaccount($db);
    	if (!$acc->__checkBy('id',$accid)) return 'account.nonexistant';
    	if (empty($posts['name'])) return 'name.empty';
    	if (empty($posts['street'])) return 'street.empty';
    	if (empty($posts['postal'])) return 'postal.empty';
    	if (empty($posts['city'])) return 'city.empty';
    	if (empty($posts['email'])) return 'name.empty';

		$emailvalid = null;
		new FilterInstance('helper.email.verify',$posts['email'],$emailvalid); 
		if (!$emailvalid)
			return 'email.wrong';
		if (preg_match('/[0-9]{2}-[0-9]{3}/', $posts['postal']) == 0) return 'postal.wrong';
    	
	}

EventManager::addHook('email.cashout.request','evtemail_cashout_request');
EventManager::addHook('chk.email.cashout.request','chk_evtemail_cashout_request');
?>