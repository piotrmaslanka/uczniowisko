<?php
	/**
	 * @param array $params array($_POST)
	 */
    function evtemail_register_success(&$parent, $params)
    {
    	list($posts) = $params;
        include_once('includes/email.php');
        MAILsend($posts['email'],
        		'Uczniowisko.pl - zarejestrowano',
        		"Zarejestrowałeś się!");
    }

	/**
	 * unneeded
	 */
    function chk_evtemail_register_success(&$parent, $params) {}

EventManager::addHook('email.register.success','evtemail_register_success');
EventManager::addHook('chk.email.register.success','chk_evtemail_register_success');
?>