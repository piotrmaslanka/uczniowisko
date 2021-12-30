<?php global $argv; ?>
<?php show_template('section.header'); ?>
    
    <div id="main_box"> <!-- main_box -->
        <div id="main_box_top"> <!-- main_box_top -->
        
            <div id="breadcrumbs_box"> <!-- breadcrumbs_box -->
                <ul>
                    <li>uczniowisko</li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="" title="">zarządzaj komentarzem</a></li>
                </ul>
            </div> <!-- [end] breadcrumbs_box -->
            
            <div class="clearfloat"> <!-- --> </div>
            
            <div id="column_l"> <!-- column_l -->
            
            <!-- wiedz, że section.column.login fizycznie nie zostanie wyswietlony nigdy
            	aby obejrzec ta strone, musisz byc zalogowany i musisz byc adminem -->
             <?php show_template('section.column.login'); ?>
                
                <?php show_template('section.column.plain.categories'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
           
            
                <h1 class="header_column_r"><span>Witaj</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                	<p>
					<?php if ($tpl['mode']=='delete'): ?>
						<?php if ($tpl['status']=='success'): ?>
							<!-- this should never happen, as if you delete a page the system will not find it and not allow viewing page -->
						<?php elseif ($tpl['status']=='failure'): ?>
							Nie skasowano gdyż <?php echo $tpl['error']; ?>
						<?php endif; ?>
					<?php else: ?>
						<?php if ($tpl['status']=='success'): ?>
							Zmodyfikowano! <br />
						<?php elseif ($tpl['status']=='failure'): ?>
							Nie zmodyfikowano! <br />
						<?php endif; ?>
					<?php endif; ?>					
					</p>
					<p>
						<form action="<?php echo APPPATH; ?>admin.commentmanage/<?php echo $argv[1]; ?>" method="post">
							<?php if ($tpl['error']=='nickname.empty'): ?>
								<b>Nick pusty!!!</b><br />
							<?php endif; ?>
							Nick: <input type="text" name="nick" value="<?php echo $tpl['db_comment_nick']; ?>" /><br />
							<?php if ($tpl['error']=='text.empty'): ?>
								<b>Opis pusty!!!</b><br />
							<?php endif; ?>
							Opis: <textarea name="text" rows="5" cols="40" /><?php echo nl2br($tpl['db_comment_data']); ?></textarea><br />
							<input type="checkbox" name="status" value="1" <?php if ($tpl['db_comment_status']==1): ?>checked="checked"<?php endif; ?> />Widoczne <br />
							<input type="submit" name="ok" value="Zatwierdź" /><br />
						</form>
						
						<a href="<?php echo APPPATH; ?>admin.commentmanage/<?php echo $argv[1]; ?>/delete">Kasuj</a>							
					</p>
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
<?php show_template('section.column.latest.stuff'); ?>
<?php show_template('section.footer'); ?>