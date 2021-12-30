<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!APISession::isLogged()) Location(APPPATH.'profile.login');
	
	$p = new DBpurchase($db);
	if (!$p->__loadBy('vkey',$argv[1])) 
	{
		$tpl['status'] = 'failure';
	} elseif ($p->activated+$cfg['activation_time'] < time())
	{
		$tpl['status'] = 'failure';
		$p->__delete();		
	} else	
	{
		$res = $db->query('SELECT attachment.*
				           FROM worder, work, attachment
				           WHERE (worder.id=%s) AND (work.id=worder.fk_work) AND (attachment.fk_work=work.id)',
				           array($p->fk_worder));
		$tpl['attachs'] = array();
		while ($row=$db->toArray($res)) $tpl['attachs'][] = $row;
		$tpl['status'] = 'success';
		$tpl['db_purchase_id'] = $p->id;
				           
	}
	
	_show_template('work.usrdownload');
?>