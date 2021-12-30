<?php global $argv, $page; ?>
<?php show_template('section.header') ;?>
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
                
            <?php $tpl['parm_catid'] = $argv[1]; show_template('section.column.subcat.bycat'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
            
                <h1 class="header_column_r"><span>Katalog Prac</span><span>&nbsp;&nbsp;>&nbsp;&nbsp;</span><span>PRACE DARMOWE</span></h1>
                
                <div class="column_r_categories"> <!-- column_r_categories -->
                    <div class="pagebreak">
                        <ul>
                            <li class="arrow"><a href="<?php echo APPPATH; ?>free.list/<?php echo $argv[1]; ?>/<?php echo $page-1; ?>"><< Poprzednia</a></li>
                            <?php foreach ($tpl['pagination'] as $pagina) { ?>
                            
                            <?php if ($pagina['typ']=='cur'): ?>
                            	<li class="active"><a href="<?php echo APPPATH; ?>free.list/<?php echo $argv[1]; ?>/<?php echo $pagina['val']; ?>"><?php echo $pagina['val']; ?></a></li>
                            <?php elseif ($pagina['typ']=='link'): ?>
                            	<li><a href="<?php echo APPPATH; ?>free.list/<?php echo $argv[1]; ?>/<?php echo $pagina['val']; ?>"><?php echo $pagina['val']; ?></a></li>
                            <?php elseif ($pagina['typ']=='ellipsis'): ?>
                            	<li class="more"><a href="#">...</a></li>
                            <?php elseif ($pagina['typ']=='none'): ?>
                            	<li></li>
                            <?php endif; ?>
                            <?php } ?>
                            <li class="arrow"><a href="<?php echo APPPATH; ?>free.list/<?php echo $argv[1]; ?>/<?php echo $page+1; ?>">Następna >></a></li>
                            <li class="gotosite_title"><span>Przejdź do strony:</span></li>
                                <!-- modified by Piotr M. -->
                            <li class="gotosite_input"><input class="pagebreak_input" name="page" alt="Przejdź do strony" type="text" id="go_yay" />
                            <li class="gotosite_button"><input class="pagebreak_button" type="button" onclick="go_to_page()"/></li>
                        		<!-- end of Piotr M. -->
                        </ul>
                    </div>
                        		<!-- written by Piotr M.
                        			 Keep the following script block as one, anywhere in <body>. It doesn't affect layout. -->
                        			<script type="text/javascript">
                        				function go_to_page()
                        				{
                        					window.location = '<?php echo APPPATH; ?>work.list/<?php echo $argv[1]; ?>/'+document.getElementById('go_yay').value;
                        				}                     
                        			</script>
                        		<!-- end of modifications -->
                   
                    <div class="list_box_cr">
                        <ul>
                        	<?php foreach ($tpl['listed_works'] as $work) { ?>
                            <li>
                                <div class="list_box_item_cr">
                                    <table cellspacing="12" cellpadding="0">
                                        <tr>
                                            <td class="list_box_left_cr">
                                                <span class="title"><a href="<?php echo APPPATH; ?>free.view/<?php echo $work['id']; ?>"><?php echo $work['title']; ?></a></span><br />
                                                <!--<span class="description"><?php echo $work['comment']; ?></span>-->
                                            </td>
                                            <td class="list_box_center_cr">
                                            </td>
                                            <td class="list_box_right_cr">
                                                <a href="<?php echo APPPATH; ?>free.view/<?php echo $work['id']; ?>"><img src="images/list_box_more_cr.gif" alt="Więcej" height="51" width="55" /></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </li>
                            <?php } ?>                            
                        </ul>
                    </div>
                    
                </div> <!-- [end] column_r_categories -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
    <?php show_template('section.column.latest.stuff'); ?>
    
 <?php show_template('section.footer'); ?>