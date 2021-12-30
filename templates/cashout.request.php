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
            
                <h1 class="header_column_r"><span>Kasa</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                	<?php if ($tpl['status']=='success'): ?>
                		Przesłano powiadomienie do administratora
                	<?php else: ?>
                    <form class="kasa_box" action="<?php echo APPPATH; ?>cashout.request" method="post">
                        <br />
                        <?php if ($tpl['error'] == 'name.empty'): ?>
                        	<strong>Nazwa pusta!</strong><br />
                        <?php endif; ?>                        
                        <div style="margin-top: 12px; height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Imię:</div>
                            <div style="float: left;"><input class="text" type="text" name="name" value="<?php echo $tpl['fv_name']; ?>"  /></div>
                        </div>

                        <?php if ($tpl['error'] == 'street.empty'): ?>
                        	<strong>Miasto puste!</strong><br />
                        <?php endif; ?>                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Ulica i numer domu:</div>
                            <div style="float: left;"><input class="text" type="text" name="street" value="<?php echo $tpl['fv_street']; ?>" /></div>
                        </div>

                        <?php if ($tpl['error'] == 'postal.wrong') { ?>
                        	<strong>Niepoprawny format kodu pocztowego!</strong></br >
                        <?php } elseif ($tpl['error'] == 'postal.empty') { ?>
                        	<strong>Pusty kod pocztowy!</strong><br />
                        <?php } ?>                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Kod pocztowy:</div>
                            <div style="float: left;"><input class="text" type="text" name="postal" value="<?php echo $tpl['fv_postal']; ?>" /></div>
                        </div>
                        
                        <?php if ($tpl['error'] == 'city.empty'): ?>
                        	<strong>Miasto puste!</strong><br />
                        <?php endif; ?>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Miasto:</div>
                            <div style="float: left;"><input class="text" type="text" name="city" value="<?php echo $tpl['fv_city']; ?>" /></div>
                        </div>
                        
                        
                        <?php if ($tpl['error'] == 'email.wrong') { ?>
                        	<strong>Niepoprawny format e-maila!</strong></br >
                        <?php } elseif ($tpl['error'] == 'email.empty') { ?>
                        	<strong>Pusty email!</strong><br />
                        <?php } ?>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">E-mail:</div>
                            <div style="float: left;"><input class="text" type="text" name="email" value="<?php echo $tpl['fv_email']; ?>" /></div>
                        </div>
                        
                        <div style="height: 60px;">
                            <div style="float: left;"><input class="dalej_button" type="submit" name="dodaj" value="" /></div>
                        </div>
                        
                        <span>Podaj poprawnie swój adres e-mail! Po zaksięgowaniu pieniędzy na naszym koncie zostaną tam przesłane wszystkie niezbędne informacje na temat realizacji zamówienia.</span>
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
<?php show_template('section.footer'); ?>