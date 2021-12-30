<?php
    function evtprofile_cash_modify(&$parent, $params)
    {
    	global $db;
    	list($accid, $newcash) = $params;
		$acc = new DBaccount($db);
		$acc->__declare($accid);
		$acc->cash = $newcash;
		$acc->__store();        
    }

	/**
	 * @param array $params array(account_id, new_cash)
	 */
    function chk_evtprofile_cash_modify(&$parent, $params)
    {
    	global $db;
    	list($accid, $newcash) = $params;
        if (!$_SESSION['admin']) return 'not.admin';
        $acc = new DBaccount($db);
        if (!$acc->__checkBy('id', $accid)) return 'account.nonexistant';
    }

EventManager::addHook('profile.cash.modify','evtprofile_cash_modify');
EventManager::addHook('chk.profile.cash.modify','chk_evtprofile_cash_modify');
?>