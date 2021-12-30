<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	
	$res = $db->query('SELECT worder.*, account.name, account.surname, work.title, work.id AS wid 
					   FROM worder
					   LEFT JOIN account ON account.id=worder.fk_account
					   LEFT JOIN work ON work.id=worder.fk_work
					   WHERE worder.state=0');
	$tpl['orders'] = array();
	while ($row=$db->toArray($res)) 
	{
		$res2 = $db->query('SELECT * FROM przelewy24 where fk_worder=%s',array($row['id']));
		$row['przelewy24'] = $db->toArray($res2);
		$tpl['orders'][] = $row;
	}
	
	_show_template('order.review');
?>