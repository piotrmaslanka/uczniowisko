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
            
            <div id="baner_flash">
            <script language="javascript">
			if (AC_FL_RunContent == 0) {
				alert("This page requires AC_RunActiveContent.js.");
			} else {
				AC_FL_RunContent(
					'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
					'width', '653',
					'height', '190',
					'src', 'flash/uczniowisko_baner',
					'quality', 'high',
					'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
					'align', 'middle',
					'play', 'true',
					'loop', 'true',
					'scale', 'showall',
					'wmode', 'window',
					'devicefont', 'false',
					'id', 'uczniowisko_baner',
					'bgcolor', '#ffffff',
					'name', 'uczniowisko_baner',
					'menu', 'true',
					'allowFullScreen', 'false',
					'allowScriptAccess','sameDomain',
					'movie', 'flash/uczniowisko_baner',
					'salign', ''
					); //end AC code
			}
            </script>
			
			<noscript>
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="653" height="190" id="uczniowisko_baner" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="allowFullScreen" value="false" />
				<param name="movie" value="uczniowisko_baner.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="flash/uczniowisko_baner.swf" quality="high" bgcolor="#ffffff" width="653" height="190" name="uczniowisko_baner" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object>
			</noscript>
            </div>
            
            <?php if ($tpl['forcelogin']): ?>
            	<script type="text/javascript">alert('Zaloguj się lub zarejestruj aby przeprowadzić żądaną operację!');</script>
            <?php endif; ?>
            
                <h1 class="header_column_r"><span>Witaj</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
                    <p>   Uczniowisko.pl  to pierwszy w Polsce portal internetowy  zawierający unikalne materiały edukacyjne z tak szerokiego zakresu przedmiotów. 
Jako, że sami, do niedawna byliśmy osobami uczącymi się, wiemy ile czasu potrzeba na przygotowanie prac zaliczeniowych, tak w szkole średniej jak i na studiach. Po zaliczeniu taka praca zwykle staje się zupełnie zbędna. Proponujemy, by  stała się ona pomocą dla innych, a Wam przyniosła korzyści  materialne. 
Dlatego Uczniowisko.pl  to pierwszy w Polsce portal skierowany do wszystkich uczących się:</p>

<h2>Do uczniów szkół średnich</h2>

<p>Tutaj znajdziecie przykładowe <a href="<?php echo APPPATH; ?>route.overmode/1">prezentacje maturalne</a> oraz prace z <a href="<?php echo APPPATH; ?>route.overmode/2">przedmiotów licealnych</a>.</p> 

<h2>Do studentów</h2>
<p>Tutaj znajdziecie wzorcowe prace z <a href="<?php echo APPPATH; ?>route.overmode/3">przedmiotów akademickich</a> z różnych kierunków studiów.</p>     
<p>Na stronie możecie nabyć unikalne materiały edukacyjne za wyjątkowo atrakcyjną cenę. Niektóre wzbogacone są dodatkowo o prezentacje multimedialne, zdjęcia czy też fragmenty filmów. Zaznaczamy, że dbamy o jakość - zanim praca ukaże się na stronie, zostaje dokładnie przeczytana przez Naszych specjalistów – nauczycieli dyplomowanych z wieloletnim stażem. Wszystko po to aby nauka oraz przygotowanie własnych prac było jeszcze łatwiejsze.  <p>
<p>Niczego jednak nie sprzedajemy – jesteśmy tylko Waszym pośrednikiem. Masz pracę, która została wysoko oceniona, a jest ci już zbędna - zamieść ją u nas. Za wszystkie  materiały  zostaniecie odpowiednio wynagrodzeni. Portal ten może stać się Waszym źródłem dochodu. Więcej informacji można znaleźć w dziale <a href="<?php echo APPPATH; ?>mainpage.static/pricing">ceny i prowizje</a>. </p> 
<p><strong>Zapraszamy do skorzystania z naszych usług !</strong></p>
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
<?php show_template('section.column.latest.stuff'); ?>
<?php show_template('section.footer'); ?>