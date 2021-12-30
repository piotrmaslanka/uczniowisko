<?php
	/**
	 * @param array $params array(work_id, nickname, text)
	 */
    function evtwork_comment_add(&$parent, $params)
    {
    		// tu też faza
        global $db;
        list($wid, $nickname, $text) = $params;
        $db->query('UPDATE worder SET state=2 WHERE (fk_account=%s) AND (fk_work=%s)'
        		   ,array($_SESSION['dbkeys']['account'], $wid));
		$cmt = new DBcomment($db);
		$cmt->__create($_SESSION['dbkeys']['account'],
					   $wid,
					   time(),
					   $text,
					   $nickname);        	
    }

	/**
	 * @param array $params array(work_id, nickname, text)
	 */
    function chk_evtwork_comment_add(&$parent, $params)
    {
        global $db;
        list($wid, $nickname, $text) = $params;
        $wrk = new DBwork($db);
        if (!$wrk->__checkBy('id',$wid)) return 'work.nonexistant';
        $res = $db->query('SELECT id FROM worder WHERE (fk_work=%s) AND (fk_account=%s)',array($wid, $_SESSION['dbkeys']['account']));
        if ($db->getRows($res) == 0) return 'order.nonexistant';
        if (empty($text)) return 'text.empty';
        if (empty($nickname)) return 'nickname.empty';        
    }

EventManager::addHook('work.comment.add','evtwork_comment_add');
EventManager::addHook('chk.work.comment.add','chk_evtwork_comment_add');
?>