<?php include('section.header.php'); ?>

    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="main_box"> <!-- main_box -->
        <div id="main_box_top"> <!-- main_box_top -->
        
            <div id="breadcrumbs_box"> <!-- breadcrumbs_box -->
                <ul>
                    <li>uczniowisko</li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="<?php echo APPPATH; ?>contact.from" title="">kontakt</a></li>
                </ul>
            </div> <!-- [end] breadcrumbs_box -->
            
            <div class="clearfloat"> <!-- --> </div>
            
            <div id="column_l"> <!-- column_l -->

 	<?php include('section.column.login.php'); ?>
                
	<?php include('section.column.plain.categories.php'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
            
                <h1 class="header_column_r"><span>Kontakt</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                	<?php if ($tpl['status']=='success'): ?>
                		Wysłano!
                	<?php else: ?>
                	<form class="kontakt_box" action="<?php echo APPPATH; ?>contact.form" method="post">
                		<div style="margin-top: 12px; height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 120px">E-mail:</div>
                            <div style="float: left;"><input class="text" type="text" name="email" class="text"></div>
                        </div>
                        
                        <br />
                        
                		<div style="height: 210px;">
                            <div style="float: left; margin-top: 3px; width: 120px">Wiadomość:</div>
                            <div style="float: left;"><textarea name="msg" class="text"></textarea></div>
                        </div>
                        
                        <br />
                        
                		<div style="height: 30px;">
                            <div style="float: left;"><input class="wyslij_button" type="submit" value="" class="text" /></div>
                        </div>
                  	</form>
                  	<?php endif; ?>
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
	<?php show_template('section.column.latest.stuff'); ?>
    
<?php show_template('section.footer.php'); ?>