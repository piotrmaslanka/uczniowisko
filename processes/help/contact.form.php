<?php
    /**
    * Contact form
    */
    function evthelp_contact_form(&$parent, $params)
    {
    	global $cfg;
    	list($email, $msg) = $params;
		include_once('includes/email.php');
        MAILsend($cfg['email'],
        		'Uczniowisko.pl - kontakt',
        		$msg.' - Od: '.$email);
    }

    function chk_evthelp_contact_form(&$parent, $params)
    {
    	list($email, $msg) = $params;
    	$emlvalid = null;
    	new FilterInstance('helper.email.verify',$email,$emlvalid);
    	if (!$emlvalid) return 'email.invalid';
    	if (empty($msg)) return 'msg.empty';
    }

EventManager::addHook('help.contact.form','evthelp_contact_form');
EventManager::addHook('chk.help.contact.form','chk_evthelp_contact_form');
?>