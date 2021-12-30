<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (empty($argv[1])) Location(APPPATH);
	if (!APISession::isLogged()) Location(APPPATH.'profile.login');
	
	$ocat = new DBovermode($db);
		// assure the overmode exists
	if (!$ocat->__checkBy('id',$argv[1])) Location(APPPATH);
	
	
		// go along, load the cats
	if (!($res = $db->query('SELECT id, name, fk_category FROM category WHERE fk_overmode=%s',array($argv[1]))))
	{
		new APILogEvent(4,1,'work.submit failed to load categories',
		'could not load data from records indicated by picked overmode',
		array('overmode.id'=>$argv[1],
			  'account.id'=>$_SESSION['dbkeys']['account'],
			  'DBerror'=>$db->getLastError()),'error');
		Location(APPPATH.'mainpage.oops');
	}
	
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
	
		
	if (isset($_POST['title']))
	{
			// let us relieve event handlers from processing categories and
			// fetch it a clear list of what categories may be
			// especially that we got the data and they don't
		$categories = array();
		foreach ($tpl['cats'] as $cat) $categories[] = $cat['id'];
		conventional_event_call('work.submit.new',array($categories,
														$_POST,
														$argv[1]));
	}	
		
	_show_template('work.submit');
?>