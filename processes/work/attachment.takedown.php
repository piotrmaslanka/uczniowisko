<?php
    function evtwork_attachment_takedown(&$parent, $params)
    {
     	global $db;
     	list($attid) = $params;
     	$att = new DBattachment($db);
     	$att->__declare($attid);
     	$att->__delete();
     	unlink('files/'.$attid);
    }

    function chk_evtwork_attachment_takedown(&$parent, $params)
    {
    	global $db;
        list($attid) = $params;
        $att = new DBattachment($db);
        if (!$att->__checkBy('id',$attid)) return 'attachment.nonexistant';
        if (!$_SESSION['admin']) return 'not.admin';
    }

EventManager::addHook('work.attachment.takedown','evtwork_attachment_takedown');
EventManager::addHook('chk.work.attachment.takedown','chk_evtwork_attachment_takedown');
?>