<?php
    function evtadmin_comment_delete(&$parent, $params)
    {
        global $db;
        list($cid) = $params;
        $cmt = new DBcomment($db);
        $cmt->__declare($cid);
        $cmt->__delete();
    }

	/**
	 * @param array $params array(comment_id)
	 */
    function chk_evtadmin_comment_delete(&$parent, $params)
    {
        global $db;
        list($cid) = $params;
        $cmt = new DBcomment($db);
        if (!$cmt->__checkBy('id',$cid)) return 'comment.nonexistant';
        if (!$_SESSION['admin']) return 'not.admin';
        
    }

EventManager::addHook('admin.comment.delete','evtadmin_comment_delete');
EventManager::addHook('chk.admin.comment.delete','chk_evtadmin_comment_delete');
?>