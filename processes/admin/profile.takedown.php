<?php
    function evtadmin_profile_takedown(&$parent, $params)
    {
        global $db;
        list($accid) = $params;
        $acc = new DBaccount($db);
        $acc->__sload($accid, array('fk_tpusers'));
        $usr = new APIUser();
        $usr->createForceId($acc->fk_tpusers);
        $db->query('DELETE worder WHERE fk_account=%s',array($usr->id));
        $usr->deleteUser();
        $acc->__delete();
    }

    function chk_evtadmin_profile_takedown(&$parent, $params)
    {
        global $db;
        list($accid) = $params;
        $acc = new DBaccount($db);
        if (!$acc->__checkBy('id',$accid)) return 'account.nonexistant';
        if (!$_SESSION['admin']) return 'not.admin';
    }

EventManager::addHook('admin.profile.takedown','evtadmin_profile_takedown');
EventManager::addHook('chk.admin.profile.takedown','chk_evtadmin_profile_takedown');
?>