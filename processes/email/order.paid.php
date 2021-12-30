<?php
	/**
	 * @param array $params array(DBworder, purchase_key)
	 */
    function evtemail_order_paid(&$parent, $params)
    {
        global $db;
        list($ord, $key) = $params;
        include_once('includes/email.php');
        $wrk = new DBwork($db);
        $wrk->__load($ord->fk_work);
        
        global $cfg;
        if ($cfg['debug'])
        	echo 'email.order.paid sent to '.$ord->email;
        
        MAILsend($ord->email,
        		'Uczniowisko.pl - zapłacono',
        		"Zapłaciłeś za zgłoszenie $wrk->title!\nNajpierw zaloguj się na stronie, a następnie użyj linku: http://uczniowisko.pl/index.php/work.usrdownload/$key");
        MAILsend('biuro@vision-it.pl',
                        'Uczniowisko.pl - zapłacono',
                        'Użytkownik '.$ord->fk_account.' zapłacił za '.$wrk->title);
    }

	/**
	 * unneeded
	 */
    function chk_evtemail_order_paid(&$parent, $params) {}

EventManager::addHook('email.order.paid','evtemail_order_paid');
EventManager::addHook('chk.email.order.paid','chk_evtemail_order_paid');
?>