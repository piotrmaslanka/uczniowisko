<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (empty($_POST['was'])) Location(APPPATH);
	
	if ($_POST['overmode'])
	{
		$res = $db->query('SELECT work.id, work.title
						   FROM work, category
						   WHERE (mode=1) AND ((title LIKE %s) OR (comment LIKE %s)) AND (work.fk_category=category.id) AND (category.fk_overmode=%s)',
						   array('%'.$_POST['was'].'%', '%'.$_POST['was'].'%', $_POST['overmode']));
		
	} else
	{
		$res = $db->query('SELECT id, title
						   FROM work
						   WHERE (mode=1) AND ((title LIKE %s) OR (comment LIKE %s))',
						   array('%'.$_POST['was'].'%', '%'.$_POST['was'].'%'));
	}
	
	$tpl['results'] = array();
	while ($row=$db->toArray($res)) $tpl['results'][] = $row;
	
	_show_template('fikus.szukarka');
?>