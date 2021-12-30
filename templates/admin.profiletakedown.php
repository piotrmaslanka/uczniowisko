<?php include('section.header.php'); ?>

    
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
            
                <h1 class="header_column_r"><span>Administracja - kategorie</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
		<?php if ($tpl['status']=='success'): ?>
		Usunięto pomyślnie
	<?php elseif ($tpl['status']=='failure'): ?>
		Nie usunięto gdyż <?php echo $tpl['error']; ?>
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