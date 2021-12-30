<?php
	/**
	 * @param array $params array(work_id, adnots, posted email)
	 */
    function evtorder_order_place(&$parent, $params)
    {
     	global $db;
     	list($wid, $adnots, $email) = $params;
     	$ord = new DBworder($db);
     	
     	if (isset($_SESSION['dbkeys']['account']))
     		$user_id = $_SESSION['dbkeys']['account'];
     	else
     		$user_id = 0;
     	
     	$ord->__create($user_id,
     				   time(),
     				   $email,
     				   $wid,
     				   str_replace('\"','"',$adnots));
     	new EventInstance('email.order.made',array($ord, $adnots, $email));
     	
     	$_SESSION['oid'] = $ord->id;
     	
     	$wrk = new DBwork($db);
     	$wrk->__sload($wid, array('fk_category'));
     	$cat = new DBcategory($db);
     	$cat->__sload($wrk->fk_category, array('fk_overmode'));
    }
    
	/**
	 * @param array $params array(work_id, adnots, posted email)
	 */
    function chk_evtorder_order_place(&$parent, $params)
    {
        global $db;
        list($wid, $adnots, $email) = $params;
        $wrk = new DBwork($db);
        if (!$wrk->__checkBy('id',$wid)) return 'work.nonexistant';
        $emailvalid = null;
        new FilterInstance('helper.email.verify',$email,$emailvalid);
        if (!$emailvalid) return 'email.invalid';
    }

EventManager::addHook('order.order.place','evtorder_order_place');
EventManager::addHook('chk.order.order.place','chk_evtorder_order_place');
?>