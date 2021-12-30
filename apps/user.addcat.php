<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!APISession::isLogged()) Location(APPPATH);
	$om = new DBovermode($db);	if (!$om->__checkBy('id',$argv[1])) Location(APPPATH);
	
	if (isset($_POST['name']))
		conventional_event_call('work.add.category',array($argv[1], $_POST));
	
	$res = $db->query('SELECT * FROM category WHERE (fk_overmode=%s) AND (fk_category=0)',array($argv[1]));
	$tpl['cats'] = array();
	while ($row = $db->toArray($res)) $tpl['cats'][] = $row;
	
	show_template('user.addcat');
?>