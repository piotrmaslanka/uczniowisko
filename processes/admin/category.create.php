<?php
    function evtadmin_category_create(&$parent, $params)
    {
        global $db;
        list($catid, $catname, $oid) = $params;
        $cat = new DBcategory($db);
		$cat->__create($catname, $oid, $catid);        
    }
    
	/**
	 * assuming overmode existance check was made
	 * @param array $params (category_id, new_cat_name, overmode)
	 */
    function chk_evtadmin_category_create(&$parent, $params)
    {
        global $db;
        list($catid, $catname, $oid) = $params;
        $cat = new DBcategory($db);
        if ($catid != 0)
        	if (!$cat->__checkBy('id',$catid)) return 'parent.nonexistant';
        if (!$_SESSION['admin']) return 'not.admin';
    }

EventManager::addHook('admin.category.create','evtadmin_category_create');
EventManager::addHook('chk.admin.category.create','chk_evtadmin_category_create');
?>