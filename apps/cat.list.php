<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (empty($argv[1])) Location(APPPATH);
	
	$ovm = new DBovermode($db);
	if (!$ovm->__load($argv[1])) Location(APPPATH);
	
	$tpl['id'] = $ovm->id;
	$tpl['tag'] = $ovm->tag;
	
	$res = $db->query('SELECT * FROM category WHERE (fk_category=0) AND (fk_overmode=%s)',array($argv[1]));
	$tpl['cats'] = array();
	while($row = $db->toArray($res)) $tpl['cats'][] = $row;
	
	_show_template('cat.list');
?>