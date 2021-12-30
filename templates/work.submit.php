<?php show_template('section.header'); global $argv; ?>
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
                <h1 class="header_column_r"><span>Wysłano pomyślnie</span></h1>
                <div class="column_r_content"> <!-- column_r_content -->
                	Twoja praca zostanie przejrzana w najbliższym czasie przez administratora
                </div>
            <?php else: ?>
                <h1 class="header_column_r"><span>Dodaj pracę</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                    <form class="advanced_search_box" action="<?php echo APPPATH; ?>work.submit/<?php echo $argv[1]; ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="filecount" name="filecount" value="1">
                    <script type="text/javascript">
                    function adduploadfield()
					{
						var currentfilesFC = document.getElementById('filecount');
						var currentfiles = currentfilesFC.getAttribute('value');
						currentfiles++;
						
						
						var myfields = document.getElementById('kuploadfiles');
							
						myfields.innerHTML = myfields.innerHTML+'<div>Opis:<input type="input" name="desc'+currentfiles+'"><br />Plik:<input type="file" name="file'+currentfiles+'"></div>';
						
						currentfilesFC.setAttribute('value',currentfiles);
					}
                    </script>
                    
                        <div style="margin-top: 12px; height: 35px;">
                        
                        	<?php if ($tpl['error']=='title.empty'): ?>Tytuł pusty<?php endif; ?>
                            <div style="float: left; margin-top: 3px; width: 120px">Temat pracy:</div>
                            <div style="float: left;"><input class="text" type="text" name="title" /></div>
                        </div>
                        
                        <?php if ($tpl['error']=='category.invalid'): ?>
                        	Błędna kategoria	
                        <?php endif; ?>
                        
                        <div style="height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 120px">Kategoria:</div>
                            <div style="float: left;">
                            <select name="category">
				<?php foreach($tpl['cats'] as $cat) { ?><option value="<?php echo $cat['id']?>"><?php echo $cat['name']; ?></option><?php } ?>                            </select>
                            </div>
                        </div>

                        <?php if ($tpl['error']=='nothing.uploaded'): ?>
                        	Nie wysłano nic.	
                        <?php endif; ?>
                        
                        <?php if ($tpl['error']=='upload.failed'): ?>
                        	Błąd wysyłania. Sprawdź nastawy swojej przeglądarki lub użyj innej.	
                        <?php endif; ?>
                        
                        <?php if ($tpl['error']=='upload.toobig'): ?>
                        	Zbyt duży plik.
                        <?php endif; ?>

                        <div style="margin-top: 12px; height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 120px">Pliki prezentacji:</div>
                            <div style="float: left;">
                            <div id="kuploadfiles">
                            	<div>Opis:<input type="text" name="desc1" value="Plik z pracą"><br />Plik : <input type="file" name="file1"></div>
                            </div>
                            <input type="button" value="Dodaj pole" onclick="adduploadfield()" /><br>
                            </div>
                        </div>
                        
                        <div style="clear: both;"></div>
                        <div style="height: 210px;">
                            <div style="float: left; margin-top: 3px; width: 120px">Uwagi:</div>
                            <div style="float: left;"><textarea name="comment"></textarea></div>
                        </div>
                        
                        <div style="clear: both;"></div>

                        <div style="height: 100px;">
                            <div style="float: left; margin-top: 3px; width: 120px">Ocena:</div>
                            <div style="float: left;"><input class="text" type="text" name="grade"></div>
                        </div>
                        
                        <div style="clear: both;"></div>
                        
                        <div style="height: 210px;">
                            <div style="float: left; margin-top: 3px; width: 120px">Użyte prace:</div>
                            <div style="float: left;"><textarea name="usedworks"></textarea></div>
                        </div>
                        
                        
                        <?php if ($tpl['error']=='not.agreed'): ?>
                        	Akceptowanie regulaminu jest wymagane	
                        <?php endif; ?>
                        
                        <div style="margin-top: 12px; height: 35px;">
                            <div style="float: left; margin-top: 3px; width: 120px">Akceptuję regulamin:</div>
                            <div style="float: left;"><input class="text" type="checkbox" name="agreed" value="1"/></div>
                        </div>
                       
                        <br/>
                        <div style="height: 60px;">
                            <div style="float: left;"><input class="dodaj_button" type="submit" name="dodaj" value="" /></div>
                        </div>
						

                    </form>
                </div> <!-- [end] column_r_content -->
               <?php endif; ?>
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
<?php show_template('section.column.latest.stuff'); ?>
    
  <?php show_template('section.footer'); ?>