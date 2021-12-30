          <?php if (!APISession::isLogged()): ?>            
                <h3 class="header_column_l">Zaloguj</h3>
                
                <div class="login_form_bg_cl"> <!-- login_form_cl -->
                    <form action="<?php echo APPPATH; ?>profile.login" method="post">
                    <?php if ($tpl['error']=='credentials.wrong'): ?>
                        		<!-- by P.M. 
                        		See to it, seems to ruin stuff -->
                        	<div class="login-alert"><span>Dane logowania złe!</span></div>
					<?php endif; ?>
                        <div class="login_form_cl_left">
                                <input class="login_input" name="login" alt="Login" type="text" value="Login"  onblur="if(this.value=='') this.value='Login';" onfocus="if(this.value=='Login') this.value='';" />
                            <div class="clearfloat"> <!-- --> </div>
                                <input class="pass_input" name="pass" alt="Hasło" type="password" value="Hasło"  onblur="if(this.value=='') this.value='Hasło';" onfocus="if(this.value=='Hasło') this.value='';" />
                            </div>
                            <div class="login_form_cl_right">
                                <input class="login_button" value="" type="submit" />
                        </div>
                        <div class="clearfloat"> <!-- --> </div>
                    </form>
                </div> <!-- [end] login_form_cl -->
				<div class="login_links_cl"><a href="<?php echo APPPATH; ?>profile.register" title="Zarejestruj się"><strong>Zarejestruj się</strong></a> <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span> <a href="javascript:alert('Skontaktuj się z obsługą serwisu');" title="Zapomniałeś hasła">Zapomniałeś hasła</a></div>
                <div class="clearfloat"> <!-- --> </div>
           <?php endif; ?>