<?php
    function evtwork_work_takedown(&$parent, $params)
    {
        global $db;
        list($wid) = $params;
        $wrk = new DBwork($db);
        $wrk->__declare($wid);
        $wrk->__delete();
        $res = $db->query('SELECT id FROM attachment WHERE fk_work=%s',array($wid));
        while ($row = $db->toArray($res))
        	new EventInstance('work.attachment.takedown',array($row['id']));
    }

	/**
	 * @param array $params array(work_id)
	 */
    function chk_evtwork_work_takedown(&$parent, $params)
    {
        global $db;
        list($wid) = $params;
        if (!$_SESSION['admin']) return 'not.admin';        
        $wrk = new DBwork($db);
        if (!$wrk->__checkBy('id',$wid)) return 'work.nonexistant';
        $res = $db->query('SELECT id FROM attachment WHERE fk_work=%s',array($wid));
        while ($row = $db->toArray($res))
        {
        	$chk = new EventInstance('chk.work.attachment.takedown',array($row['id']));
        	if ($chk->wasStopped()) return 'attachment.failed';
        }
        
        
    }

EventManager::addHook('work.work.takedown','evtwork_work_takedown');
EventManager::addHook('chk.work.work.takedown','chk_evtwork_work_takedown');
?>