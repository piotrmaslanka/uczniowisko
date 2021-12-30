<?php show_template('section.header'); ?>
    
    <div id="main_box"> <!-- main_box -->
        <div id="main_box_top"> <!-- main_box_top -->
        
            <div id="breadcrumbs_box"> <!-- breadcrumbs_box -->
                <ul>
                    <li>uczniowisko</li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="<?php echo APPPATH; ?>mainpage.static/pricing" title="">ceny</a></li>
                </ul>
            </div> <!-- [end] breadcrumbs_box -->
            
            <div class="clearfloat"> <!-- --> </div>
            
            <div id="column_l"> <!-- column_l -->
            
            <?php show_template('section.column.login'); ?>
                
            <?php show_template('section.column.plain.categories'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
            
                <h1 class="header_column_r"><span>Ceny i prowizje</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                
                <br /><img src="images/ceny_prowizje_tabela.jpg" alt="" height="209" width="544" />
                
                 <h3>II. Ile możesz zarobić?</h3>
	             <p>Wszystko zależy od zainteresowania Twoimi pracami.  Gdy Twoja prezentacja zostanie ściągnięta 6 razy w miesiącu, a cztery prace z 
	             innych działów po 3 razy otrzymasz</p> 


				<center>6 x 10 zł + 4 x 8 x 3 zł = <b>156 zł</b><center>

 

				<p>Oczywiście nie ma żadnych przeszkód aby Twoje prace nabyło więcej osób. Możesz też zamieścić więcej własnych prac co zwiększy Twój zysk.</p>

				<p>Oferujemy Tobie zarobki kilkukrotnie wyższe niż konkurencyjne strony.</p>
                
                
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
   <?php show_template('section.column.latest.stuff'); ?>
    
    <?php show_template('section.footer'); ?>