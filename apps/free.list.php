<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (empty($argv[1])) Location(APPPATH);
	$cat = new DBcategory($db);
	
	if (empty($argv[2])) $page = 1; else $page = $argv[2];
	if ($page < 1) Location(APPPATH);
	
	if ($argv[3]=='o') $tpl['parm_dontdosubcats'] = true;

			/* Let $entered_cat be the DBcategory representation of picked category */
	$entered_cat = new DBcategory($db);
	if (!($entered_cat->__load($argv[1]))) Location(APPPATH);
	
	
	$res = mysql_query("SELECT COUNT(id) AS cnt FROM free WHERE (fk_category=$entered_cat->id) OR (fk_category IN (SELECT id FROM category WHERE fk_category=$entered_cat->id))");
	$row = mysql_fetch_array($res);
	$pages_max = ceil($row['cnt'] / $cfg['works_per_page']);

		/* Get works list */
		
	$res = mysql_query("SELECT * FROM free WHERE (fk_category=$entered_cat->id) OR (fk_category IN (SELECT id FROM category WHERE fk_category=$entered_cat->id)) LIMIT ".(($page-1)*$cfg['works_per_page']).", ".$cfg['works_per_page']);
	$tpl['listed_works'] = array();
	while ($row = mysql_fetch_array($res)) $tpl['listed_works'][] = $row;

		/* Now the god-damn, mother-fucking PAGINATION code.
		 * Just why the designer had to make it THAT stupid??? */
		 
	$tpl['pagination'] = array();
		/* We got 7 pagination entries available */
		
	/* Battalion of special cases ahead */
	if ($page<6)
	{
		for($i=1;$i<6;$i++)
			if ($page==$i)
				$tpl['pagination'][] = array('typ'=>'cur', 'val'=>$i);
			else
				$tpl['pagination'][] = array('typ'=>'link', 'val'=>$i);
		$tpl['pagination'][] = array('typ'=>'ellipsis');
		$tpl['pagination'][] = array('typ'=>'link', 'val'=>$pages_max);
	} elseif ($page > ($pages_max-5))
	{
		$tpl['pagination'][] = array('typ'=>'link', 'val'=>1);			
		$tpl['pagination'][] = array('typ'=>'ellipsis');
		for($i=$pages_max-4;$i<$pages_max+1;$i++)
			if ($page==$i)
				$tpl['pagination'][] = array('typ'=>'cur', 'val'=>$i);
			else
				$tpl['pagination'][] = array('typ'=>'link', 'val'=>$i);		
	} else
	{
		$tpl['pagination'][] = array('typ'=>'link', 'val'=>1);			
		$tpl['pagination'][] = array('typ'=>'ellipsis');
		$tpl['pagination'][] = array('typ'=>'link', 'val'=>$page-1);			
		$tpl['pagination'][] = array('typ'=>'cur', 'val'=>$page);			
		$tpl['pagination'][] = array('typ'=>'link', 'val'=>$page+1);			
		$tpl['pagination'][] = array('typ'=>'ellipsis');
		$tpl['pagination'][] = array('typ'=>'link', 'val'=>$pages_max);
	}
	
	foreach ($tpl['pagination'] as $k=>$v)
		if ($v['typ'] != 'ellipsis')
			if ($v['val'] >= $pages_max)
				$tpl['pagination'][$k] = array('typ'=>'none');

	_show_template('free.list');
?>