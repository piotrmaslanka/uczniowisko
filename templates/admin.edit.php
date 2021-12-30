<?php include('section.header.php'); global $argv; ?>

    
    <div class="clearfloat"> <!-- --> </div>
    
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
            
                <h1 class="header_column_r"><span>Praca</span></h1>
                
                
	<?php if ($tpl['mode']=='attachment.takedown'): ?>
		<?php if ($tpl['status']=='success'): ?>
			Usunięto załącznik
		<?php elseif ($tpl['status']=='failure'): ?>
			Nie usunięto załącznika, gdyż <?php echo $tpl['error']; ?><br />
		<?php endif; ?>
	<?php elseif ($tpl['mode']=='change'): ?>
		<?php if ($tpl['status']=='success'): ?>
			Zmieniono dane!
		<?php elseif ($tpl['status']=='failure'): ?>
			Nie zmieniono danych, gdyż <?php echo $tpl['error']; ?><br />
		<?php endif; ?>
	<?php endif; ?>		
	
	
	ID: <?php echo $tpl['db_work_id']; ?>
	<form action="<?php echo APPPATH; ?>admin.edit/<?php echo $argv[1]; ?>" method="post">
	Tytuł: <input type="text" name="title" value="<?php echo $tpl['db_work_title']; ?>" /><br />
	Kategoria:
					<select name="category">
					<?php foreach($tpl['cats'] as $cat)
						  echo '<option value="'.$cat['id'].'" '.($tpl['db_work_fk_category']==$cat['id'] ? 'selected="selected"' : '').'>'.$cat['name'].'</option>';
					?>
				</select><br />
	
	Prace użyte: <br />
	<textarea name="usedworks" rows="5" cols="40"><?php echo $tpl['db_work_usedworks']; ?></textarea><br />
	Komentarz: <br />
	<textarea name="comment" rows="5" cols="40"><?php echo $tpl['db_work_comment']; ?></textarea><br />
	Ocena: <input type="text" name="grade" value="<?php echo $tpl['db_work_grade']; ?>" /><br />
	Autor:
	<?php if (empty($tpl['db_account_id'])): ?><i>nie istnieje</i><?php else: 
	echo $tpl['db_account_name'].' '.$tpl['db_account_surname'].' ID: '.$tpl['db_account_id'];
	endif; ?><br />
	Miasto: <?php echo $tpl['db_account_city']; ?><br />
	Szkoła: <?php echo $tpl['db_account_school']; ?><br />
	<a href="<?php echo APPPATH; ?>admin.profile/<?php echo $tpl['db_account_id']; ?>">Przejdź do profilu</a><br />
	<input type="checkbox" name="mode" value="1" <?php if($tpl['db_work_mode']==1): ?>checked="checked"<?php endif; ?>> Przeglądnięto i dopuszczono<br />	
	 <?php foreach($tpl['attachments'] as $attach)
	 {
	 	echo('<p><input type="text" name="desc'.$attach['id'].'" value="'.$attach['description'].'" /><br />');
	 	echo('<a href="'.APPPATH.'download.attachment/'.$attach['id'].'">'.$attach['filename'].'</a><br />');
		echo('<a href="'.APPPATH.'admin.edit/'.$argv[1].'/attachment.takedown/'.$attach['id'].'">Zdejm załącznik</a></p>');
	 }
	 ?>
	 <input type="submit" name="ok" value="Zatwierdź zmiany" />
	 <a href="<?php echo APPPATH; ?>admin.worktakedown/<?php echo $argv[1]; ?>">Zdejmij pracę</a>
	</form>
                
                
                <div class="column_r_content"> <!-- column_r_content -->

			</div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
	<?php show_template('section.column.latest.stuff'); ?>
    
<?php show_template('section.footer.php'); ?>