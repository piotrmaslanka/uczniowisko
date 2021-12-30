<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	$om = new DBovermode($db);
	if (!$om->__checkBy('id', $argv[1])) Location(APPPATH);
	
	if ($argv[3]=='newcat')
	{
		$tpl['mode'] = 'newcat';
		conventional_event_call('admin.category.create',array($argv[2], $_POST['catname'], $argv[1]));
	} elseif ($argv[3]=='delete')
	{
		$tpl['mode'] = 'delete';
		conventional_event_call('admin.category.delete',array($argv[2]));		
	}
	
	$res = $db->query('SELECT category.id, category.name, category.fk_overmode, category.fk_category
					   FROM category
					   WHERE category.fk_overmode=%s',array($argv[1]));
					   
	$tpl['cats'] = array();
	$tpl['subcats'] = array();		
	while ($row = $db->toArray($res))
	{
		if ($row['fk_category']==0) $tpl['cats'][] = $row;
		else
		{
			if ($tpl['subcats'][$row['fk_category']] == null) $tpl['subcats'][$row['fk_category']] = array();
			$tpl['subcats'][$row['fk_category']][] = $row;
		}
	}		
		
	_show_template('admin.catmgr');
?>