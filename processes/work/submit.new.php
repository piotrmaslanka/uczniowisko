<?php
    function evtwork_submit_new(&$parent, $params)
    {
		global $db;
 		list($categories, $posts, $overmode_id) = $params;
        
        /* uh, heavy work ahead */
        
        $work = new DBwork($db);
        $res = $work->__create($posts['category'],		//fk_category
        				$posts['title'],				//title
        				$_SESSION['dbkeys']['account'],	//fk_account
        				str_replace('\"','"',$posts['usedworks']),			//usedworks,
        				time(),							//added
        				str_replace('\"','"',$posts['comment']),				//comment
       			$posts['grade']=='' ? null : $posts['grade']); // grade

        if (!$res)
        {				
        	/* officially events may not be stopped this way.
        	 * however, if we fail at this thing, we should stop immediately
        	 * we don't know how much damage we have caused */
        	new APILogEvent(4,1,'submit.new process failed to create new work',
        	'processes/work/submit.new encountered an error whilst trying to add new
        	work to the database',
        	array('overmode.id'=>$overmode_id,
        		  'account.id'=>$_SESSION['dbkeys']['account'],
        		  'DBerror'=>$db->getLastError()),'error');
        	Location(APPPATH.'mainpage.oops');
        }
      			// ok, boss, now we're uploadin filez  
      for ($i=1; $i<=$posts['filecount']; $i++) 
      {
      	$att = new DBattachment($db);
      	$att->__create($_FILES["file$i"]['name'],//filename
      				   $work->id, 				 //fk_work
      				   $posts["desc$i"]);		 //description
      	move_uploaded_file($_FILES["file$i"]['tmp_name'],'files/'.$att->id);
      } 
        
    }

	/**
	 * Assuming overmode was verified before
	 * @param array $params array(possible_categoriesID_list, $_POST, overmode_id)
	 */
    function chk_evtwork_submit_new(&$parent, $params)
    {
       global $cfg;
	   list($categories, $posts, $overmode_id) = $params;
       if (empty($posts['title'])) return 'title.empty';  
       		// luser didn't agree on our agreement
       if ($posts['agreed'] != 1) return 'not.agreed';
       
       if (!in_array($posts['category'],$categories)) return 'category.invalid';
       
	   $was_anything_uploaded = false;
       
       for ($i=1; $i<=$posts['filecount']; $i++)
       {
   		/* now the rule is simple. We will disallow only the situation when 
  		 * the user has actually submitted a file but failed to caption it
  		 * in so called meantime we'll check whether he has actually uploaded
  		 * anything */
       		$desc_empty = empty($posts["desc$i"]);
       		$uploaded_ok = ($_FILES["file$i"]['error'] == UPLOAD_ERR_OK);
       		if ($desc_empty && $uploaded_ok) return 'caption.failed';
       		
       		if (!$_FILES["file$i"]['size']) return 'upload.failed';
       		if (!$_FILES["file$i"]['size'] > ($cfg['max_upload_size']*1024*1024)) return 'upload.toobig';
       		
       		if ($uploaded_ok) $was_anything_uploaded = true;
       }
       
       if (!$was_anything_uploaded) return 'nothing.uploaded';
    }

EventManager::addHook('work.submit.new','evtwork_submit_new');
EventManager::addHook('chk.work.submit.new','chk_evtwork_submit_new');
?>