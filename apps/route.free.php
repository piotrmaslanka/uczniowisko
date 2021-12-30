<?php
	$cat = new DBcategory($db);
	if (!$cat->__load($argv[1])) Location(APPPATH);
	
	$row = $db->toArray($db->query("SELECT id FROM category WHERE fk_overmode=4"), array());
	Location(APPPATH.'free.list/'.$row['id']);
?>