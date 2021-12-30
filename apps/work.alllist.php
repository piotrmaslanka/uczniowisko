<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (empty($argv[1])) Location(APPPATH);
	$om = new DBovermode($db);
	if (!$om->__sload($argv[1],array('tag'))) Location(APPPATH);
	
	$counter = $db->query('SELECT work.id, work.title
						   FROM work, category
			               WHERE (mode>0) AND (work.fk_category=category.id) AND (category.fk_overmode=%s)',array($argv[1]));							   	
	$tpl['works'] = array();
	while ($row=$db->toArray($counter))$tpl['works'][] = $row;
	
	$tpl['db_overmode_tag'] = $om->tag;

	_show_template('work.alllist');
?>