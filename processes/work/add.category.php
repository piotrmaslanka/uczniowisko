<?php
    /**
    * Adds a category - userland
    */
    function evtwork_add_category(&$parent, $params)
    {
    	global $db;
    	list($om, $posts) = $params;   
		$cat = new DBcategory($db);
		$cat->__create($posts['name'], $om, (int)$posts['parent']);        
    }

    function chk_evtwork_add_category(&$parent, $params)
    {
    	global $db;
    	list($om, $posts) = $params;   
    		//overmode checked
    	if ($posts['parent'] != 0)
    	{
    		$res = $db->query('SELECT id FROM category WHERE fk_category=%s',array($posts['parent']));
    		if ($db->getRows($res) == 0) return 'parent.nonexistant';
    		$res = $db->query('SELECT fk_category FROM category WHERE id=%s',array($posts['parent']));
    		$row = $db->toArray($res);
    		if ($row['fk_category'] != 0) return 'invalid.parent';    		
    	}
    }

EventManager::addHook('work.add.category','evtwork_add_category');
EventManager::addHook('chk.work.add.category','chk_evtwork_add_category');
?>