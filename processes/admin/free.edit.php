<?php
    /**
    * Edits free thing
    */
    function evtadmin_free_edit(&$parent, $params)
    {
        list($post, $ff) = $params;
        $ff->title = $post['title'];
        $ff->body = $post['body'];
        $ff->fk_category = $post['category'];
        $ff->__store();
    }

	/*
	 * post, ff
	 */
    function chk_evtadmin_free_edit(&$parent, $params)
    {
        list($post, $ff) = $params;
        if (empty($post['title'])) return 'title.empty';
        if (empty($post['body'])) return 'body.empty';
        global $db;
        $cat = new DBcategory($db);
        if (!$cat->__checkBy('id',$post['category'])) return 'category.invalid';
    }

EventManager::addHook('admin.free.edit','evtadmin_free_edit');
EventManager::addHook('chk.admin.free.edit','chk_evtadmin_free_edit');
?>