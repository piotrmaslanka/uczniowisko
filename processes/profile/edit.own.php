<?php
    function evtprofile_edit_own(&$parent, $params)
    {
        global $db;
        list($posts, $accid) = $params;
        $acc = new DBaccount($db);
        $acc->__declare($accid);
        if (!empty($posts['oldpass']))
        	$_SESSION['user']->changePasswd($posts['newpass1']);
        
        $acc->name = $posts['name'];
        $acc->surname = $posts['surname'];
        $acc->postal = $posts['postal'];
        $acc->address = $posts['address'];
        $acc->city = $posts['city'];
        $acc->phone = $posts['phone'];
        $acc->gg = $posts['gg'];
        $acc->bankaccount = $posts['bankaccount'];
        $acc->school = $posts['school'];
        
        $acc->__store();
    }

	/**
	 * @param array $params array($_POST, $acc_id)
	 */
    function chk_evtprofile_edit_own(&$parent, $params)
    {
        global $db;
        list($posts, $accid) = $params;
        $acc = new DBaccount($db);
        if (!$acc->__checkBy('id',$accid)) return 'account.nonexistant';

		if (preg_match('/[0-9]{2}-[0-9]{3}/', $posts['postal']) == 0) return 'postal.wrong';
		if (empty($posts['name'])) return 'name.empty';
		if (empty($posts['surname'])) return 'surname.empty';
        if (empty($posts['postal'])) return 'postal.empty';
        if (empty($posts['address'])) return 'address.empty';
        if (empty($posts['city'])) return 'city.empty';		
        
        if (!empty($posts['oldpass']))
        {
        	if (empty($posts['newpass1'])) return 'empty.newpass';
        	if ($posts['newpass1'] != $posts['newpass2']) return 'different.password';
        	if ($_SESSION['user']->getPasswd() != sha1($posts['oldpass'])) return 'wrong.password';	
        }
    }

EventManager::addHook('profile.edit.own','evtprofile_edit_own');
EventManager::addHook('chk.profile.edit.own','chk_evtprofile_edit_own');
?>