<?php
	$ff = new DBfree($db);
	if (!$ff->__load($argv[1]))
	{
		$frees = $db->toArray($db->query('SELECT id FROM free LIMIT 0,1'));
		Location(APPPATH.'free.view/'.$frees['id']);
	}
	
	
	$tpl['vf_title'] = $ff->title;
	$tpl['vf_body'] = $ff->body;
	$tpl['vf_id'] = $ff->id;
	$tpl['vf_cat'] = $ff->fk_category;

	_show_template('free.view');
?>