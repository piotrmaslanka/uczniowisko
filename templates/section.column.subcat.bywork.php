<?php
	global $db;
	$work = new DBwork($db);
	$work->__sload($tpl['parm_workid'], array('fk_category'));
	$tpl['parm_catid'] = $work->fk_category;
	show_template('section.column.subcat.bycat');
?>