<?php show_template('section.header'); global $argv; global $cfg; ?>
    
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
            <?php if ($tpl['status']=='success'): ?>
                <h1 class="header_column_r"><span>Zamówiono!</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                	<p>Możesz teraz przejść do strony Przelewy24 i uiścić opłatę. Możesz także przelać należność na konto:<br />
                	<i>ING Bank Śląski<br />
					Nr konta : 29 1050 1458 1000 0090 6882 5828<br />
					„Vision IT”<br />
					Daniel Kawa<br />
					38-220 Dębowiec, Dębowiec 559<br /></i>
                	<br /></p>
					<form action="<?php echo APPPATH; ?>przelewy24.pay" method="post" >
						<input type="submit" name="ok" value="Przejdź do strony przelewy24" />
					</form>
				</div>            
            <?php else: ?>            
                <h1 class="header_column_r"><span>Formularz zamówienia</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                
                <p><span class="item_title"><strong>Tytuł:</strong></span><span class="item_content"> <?php echo $tpl['db_work_title']; ?></span></p>
                <p><span class="item_title"><strong>Użyto prac:</strong></span><?php echo $tpl['db_work_usedworks']; ?></p>
                <p><span class="item_title"><strong>Komentarz:</strong></span><span class="item_content"> <?php echo $tpl['db_work_comment']; ?></span></p>
                <p><span class="item_title"><strong>Dodano:</strong></span><span class="item_content"> <?php echo date('Y-m-d',$tpl['db_work_added']); ?></span></p>
                <p><span class="item_title"><strong>Materiały:</strong></span><span class="item_content"> 
                <?php foreach ($tpl['attachs'] as $attach) { ?> <?php echo $attach['description']; ?> <?php } ?></span></p>
                <p><span class="item_title"><strong>Cena:</strong></span><span class="item_content"> <?php echo $cfg['work_prices'][$tpl['db_category_fk_overmode']]; ?></span></p>
                
                    <form class="zamowienie_box" action="<?php echo APPPATH; ?>order.place/<?php echo $argv[1]; ?>" method="post">
                        
                        <div style="margin-top: 12px; height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 70px">Email:</div>
                            <div style="float: left;"><input class="text" type="text" name="email" value=""  /></div>
                        </div>
                        
                        <div style="height: 210px;">
                            <div style="float: left; margin-top: 3px; width: 70px">Uwagi:</div>
                            <div style="float: left;"><textarea name="adnots"></textarea></div>
                        </div>
                        
                        <div style="margin-top: 12px; height: 60px;">
                            <div style="float: left;"><input class="zatwierdz_button" type="submit" name="search" value="" /></div>
                        </div>
                    </form>
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            <?php endif; ?>
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
   <?php show_template('section.column.latest.stuff'); ?>
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="footer_box"> <!-- footer_box -->
        <div id="copyright"><a href="#" title="uczniowisko.pl">uczniowisko.pl</a><span> 2009 | Wszelkie prawa zastrzeżone</span></div>
        <div id="author"><span>Projekt: </span><a href="#" title="Mateusz Maziarz">Mateusz Maziarz</a></div>
    </div> <!-- [end] footer_box -->

</div> <!-- [end] global_box -->

</body>
</html>