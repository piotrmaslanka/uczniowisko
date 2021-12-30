<?php
	/**
	 * @param array $params array(DBworder)
	 */
    function evtemail_order_made(&$parent, $params)
    {
        global $db;
        list($ord, $adnots, $email) = $params;
        include_once('includes/email.php');
        $wrk = new DBwork($db);
        $wrk->__load($ord->fk_work);
        MAILsend($email,
        		'Uczniowisko.pl - przyjęto',
        		"Złożyłeś zamówienie $wrk->title! \nNumer tej transakcji to $ord->id \nNumer transakcji jest istotny, stanowi on identyfikator twojego zakupu. Jeśli wpłacasz ręcznie, koniecznie wpisz go w tytuł przelewu!");
        
        $adminmail = null;
        new FilterInstance('admin.email.get',null,$adminmail);
        MAILsend($adminmail, "Uczniowisko.pl - nowe zamówienie","Pojawiło się nowe zamówienie na prezentację $wrk->title!".
        "\nID konta: ".
        $_SESSION['dbkeys']['account']."\nImię: ".
        $_SESSION['profile']['name']."\nNazwisko: ".
        $_SESSION['profile']['surname']."\nID transakcji: ".
        $ord->id."\nE-mail: ".
        $email."\nAdnotacje: ".
        $adnots."\nLink aktywacyjny: ".
        "http://www.uczniowisko.pl/index.php/admin.order-perform/".md5($ord->ordered)."/$ord->id/");
        
    }
    
	/**
	 * unneeded
	 */
    function chk_evtemail_order_made(&$parent, $params) {}

EventManager::addHook('email.order.made','evtemail_order_made');
EventManager::addHook('chk.email.order.made','chk_evtemail_order_made');
?>