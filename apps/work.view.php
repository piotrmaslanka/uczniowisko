<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (empty($argv[1])) Location(APPPATH);
	$wrk = new DBwork($db);
	$atr = new DBaccount($db);
	if (!$wrk->__load($argv[1])) Location(APPPATH);
	
	if ($atr->__sload($wrk->fk_account,array('city','school')))
	{
		$tpl['accavail'] = true;
		$tpl['db_account_city'] = $atr->city;
		$tpl['db_account_school'] = $atr->school;
	}
		
	$tpl['db_work_id'] = $wrk->id;	
	$tpl['db_work_fk_category'] = $wrk->fk_category;	
	$tpl['db_work_title'] = strip_tags($wrk->title);	
	$tpl['db_work_fk_account'] = $wrk->fk_account;	
	$tpl['db_work_usedworks'] = strip_tags($wrk->usedworks);	
	$tpl['db_work_downloads'] = $wrk->downloads;	
	$tpl['db_work_added'] = $wrk->added;	
	$tpl['db_work_comment'] = strip_tags($wrk->comment);
	$tpl['db_work_grade'] = $wrk->grade;	
	$tpl['db_work_mode'] = $wrk->mode;
	
	$tpl['attachs'] = array();
	$res = $db->query('SELECT description FROM attachment WHERE fk_work=%s',array($argv[1]));
	while($row=$db->toArray($res))$tpl['attachs'][] = $row;
	
	$tpl['comments'] = array();
	$res = $db->query('SELECT added, nick, data, id FROM comment WHERE (fk_work=%s) AND (status=1)',array($argv[1]));
	while ($row=$db->toArray($res))$tpl['comments'][] = $row;
	
	$cat = new DBcategory($db);
	$cat->__sload($wrk->fk_category, array('id','name','fk_overmode'));
	$tpl['db_category_id'] = $cat->id;
	$tpl['db_category_name'] = $cat->name;
	$tpl['db_overmode_id'] = $cat->fk_overmode;
	
	if (APISession::isLogged())
	{
		$res = $db->query('SELECT state FROM worder WHERE (fk_account=%s) AND (fk_work=%s)',array($_SESSION['dbkeys']['account'], $argv[1]));
		if ($db->getRows($res) > 0)
		{
			$row = $db->toArray($res);
			$tpl['add_comment'] = ($row['state']==1);
		}
	}
	_show_template('work.view');
?>