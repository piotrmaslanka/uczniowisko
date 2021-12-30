<?php global $cfg; ?>
<?php show_template('section.header'); ?>
    
    <div id="main_box"> <!-- main_box -->
        <div id="main_box_top"> <!-- main_box_top -->
        
            <div id="breadcrumbs_box"> <!-- breadcrumbs_box -->
                <ul>
                    <li>uczniowisko</li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="" title="">katalog prac</a></li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="" title=""><?php echo $tpl['db_category_name']; ?></a></li>                    
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="<?php echo APPPATH; ?>work.view/<?php echo $tpl['db_work_id']; ?>" title=""><?php echo $tpl['db_work_title']; ?></a></li>                    
                </ul>
            </div> <!-- [end] breadcrumbs_box -->
            
            <div class="clearfloat"> <!-- --> </div>
            
            <div id="column_l"> <!-- column_l -->
            
          <?php show_template('section.column.login'); ?>
          
           <?php $tpl['parm_workid'] = $tpl['db_work_id']; show_template('section.column.subcat.bywork'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
            
                <h1 class="header_column_r"><span><?php echo $tpl['db_work_title']; ?></span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                
                <div class="fr">
                    <form class="kupteraz_box" action="<?php echo APPPATH; ?>order.place/<?php echo $tpl['db_work_id']; ?>" method="post">
                        <div style="height: 60px;">
                            <div style="float: left;"><input class="kupteraz_button" type="submit" name="dodaj" value="" /></div>
                        </div>
                    </form>
                    <strong>Procedura zamawiania:</strong>
                    <p>1. Klikasz powyższy przycisk<br />
                    2. Składasz zamówienie<br />
                    3. Przelewasz pieniądze na podane konto<br />
                    4. Przesyłamy pracę na Twój adres e-mail</p>
                    <p>Szczegóły znajdziesz w <a href="<?php echo APPPATH; ?>mainpage.static/regulamin">regulaminie</a>.</p>
                </div>
                
                <p><span class="item_title"><strong>Cena:</strong></span><span class="item_content"> <?php echo $cfg['work_prices'][$tpl['db_overmode_id']]; ?>zł</span></p>
                <p><span class="item_title"><strong>Ocena:</strong></span><span class="item_content"> <?php echo $tpl['db_work_grade']; ?></span></p>
                <p><span class="item_title"><strong>Materiały:</strong></span><span class="item_content">
                <?php foreach ($tpl['attachs'] as $at) { ?>
                	<?php echo $at['description']; ?> 
                <?php } ?> 
                </span></p>                	
                <?php if (!empty($tpl['db_account_school'])): ?>
                <p><span class="item_title"><strong>Szkoła autora:</strong></span><span class="item_content"> <?php echo $tpl['db_account_school']; ?></span></p>
                <?php endif; ?>
                <p><span class="item_title"><strong>Miasto autora:</strong></span><span class="item_content"> <?php echo $tpl['db_account_city']; ?></span></p>
                <p><span class="item_title"><strong>Wszystkich pobrań:</strong></span><span class="item_content"> <?php echo $tpl['db_work_downloads']; ?></span></p>
                <p><span class="item_title"><strong>Data dodania:</strong></span><span class="item_content"> <?php echo date('d-m-Y',$tpl['db_work_added']); ?></span></p>
                <p><span class="item_title"><strong>Wykorzystano dzieła autorów:</strong></span><span class="item_content"> <?php echo strip_tags($tpl['db_work_usedworks']); ?></span></p>
                <p><span class="item_title"><strong>Komentarz autora:</strong></span><span class="item_content"> <?php echo nl2br(strip_tags($tpl['db_work_comment'])); ?></span></p>
                
                <!-- modified by Piotr M.
                	Note: Anyone with HTML editing capablity should see to it. REALLY -->
                <div class="comments_area" style="padding-left: 1em; padding-top: 1em;">
                	<?php foreach($tpl['comments'] as $comment) { ?>
                		<div class="comment_single" style="padding-bottom: 0.5em;">
							<?php if ($_SESSION['admin']==true): ?>
									<div style="float: right;"><a href="<?php echo APPPATH; ?>admin.commentmanage/<?php echo $comment['id']; ?>">Zarządzaj</a></div>
							<?php endif; ?>                		
                			<strong>Nick: </strong> <?php echo $comment['nick']; ?><br />
                			<strong>Dodano: </strong> <?php echo date('d-m-Y',$comment['added']); ?><br />
                			<?php echo nl2br(strip_tags($comment['data'])); ?>
                		</div>
                	<?php } ?>
                </div> <!-- [end] comments_area -->
               
               
               <?php if ($_SESSION['admin']): ?><br /><a href="<?php echo APPPATH; ?>admin.edit/<?php echo $tpl['db_work_id']; ?>">Edytuj</a><?php endif; ?> 
                <!-- end of Piotr M. wasted area -->           
                
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
    <?php show_template('section.column.latest.stuff'); ?>
    
<?php show_template('section.footer'); ?>