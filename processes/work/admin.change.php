<?php
    function evtwork_admin_change(&$parent, $params)
    {
    	global $db;
        list($workid, $posts) = $params;
        $work = new DBwork($db);
        $work->__declare($workid);
        $work->title = $posts['title'];
        $work->usedworks = str_replace('\"','"',$posts['usedworks']);
        $work->comment = str_replace('\"','"',$posts['comment']);
        $work->fk_category = $posts['category'];
        $work->grade = ($posts['grade'] == '' ? null : $posts['grade']);
        $work->mode = ($posts['mode'] == null ? 0 : $posts['mode']);        
        $work->__store();
        
        		// now, go directly to attachments
        $res = $db->query('SELECT id FROM attachment WHERE fk_work=%s',array($work->id));
        while ($row = $db->toArray($res))
        {
        	$att = new DBattachment($db);
        	$att->__declare($row['id']);
        	$att->description = $posts["desc".$row['id']];
        	$att->__store();
        }
    }

    function chk_evtwork_admin_change(&$parent, $params)
    {
    	global $db;
        list($workid, $posts) = $params;
        $work = new DBwork($db);
        $cat = new DBcategory($db);
        if (!$work->__checkBy('id',$workid)) return 'work.nonexistant';
        if (empty($posts['title'])) return 'title.empty';
        if (!$cat->__checkBy('id',$posts['category'])) return 'category.nonexistant';
        	// take note admin changes are less restrictive,
        	// for example, they allow to have empty file titles
        	// don't abuse the freedom, though   
    }

EventManager::addHook('work.admin.change','evtwork_admin_change');
EventManager::addHook('chk.work.admin.change','chk_evtwork_admin_change');
?>