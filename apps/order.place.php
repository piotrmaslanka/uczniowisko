<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
//	if (!APISession::isLogged()) Location(APPPATH.'profile.login');
	if (empty($argv[1])) Location(APPPATH);
	
	if (isset($_POST['email']))
	{
		conventional_event_call('order.order.place',array($argv[1], $_POST['adnots'], $_POST['email']));
	}		
	$wrk = new DBwork($db);
	if (!$wrk->__load($argv[1])) Location(APPPATH);
	if (!isset($_SESSION['user']))
		$tpl['email'] = '';
	else
		$tpl['email'] = $_SESSION['user']->getToken();

	$tpl['db_work_id'] = $wrk->id;	
	$tpl['db_work_fk_category'] = $wrk->fk_category;	
	$tpl['db_work_title'] = strip_tags($wrk->title);	
	$tpl['db_work_fk_account'] = strip_tags($wrk->fk_account);	
	$tpl['db_work_usedworks'] = strip_tags($wrk->usedworks);	
	$tpl['db_work_downloads'] = $wrk->downloads;	
	$tpl['db_work_added'] = $wrk->added;	
	$tpl['db_work_comment'] = strip_tags($wrk->comment);
	$tpl['db_work_grade'] = $wrk->grade;	
	$tpl['db_work_mode'] = $wrk->mode;
	$tpl['attachs'] = array();
	
	$cat = new DBcategory($db);
	$cat->__sload($wrk->fk_category, array('fk_overmode'));
	$tpl['db_category_fk_overmode'] = $cat->fk_overmode;
	
	$res = $db->query('SELECT description FROM attachment WHERE fk_work=%s',array($wrk->id));
	while($row=$db->toArray($res))$tpl['attachs'][] = $row;
	
	_show_template('order.place');
?>