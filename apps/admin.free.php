<?php
	if (!$_SESSION['admin']) Location(APPPATH);

	$res = $db->query('SELECT * FROM category WHERE fk_overmode=4',array());
	
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
	
	if (empty($argv[1]))
	{
		$tpl['make'] = true;
		if (!empty($_POST['title'])) conventional_event_call('admin.free.add',array($_POST));	
		_show_template('admin.free');
	} else
	{
		$ff = new DBfree($db);
		if (!$ff->__load($argv[1])) Location(APPPATH);
		if (!empty($_POST['title'])) conventional_event_call('admin.free.edit',array($_POST, $ff));
		$tpl['vf_title'] = $ff->title;
		$tpl['vf_body'] = $ff->body;
		$tpl['db_work_fk_category'] = $ff->fk_category;
		$tpl['vf_id'] = $ff->id;
		_show_template('admin.free');
	}
?>