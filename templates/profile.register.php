<?php show_template('section.header'); ?>
    
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
            
                <h1 class="header_column_r"><span>Rejestracja nowego użytkownika</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                    <form class="rejestracja_box" action="<?php echo APPPATH; ?>profile.register" method="post">
                       
                       	<?php if ($tpl['error']=='name.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?>
                        
                        <div style="margin-top: 12px; height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Imię:</div>
                            <div style="float: left;"><input class="text" type="text" name="name" value="<?php echo $tpl['fv_name']; ?>"  /></div>
                        </div>
                       
                       	<?php if ($tpl['error']=='surname.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Nazwisko:</div>
                            <div style="float: left;"><input class="text" type="text" name="surname" value="<?php echo $tpl['fv_surname']; ?>" /></div>
                        </div>
                        
                        <?php if ($tpl['error']=='address.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Adres:</div>
                            <div style="float: left;"><input class="text" type="text" name="address" value="<?php echo $tpl['fv_address']; ?>" /></div>
                        </div>
                        
                        <?php if ($tpl['error']=='postal.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?>
                        <?php if ($tpl['error']=='postal.wrong'): ?><div><strong style="color: red;">Użyj formatu XX-XXX!</strong></div><?php endif; ?>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Kod pocztowy:</div>
                            <div style="float: left;"><input class="text" type="text" name="postal" value="<?php echo $tpl['fv_postal']; ?>" /></div>
                        </div>
                        
                        <?php if ($tpl['error']=='city.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?> 
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Miasto:</div>
                            <div style="float: left;"><input class="text" type="text" name="city" value="<?php echo $tpl['fv_city']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Szkoła:</div>
                            <div style="float: left;"><input class="text" type="text" name="school" value="<?php echo $tpl['fv_school']; ?>" /></div>
                        </div>
                        
                        <?php if ($tpl['error']=='email.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?>
                        <?php if ($tpl['error']=='email.wrong'): ?><div><strong style="color: red;">Wpisz poprawny email!</strong></div><?php endif; ?>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">E-mail:</div>
                            <div style="float: left;"><input class="text" type="text" name="email" value="<?php echo $tpl['fv_email']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Telefon:</div>
                            <div style="float: left;"><input class="text" type="text" name="phone" value="<?php echo $tpl['fv_phone']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Numer gg:</div>
                            <div style="float: left;"><input class="text" type="text" name="gg" value="<?php echo $tpl['fv_gg']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Numer konta bankowego:</div>
                            <div style="float: left;"><input class="text" type="text" name="bankaccount" value="<?php echo $tpl['fv_bankaccount']; ?>" /></div>
                        </div>
                        
                        <div style="padding: 10px 0;">
                        <span>Numeru konta nie musisz podawać teraz - możesz to zrobić później w momencie, gdy będziesz chciał wypłacić zarobione pieniądze. Pieniądze możesz także odebrać osobiście w naszej siedzibie w Jakimś Mieście po uprzednim skontaktowaniu się z nami.</span>
                        </div>
                        
                        <?php if ($tpl['error']=='login.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?>
                        <?php if ($tpl['error']=='login.taken'): ?><div><strong style="color: red;">Login zajęty!</strong></div><?php endif; ?>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Login:</div>
                            <div style="float: left;"><input class="text" type="text" name="username" value="<?php echo $tpl['fv_username']; ?>" /></div>
                        </div>
                        
                        <?php if ($tpl['error']=='password.empty'): ?><div><strong style="color: red;">Puste!</strong></div><?php endif; ?>
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Hasło:</div>
                            <div style="float: left;"><input class="text" type="text" name="pass1" value="<?php echo $tpl['fv_pass1']; ?>" /></div>
                        </div>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 180px">Powtórz hasło:</div>
                            <div style="float: left;"><input class="text" type="text" name="pass2" value="<?php echo $tpl['fv_pass2']; ?>" /></div>
                        </div>
                        
                        <div style="height: 60px;">
                            <div style="float: left;"><input class="dodaj_button" type="submit" name="dodaj" value="" /></div>
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