<?php
	/**
	 * @param array $params array(comment_id, nickname, text, status)
	 */
    function evtadmin_comment_manage(&$parent, $params)
    {
        global $db;
		list($cid, $nickname, $text, $status) = $params;
        $cmt = new DBcomment($db);
        $cmt->__declare($cid);
        $cmt->nick = $nickname;
        $cmt->data = str_replace('\"','"',$text);
        $cmt->status = $status;
        $cmt->__store();
    }

	/**
	 * @param array $params array(comment_id, nickname, text, status)
	 */
    function chk_evtadmin_comment_manage(&$parent, $params)
    {
		global $db;
		list($cid, $nickname, $text, $status) = $params;
		$cmt = new DBcomment($db);
		if (!$cmt->__checkBy('id',$cid)) return 'comment.nonexistant';
		if (empty($nickname)) return 'nickname.empty';
		if (empty($text)) return 'text.empty';
		if (!in_array($status, array(0,1))) return 'status.invalid';
		if (!$_SESSION['admin']) return 'not.admin';
    }

EventManager::addHook('admin.comment.manage','evtadmin_comment_manage');
EventManager::addHook('chk.admin.comment.manage','chk_evtadmin_comment_manage');
?>