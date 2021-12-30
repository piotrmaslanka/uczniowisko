<?php
    function evtadmin_category_delete(&$parent, $params)
    {
        global $db;
        list($catid) = $params;
		$cat = new DBcategory($db);
		$cat->__declare($catid);
		$cat->__delete();        
    }

	/**
	 * @param array $params (category_id)
	 */
    function chk_evtadmin_category_delete(&$parent, $params)
    {
        global $db;
        list($catid) = $params;
		$cat = new DBcategory($db);
		if (!$cat->__checkBy('id',$catid)) return 'category.nonexistant';
		if (!$_SESSION['admin']) return 'not.admin';
		$res = $db->query('SELECT id FROM work WHERE fk_category=%s',array($catid));
		if ($db->getRows($res) > 0) return 'not.empty';        
    }

EventManager::addHook('admin.category.delete','evtadmin_category_delete');
EventManager::addHook('chk.admin.category.delete','chk_evtadmin_category_delete');
?>