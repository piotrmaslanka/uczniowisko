<?php
	/**
	 * @param array $params array(order_id)
	 */
    function evtorder_accept_pending(&$parent, $params)
    {

        global $db;
        list($oid) = $params;
        $ord = new DBworder($db);
		$ord->__load($oid);
		$ord->state = 1;
		$ord->__store();
		
		$wrk = new DBwork($db);
		$acc = new DBaccount($db);
		$wrk->__sload($ord->fk_work, array('fk_account','downloads','fk_category'));
		$acc->__sload($wrk->fk_account, array('cash'));
		
		$cat = new DBcategory($db); $cat->__sload($wrk->fk_category, array('fk_overmode'));
		
		global $cfg;
		
		$acc->cash = $acc->cash + $cfg['cash_for_work'][$cat->fk_overmode];
		$acc->__store();      
		
		$wrk->downloads = $wrk->downloads + 1;
		$wrk->__store();

		$prc = new DBpurchase($db);
		$key = sha1(time());
		$salt = 0;
		while ($prc->__checkBy('vkey',$key)) {$salt++; $key=sha1(time().$salt); }

		$prc->__create($ord->id, time(), $key);

		new EventInstance('email.order.paid',array($ord, $key));
    }

	/**
	 * @param array $params array(order_id)
	 */
    function chk_evtorder_accept_pending(&$parent, $params)
    {
        global $db;
        list($oid) = $params;
        $ord = new DBworder($db);
        if (!$ord->__sload($oid,array('state'))) return 'order.nonexistant';
        if ($ord->state != 0) return 'not.zero';
        if (!$_SESSION['admin']) return 'not.admin';        
    }

EventManager::addHook('order.accept.pending','evtorder_accept_pending');
EventManager::addHook('chk.order.accept.pending','chk_evtorder_accept_pending');
?>