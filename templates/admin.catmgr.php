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
            
                <h1 class="header_column_r"><span>Administracja - kategorie</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
			<p>
			<?php if ($tpl['mode']=='newcat'): ?>
				<?php if ($tpl['status']=='success'): ?>
					Udało się tworzyć!
				<?php elseif ($tpl['status']=='failure'): ?>
					Nie udało się tworzyć gdyż <?php echo $tpl['error']; ?>
				<?php endif; ?>
			<?php elseif ($tpl['mode']=='delete'): ?>
				<?php if ($tpl['status']=='success'): ?>
					Udało się kasować!
				<?php elseif ($tpl['status']=='failure'): ?>
					Nie udało się kasować gdyż <?php echo $tpl['error']; ?>
				<?php endif; ?>
			<?php endif; ?>                
			</p>
	<br />
	<p>
	<?php foreach ($tpl['cats'] as $category) { ?>
		Nazwa: <?php echo $category['name']; ?><br />
		<a href="<?php echo APPPATH; ?>admin.catmgr/<?php echo $argv[1]; ?>/<?php echo $category['id']; ?>/delete">Kasuj</a><br />
		<?php if (!empty($tpl['subcats'][$category['id']])) 
				foreach ($tpl['subcats'][$category['id']] as $subcat) { ?>
			
				<p>
					Nazwa: <?php echo $subcat['name']; ?><br />
					<a href="<?php echo APPPATH; ?>admin.catmgr/<?php echo $argv[1]; ?>/<?php echo $subcat['id']; ?>/delete">Kasuj</a><br />
				</p>
		<?php } ?>
		<form action="<?php echo APPPATH; ?>admin.catmgr/<?php echo $argv[1]; ?>/<?php echo $category['id']; ?>/newcat" method="post">
			<input type="text" name="catname" /><input type="submit" name="ok" value="Nowa kategoria" />
		</form>
		<hr />				
	<?php } ?>
	</p>
	<p>
	<form action="<?php echo APPPATH; ?>admin.catmgr/<?php echo $argv[1]; ?>/0/newcat" method="post">
		<input type="text" name="catname" /><input type="submit" name="ok" value="Nowa kategoria" />
	</form>
	</p>					
			
			</div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
	<?php show_template('section.column.latest.stuff'); ?>
    
<?php show_template('section.footer.php'); ?>