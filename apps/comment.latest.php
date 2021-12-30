<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	$res = $db->query('SELECT comment.*, work.title
					   FROM comment
					   LEFT JOIN work
					   ON comment.fk_work=work.id
					   WHERE comment.status=1
					   ORDER BY comment.added DESC
					   LIMIT 0,'.$cfg['comments_latest']);
	$tpl['comments'] = array();
	while ($row = $db->toArray($res)) $tpl['comments'][] = $row;
	
	_show_template('comment.latest');
?>