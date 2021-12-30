<?php
    /**
    * Adds free thing
    */
    function evtadmin_free_add(&$parent, $params)
    {
        list($post) = $params;
        global $db;
        $ff = new DBfree($db);
        $ff->__create($post['title'], $post['body'], $post['category']);
    }

    function chk_evtadmin_free_add(&$parent, $params)
    {
    	global $db;
        list($post) = $params;
        if (empty($post['title'])) return 'title.empty';
        if (empty($post['body'])) return 'body.empty';
        $cat = new DBcategory($db);
        if (!$cat->__checkBy('id',$post['category'])) return 'category.invalid';        
    }

EventManager::addHook('admin.free.add','evtadmin_free_add');
EventManager::addHook('chk.admin.free.add','chk_evtadmin_free_add');
?>