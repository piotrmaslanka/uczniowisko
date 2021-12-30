<?php
    function evtprofile_register_user(&$parent, $params)
    {
    	global $db;
    	list($posts) = $params;
        $uid = APIUserManagement::createUser($posts['username'], $posts['pass1'], $posts['email']);
        
        $acc = new DBaccount($db);
        $acc->__create($uid,
        			   $posts['name'],
        			   $posts['surname'],
        			   $posts['address'],
        			   $posts['postal'],
        			   $posts['city'],
        			   $posts['email'],
        			   $posts['phone'],
        			   (empty($posts['gg']) ? null : $posts['gg']),
        			   (empty($posts['bankaccount']) ? null : $posts['bankaccount']),
        			   (empty($posts['school']) ? null : $posts['school'])		
        			   );
    	
    	$_SESSION['dbkeys']['account'] = $acc->id;
    	$_SESSION['profile']['name'] = $acc->name;
    	$_SESSION['profile']['surname'] = $acc->surname;
    	$usr = new APIUser();
    	$usr->createForceId($uid);
    	APISession::loginUser($usr);
    	new EventInstance('email.register.success',array($posts));
    }
    
	/**
	 * @param array $params array($_POST)
	 */
    function chk_evtprofile_register_user(&$parent, $params)
    {
        list($posts) = $params;
        if (empty($posts['username'])) return 'login.empty';
        if (empty($posts['pass1'])) return 'password.empty';
        if (empty($posts['pass2'])) return 'password.empty';
        if (empty($posts['name'])) return 'name.empty';
        if (empty($posts['surname'])) return 'surname.empty';
        if (empty($posts['postal'])) return 'postal.empty';
        if (empty($posts['address'])) return 'address.empty';
        if (empty($posts['city'])) return 'city.empty';
        if (empty($posts['email'])) return 'email.empty';
        
        if ($posts['pass1'] != $posts['pass2']) return 'password.nomatch';
		if (APIUserManagement::userExists($posts['username'])) return 'login.taken';
		
		$emailvalid = null;
		new FilterInstance('helper.email.verify',$posts['email'],$emailvalid); 
		if (!$emailvalid)
			return 'email.wrong';
		if (preg_match('/[0-9]{2}-[0-9]{3}/', $posts['postal']) == 0) return 'postal.wrong';
		
		        
    }

EventManager::addHook('profile.register.user','evtprofile_register_user');
EventManager::addHook('chk.profile.register.user','chk_evtprofile_register_user');
?>