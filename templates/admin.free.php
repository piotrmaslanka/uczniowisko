	<?php show_template('section.header'); ?>
    
    <div id="main_box"> <!-- main_box -->
        <div id="main_box_top"> <!-- main_box_top -->
        
            <div id="breadcrumbs_box"> <!-- breadcrumbs_box -->
                <ul>
                    <li>uczniowisko</li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="" title="">katalog prac</a></li>
                </ul>
            </div> <!-- [end] breadcrumbs_box -->
            
            <div class="clearfloat"> <!-- --> </div>
            
            <div id="column_l"> <!-- column_l -->
            
             <?php show_template('section.column.login'); ?>
                
                <?php show_template('section.column.plain.categories'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
            
     		
            
                <h1 class="header_column_r"><span>Zarządzaj pracą darmową</span></h1>
                	<?php if ($tpl['status']=='success'): ?>
		<?php if ($tpl['make']): ?>
			Utworzono nową pracę!
		<?php else: ?>
			Zaktualizowano pracę!
		<?php endif; ?>
	<?php endif; ?>

	<form method="post" action="<?php echo APPPATH; ?>admin.free<?php if (!$tpl['make']): ?>/<?php echo $tpl['vf_id']; ?><?php endif; ?>" >
	Tytuł: <input type="text" name="title" value="<?php echo $tpl['vf_title']; ?>" /><br />
	Kategoria:
					<select name="category">
					<?php foreach($tpl['cats'] as $cat)
						  echo '<option value="'.$cat['id'].'" '.($tpl['db_work_fk_category']==$cat['id'] ? 'selected="selected"' : '').'>'.$cat['name'].'</option>';
					?>
				</select><br />	
	Treść: <br />
	<textarea name="body" rows="15" cols="40" /><?php echo $tpl['vf_body']; ?></textarea>
	<br />
	<input type="submit" value="Wyślij" />
 	<?php show_template('section.footer'); ?>							
	
	<?php if (empty($tpl['make'])): ?>
	<a href="<?php echo APPPATH; ?>admin.freedel/<?php echo $tpl['vf_id']; ?>">Kasuj</a>
	<?php endif; ?>
                <div class="column_r_content"> <!-- column_r_content -->
                  
                  
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
<?php show_template('section.column.latest.stuff'); ?>
<?php show_template('section.footer'); ?>
	
	
	
	
	