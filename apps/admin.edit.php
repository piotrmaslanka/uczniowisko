<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);		// this also verifies the user is logged
	if (empty($argv[1])) Location(APPPATH);
		
	$wrk = new DBwork($db);
	if (!$wrk->__checkBy('id',$argv[1])) Location(APPPATH);
	
	$atts = array();
	$res = $db->query('SELECT * FROM attachment WHERE fk_work=%s',array($argv[1]));
	if (!$res)
	{
		new APILogEvent(4,1,'admin.edit could not load attachments',
		'a query to load attachments by works id failed',
		array('work.id'=>$argv[1],
			  'account.id'=>$_SESSION['dbkeys']['account'],
			  'DBerror'=>$db->getLastError()),'error');
		Location(APPPATH.'mainpage.oops');
	}
		
	if ($argv[2]=='attachment.takedown')
	{
		$tpl['mode'] = 'attachment.takedown';
		conventional_event_call('work.attachment.takedown',array($argv[3]));
	} elseif (isset($_POST['title']))
	{
		$tpl['mode'] = 'change';	
	 	conventional_event_call('work.admin.change',array($argv[1], $_POST));
	}
	
	$wrk->__load($argv[1]);
	
	$tpl['db_work_id'] = $wrk->id;
	$tpl['db_work_title'] = $wrk->title;
	$tpl['db_work_usedworks'] = $wrk->usedworks;
	$tpl['db_work_comment'] = $wrk->comment;
	$tpl['db_work_grade'] = $wrk->grade;
	$tpl['db_work_mode'] = $wrk->mode;
	$tpl['db_work_fk_category'] = $wrk->fk_category;

	$mycat = new DBcategory($db); 
	$mycat->__sload($wrk->fk_category,array('fk_overmode'));
	
	$res = $db->query('SELECT * FROM category WHERE fk_overmode=%s',array($mycat->fk_overmode));
	
	/*----------- awful reparsing begins ------------*/
	/* the primary task of the awful reparsing is making $tpl['cats']
	 * which is very linear to display subcategories in proper order and
	 * with proper prefixes(--) that signify those are subcats 
	 */
	$main_cats = array();
	$sub_cats = array();
	while ($row = $db->toArray($res))
	{
		if ($row['fk_category'] == 0) $main_cats[] = $row;
		else
		{
			if (!isset($sub_cats[$row['fk_category']])) $sub_cats[$row['fk_category']] = array();
			$sub_cats[$row['fk_category']][] = $row;
		}
	}

	$tpl['cats'] = array();
	foreach ($main_cats as $maincat)
	{
		$tpl['cats'][] = array('id' => $maincat['id'], 'name' => $maincat['name']);
		if (!empty($sub_cats[$maincat['id']]))
			foreach ($sub_cats[$maincat['id']] as $subcat)
				$tpl['cats'][] = array('id' => $subcat['id'], 'name'=>'-- '.$subcat['name']);
	}
	/* --------------- awful reparsing ends ---------------------- */
	
	$auth = new DBaccount($db);
	if ($auth->__load($wrk->fk_account))
	{
		$tpl['db_account_id'] = $auth->id;
		$tpl['db_account_name'] = $auth->name;
		$tpl['db_account_surname'] = $auth->surname;
		$tpl['db_account_school'] = $auth->school;
		$tpl['db_account_city'] = $auth->city;
	} 	// else it's null and template will detect author is no more

	$res = $db->query('SELECT * FROM attachment WHERE fk_work=%s',array($wrk->id));
	while ($row = $db->toArray($res)) $atts[] = $row;
	$tpl['attachments'] = $atts;	
		
	_show_template('admin.edit');
?>