<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	$res = $db->query('SELECT * FROM category WHERE (fk_overmode=1) AND (fk_category=0)');
	$tpl['cats'] = array(); while ($row = $db->toArray($res)) $tpl['cats'][] = $row;

	_show_template('overmode.1');
?>