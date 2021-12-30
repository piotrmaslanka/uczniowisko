<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	
	$res = $db->query('SELECT id, title, grade FROM work WHERE mode=0',array());
	$tpl['works'] = array();
	while ($row = $db->toArray($res)) $tpl['works'][] = $row;
	
	_show_template('admin.workstoaccept');
?>