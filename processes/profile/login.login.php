<?php
    function evtprofile_login_login(&$parent, $params)
    {
    	global $db;
    	list($user, $pass) = $params;
        $usr = new APIUser();
        $usr->createByLogin($user, $pass);
        
        $acc = new DBaccount($db);
        $acc->__loadBy('fk_tpusers',$usr->id);
        APISession::loginUser($usr);
    	$_SESSION['dbkeys']['account'] = $acc->id;
    	$_SESSION['profile']['name'] = $acc->name;
    	$_SESSION['profile']['surname'] = $acc->surname;
    	if ($usr->type == 1) $_SESSION['admin'] = true;
    }

	/**
	 * @param array $params array(login, user)
	 */
    function chk_evtprofile_login_login(&$parent, $params)
    {
    	list($user, $pass) = $params;
        $usr = new APIUser();
        if (!$usr->createByLogin($user, $pass)) return 'credentials.wrong';
    }

EventManager::addHook('profile.login.login','evtprofile_login_login');
EventManager::addHook('chk.profile.login.login','chk_evtprofile_login_login');
?>