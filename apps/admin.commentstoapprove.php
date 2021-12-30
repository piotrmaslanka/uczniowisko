<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	
	$res = $db->query('SELECT comment.nick, comment.id, work.title, work.id AS wid FROM comment, work WHERE
					   (comment.fk_work=work.id) AND (comment.status=0)');
	$tpl['comments'] = array();
	while ($row=$db->toArray($res)) $tpl['comments'][] = $row;
	
	_show_template('admin.commentstoapprove');
?>