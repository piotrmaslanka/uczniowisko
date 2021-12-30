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
            
                <h1 class="header_column_r"><span>Profil użytkownika</span></h1>
                
                
                <div class="column_r_content"> <!-- column_r_content -->
                    <form class="kasa_box" action="<?php echo APPPATH; ?>profile.own" method="post">
                        <br />
                        <div style="margin-top: 12px; height: 35px;">
                        	<?php if ($tpl['error']=='name.empty'): ?><div>Puste imię</div><?php endif; ?>                        
                            <div style="float: left; margin-top: 3px; width: 180px">Imię:</div>
                            <div style="float: left;"><input class="text" type="text" name="name" value="<?php echo $tpl['db_account_name']; ?>"  /></div>
                        </div>
                        
                        <div style="height: 35px;">
                        	<?php if ($tpl['error']=='surname.empty'): ?><div>Puste nazwisko</div><?php endif; ?>                                                
                            <div style="float: left; margin-top: 3px; width: 180px">Nazwisko:</div>
                            <div style="float: left;"><input class="text" type="text" name="surname" value="<?php echo $tpl['db_account_surname']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                        	<?php if ($tpl['error']=='address.empty'): ?><div>Pusty adres</div><?php endif; ?>                                                
                            <div style="float: left; margin-top: 3px; width: 180px">Adres:</div>
                            <div style="float: left;"><input class="text" type="text" name="address" value="<?php echo $tpl['db_account_address']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                        	<?php if ($tpl['error']=='postal.empty'): ?><div>Pusty kod pocztowy</div><?php endif; ?>
                        	<?php if ($tpl['error']=='postal.wrong'): ?><div>Błędny kod pocztowy</div><?php endif; ?>
                            <div style="float: left; margin-top: 3px; width: 180px">Kod pocztowy:</div>
                            <div style="float: left;"><input class="text" type="text" name="postal" value="<?php echo $tpl['db_account_postal']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                        	<?php if ($tpl['error']=='city.empty'): ?><div>Puste miasto</div><?php endif; ?>                        
                            <div style="float: left; margin-top: 3px; width: 180px">Miasto:</div>
                            <div style="float: left;"><input class="text" type="text" name="city" value="<?php echo $tpl['db_account_city']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">E-mail:</div>
                            <div style="float: left;"><input class="text" type="text" name="email" value="<?php echo $tpl['db_account_email']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Telefon:</div>
                            <div style="float: left;"><input class="text" type="text" name="phone" value="<?php echo $tpl['db_account_phone']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Gadu-gadu:</div>
                            <div style="float: left;"><input class="text" type="text" name="gg" value="<?php echo $tpl['db_account_gg']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Konto bankowe:</div>
                            <div style="float: left;"><input class="text" type="text" name="bankaccount" value="<?php echo $tpl['db_account_bankaccount']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Szkoła:</div>
                            <div style="float: left;"><input class="text" type="text" name="school" value="<?php echo $tpl['db_account_school']; ?>" /></div>
                        </div>
                        
                        <p><strong>Jeśli zmieniasz hasło:</strong></p>
                        
                        <div style="height: 35px;">
                        	<?php if ($tpl['error']=='wrong.password'): ?><div>Złe hasło</div><?php endif; ?>                                                
                            <div style="float: left; margin-top: 3px; width: 180px">Aktualne hasło:</div>
                            <div style="float: left;"><input class="text" type="text" name="oldpass" value="" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                        	<?php if ($tpl['error']=='empty.newpass'): ?><div>Puste hasło</div><?php endif; ?>
                        	<?php if ($tpl['error']=='different.password'): ?><div>Hasła różnią się</div><?php endif; ?>                                                	                        
                            <div style="float: left; margin-top: 3px; width: 180px">Nowe hasło:</div>
                            <div style="float: left;"><input class="text" type="text" name="newpass1" value="" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Potwierdź nowe hasło:</div>
                            <div style="float: left;"><input class="text" type="text" name="newpass2" value="" /></div>
                        </div>
                        
                        <p>Środki: <?php echo $tpl['db_account_cash']; ?><br /></p>
                        <p><a href="<?php echo APPPATH; ?>cashout.request">Wypłata środków &raquo;</a><br /><br /><p>
                        
                        <div style="height: 60px;">
                            <div style="float: left;"><input class="dalej_button" type="submit" name="dodaj" value="" /></div>
                        </div>
                    </form>
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
    <?php show_template('section.column.latest.stuff'); ?>
   <?php show_template('section.footer'); ?>