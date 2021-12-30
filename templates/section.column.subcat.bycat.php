<?php
	global $db;
	$direct_node = new DBcategory($db);
	$direct_node->__load($tpl['parm_catid']);
	
	// Direct node -> direct ancestor of Work
	// Root category -> root category of Work
	
	if ($direct_node->fk_category != 0)
	{
		$root_category = new DBcategory($db);
		$root_category->__load($direct_node->fk_category);
	} else $root_category = $direct_node;


	$tac_overmode = $root_category->fk_overmode;
	
	if ($tpl['parm_dontdosubcats']==true)
		$do_subcats = false;
	else
		$do_subcats = true;
	
	function countworks($cat_id,$tac_overmode)
	{
		if ($tac_overmode == 4)
		{
			$res = mysql_query("SELECT COUNT(id) AS xid FROM free WHERE (fk_category=$cat_id) OR (fk_category IN (SELECT id FROM category WHERE fk_category=$cat_id))");
		}
		else
		{		
			$res = mysql_query("SELECT COUNT(id) AS xid FROM work WHERE ((fk_category=$cat_id) OR (fk_category IN (SELECT id FROM category WHERE fk_category=$cat_id))) AND (mode>0)");
		}
		$i = 0;
		while ($row = mysql_fetch_array($res)) $i += $row['xid'];
		return $i;
	}
	
	function perform_rendering($tac_overmode, $root_category, $direct_node, $do_subcats)
	{
		?><div class="category_list_background"><div class="category_list_box"><ul><?php
		$res = mysql_query("SELECT * FROM category WHERE (fk_overmode=$tac_overmode) AND (fk_category=0) ORDER BY name");
		while ($row=mysql_fetch_array($res))
		{
			if ($tac_overmode != 4)
			{
			?><li><span><b><a href="<?php echo APPPATH; ?>work.list/<?php echo $row['id']; ?>" title="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a></b></span><span> (<?php echo countworks($row['id'],$tac_overmode); ?>)</span></li><?php
			} else
			{
			?><li><span><b><a href="<?php echo APPPATH; ?>free.list/<?php echo $row['id']; ?>" title="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a></b></span><span> (<?php echo countworks($row['id'],$tac_overmode); ?>)</span></li><?php										
			}
			if ($do_subcats)
			if ((($direct_node->fk_category == $root_category->id) || ($root_category->id == $direct_node->id)) && ($root_category->id== $row['id']))
			{
				?><li class="subcategory_list"><ul><?php
				$res2 = mysql_query("SELECT * FROM category WHERE fk_category=".$root_category->id."  ORDER BY name");
				while ($row2=mysql_fetch_array($res2))
				{
					if ($tac_overmode == 4)
					{
					?><li><span><a href="<?php echo APPPATH; ?>free.list/<?php echo $row2['id']; ?>" title="<?php echo $row2['name']; ?>"><?php echo $row2['name']; ?></a></span><span> (<?php echo countworks($row2['id'],$tac_overmode); ?>)</span></li><?php						
					} else
					{
					?><li><span><a href="<?php echo APPPATH; ?>work.list/<?php echo $row2['id']; ?>" title="<?php echo $row2['name']; ?>"><?php echo $row2['name']; ?></a></span><span> (<?php echo countworks($row2['id'],$tac_overmode); ?>)</span></li><?php
					}
				}
				?></ul></li><?php
			}
		}
		?></ul></div></div><?php 			
	}
?>
                <h3 class="header_column_l">Katalogi Prac</h3>                
                <div class="column_l_content"> <!-- column_l_content -->
                    <div class="button_1_box">
                        <a class="button_1_left" href="<?php echo APPPATH; ?>route.overmode/1" title="Prezentacje maturalne"><span>Prezentacje<br />maturalne</span></a>
                         <a class="button_1_right" href="<?php echo APPPATH; ?>work.submit/1" title="Dodaj"></a>
                    </div>
					<?php if ($tac_overmode==1) perform_rendering($tac_overmode, $root_category, $direct_node, $do_subcats); ?>               
                    <div class="button_1_box">
                        <a class="button_1_left" href="<?php echo APPPATH; ?>route.overmode/2" title="Liceum i technikum"><span>Liceum<br />i technikum</span></a>
                         <a class="button_1_right" href="<?php echo APPPATH; ?>work.submit/2" title="Dodaj"></a>
                    </div>
					<?php if ($tac_overmode==2) perform_rendering($tac_overmode, $root_category, $direct_node, $do_subcats); ?>               
                    <div class="button_1_box">
                        <a class="button_1_left" href="<?php echo APPPATH; ?>route.overmode/3" title="Studia i podyplomowe"><span>Studia<br />i podyplomowe</span></a>
                         <a class="button_1_right" href="<?php echo APPPATH; ?>work.submit/3" title="Dodaj"></a>
                    </div>
					<?php if ($tac_overmode==3) perform_rendering($tac_overmode, $root_category, $direct_node, $do_subcats); ?>                                   
                    <div class="button_2_box">
                        <a href="<?php echo APPPATH; ?>route.overmode/4" title="Forum"><span>Darmowe materiały<span></a>
                    </div>
					<?php if ($tac_overmode==4) perform_rendering($tac_overmode, $root_category, $direct_node, $do_subcats); ?>               
                    <div class="button_2_box">
                        <a href="<?php echo SRCPATH; ?>forum" title="Forum"><span>Forum<span></a>
                    </div>
                
                </div> <!-- [end] column_l_content -->