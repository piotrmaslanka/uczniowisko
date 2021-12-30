<?php show_template('section.header'); ?>
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="main_box"> <!-- main_box -->
        <div id="main_box_top"> <!-- main_box_top -->
        
            <div id="breadcrumbs_box"> <!-- breadcrumbs_box -->
                <ul>
                    <li>uczniowisko</li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="<?php echo APPPATH; ?>fikus.entry" title="">wyszukiwanie zaawansowane</a></li>
                </ul>
            </div> <!-- [end] breadcrumbs_box -->
            
            <div class="clearfloat"> <!-- --> </div>
            
            <div id="column_l"> <!-- column_l -->
            
        <?php show_template('section.column.login'); ?>
                
                <?php show_template('section.column.plain.categories'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
            
                <h1 class="header_column_r"><span>Katalog Prac</span><span>&nbsp;&nbsp;>&nbsp;&nbsp;</span><span>PREZENTACJE MATURALNE</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                    <form class="advanced_search_box" action="<?php echo APPPATH; ?>fikus.szukarka" method="post">
                        <div style="margin-top: 12px; height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 100px">Słowo - klucz:</div>
                            <div style="float: left;"><input class="text" type="text" name="was" value="Szukana fraza" onblur="if(this.value=='') this.value='Szukana fraza';" onfocus="if(this.value=='Szukana fraza') this.value='';" /></div>
                        </div>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 100px">Kategoria:</div>
                            <div style="float: left;">
                            <select name="overmode">
								<option value="1">Prezentacje</option>
								<option value="2">Licealne</option>
								<option value="3">Akademickie</option>
							</select>
                            </div>
                        </div>
                        <div style="height: 60px;">
                            <div style="float: left;"><input class="advanced_search_button" type="submit" name="search" value="" /></div>
                        </div>
                    </form>
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
        
    <div class="clearfloat"> <!-- --> </div>
    
<?php show_template('section.footer'); ?>