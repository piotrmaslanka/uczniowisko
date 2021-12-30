<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	
	if (empty($argv[1])) Location(APPPATH);
	
	if ($argv[2]=='delete')
	{
		$tpl['mode']=='delete';
		conventional_event_call('admin.comment.delete',array($argv[1]));
	}
	
	if (isset($_POST['nick']))
	{
		$tpl['mode']=='modify';
		conventional_event_call('admin.comment.manage',array($argv[1],
															 $_POST['nick'],
															 $_POST['text'],
															 ($_POST['status']==1 ? 1 : 0)));
	}
	
	$cmt = new DBcomment($db);
	if (!$cmt->__load($argv[1])) Location(APPPATH);
	
	$tpl['db_comment_id'] = $cmt->id;
	$tpl['db_comment_nick'] = $cmt->nick;
	$tpl['db_comment_data'] = $cmt->data;
	$tpl['db_comment_added'] = $cmt->added;
	$tpl['db_comment_status'] = $cmt->status; 
	
	
	_show_template('admin.commentmanage');
?>