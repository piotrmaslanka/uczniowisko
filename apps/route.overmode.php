<?php
	if (!in_array($argv[1],array('1','2','3','4'))) Location(APPPATH);
	$row = $db->toArray($db->query("SELECT id FROM category WHERE fk_overmode=%s ORDER BY name LIMIT 0,1", array($argv[1])));
	if ($argv[1]=='4')
		Location(APPPATH.'free.list/'.$row['id']);
	else
		Location(APPPATH.'work.list/'.$row['id'].'/1/o');
?>