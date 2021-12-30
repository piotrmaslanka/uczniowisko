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
                <h1 class="header_column_r"><span>Panel admina</span></h1>
                
                <div class="column_r_content"> 
	Imię: <?php echo $tpl['db_account_name']; ?><br />
	Nazwisko: <?php echo $tpl['db_account_surname']; ?><br />
	Kod pocztowy: <?php echo $tpl['db_account_postal']; ?><br />
	Adres: <?php echo $tpl['db_account_address']; ?><br />
	Miasto: <?php echo $tpl['db_account_city']; ?><br />
	E-mail: <?php echo $tpl['db_account_email']; ?><br />
	Telefon: <?php echo $tpl['db_account_phone']; ?><br />
	GG: <?php echo $tpl['db_account_gg']; ?><br />
	Konto bankowe: <?php echo $tpl['db_account_bankaccount']; ?><br />
	Szkoła: <?php echo $tpl['db_account_school']; ?><br />
	
	<a href="<?php echo APPPATH; ?>admin.profiletakedown/<?php echo $tpl['db_account_id']; ?>">Zdejmij ten profil!</a>                </div> <!-- [end] column_r_content -->
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
<?php show_template('section.column.latest.stuff'); ?>
<?php show_template('section.footer'); ?>