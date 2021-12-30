<?php
    function evtorder_delete_delete(&$parent, $params)
    {
        global $db;
        list($oid) = $params;
		$ord = new DBworder($db);
		$ord->__declare($oid);
		$db->query('DELETE FROM przelewy24 WHERE fk_worder=%s',array($ord->id));	        
		$db->query('DELETE FROM purchase WHERE fk_worder=%s',array($ord->id));	        
		$ord->__delete();
    }

	/**
	 * @param array $params array(order_id)
	 */
    function chk_evtorder_delete_delete(&$parent, $params)
    {
        global $db;
        list($oid) = $params;
        $ord = new DBworder($db);
        if (!$ord->__checkBy('id',$oid)) return 'order.nonexistant';
        if (!$_SESSION['admin']) return 'not.admin';
    }

EventManager::addHook('order.delete.delete','evtorder_delete_delete');
EventManager::addHook('chk.order.delete.delete','chk_evtorder_delete_delete');
?>