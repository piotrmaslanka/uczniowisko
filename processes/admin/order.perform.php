<?php
    function evtadmin_order_perform(&$parent, $params)
    {
        global $db;
        list($row) = $params;
        new EventInstance('order.accept.pending', array($row['id']));
    }

    function chk_evtadmin_order_perform(&$parent, $params)   {}

EventManager::addHook('admin.order.perform','evtadmin_order_perform');
EventManager::addHook('chk.admin.order.perform','chk_evtadmin_order_perform');
?>