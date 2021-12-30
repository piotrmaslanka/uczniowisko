<?php include('section.header.php'); ?>

    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="main_box"> <!-- main_box -->
        <div id="main_box_top"> <!-- main_box_top -->
        
            <div id="breadcrumbs_box"> <!-- breadcrumbs_box -->
                <ul>
                    <li>uczniowisko</li>
                    <li class="separator"><img src="images/breadcrumbs_separator.gif" height="7" width="6" alt="Separator" /></li>
                    <li><a href="<?php echo APPPATH; ?>mainpage.static/jaksprzedac" title="">jak sprzedać</a></li>
                </ul>
            </div> <!-- [end] breadcrumbs_box -->
            
            <div class="clearfloat"> <!-- --> </div>
            
            <div id="column_l"> <!-- column_l -->

 	<?php include('section.column.login.php'); ?>
                
	<?php include('section.column.plain.categories.php'); ?>
            
            </div> <!-- [end] column_l -->
            
            <div id="column_r"> <!-- column_r -->
            
                <h1 class="header_column_r"><span>Jak sprzedać</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
<h3>I. Dodanie pracy do bazy</h3>
<p>Na stronie głównej przy odpowiednim dziale klikasz przycisk dodaj. Wypełniasz formularz w celu założenia nowego konta. Jeśli już masz u nas konto wystarczy wpisać login i hasło, żeby się zalogować. Wybierasz kategorię, która najtrafniej odzwierciedla  Twoją pracę. Wpisujesz dokładny tytuł pracy i dodajesz krok po kroku każdy jej element. Zachęcamy, aby dodać w opisie parę słów do potencjalnych kupujących. Mile widziane jest wymienienie źródeł, do których odwołujesz się w pracy. Ponadto wybierz ocenę, jaką uzyskałeś za dodawaną pracę.</p>
<h3>II. Weryfikacja i akceptacja</h3>
<p>Ponieważ dbamy o poziom udostępnianych prac są one czytane przez naszych specjalistów. Czas oczekiwania na dodanie pracy to maksymalnie 7 dni.</p>
<h3>III. Oczekiwanie na zakup</h3>
<p>Oczywistym jest, iż zainteresowanie Twoją pracą zależy od jej tematu. My ze swojej strony dokładamy wszelkich starań, by dotarł do niej każdy zainteresowany.</p>
<h3>IV. Wypłata pieniędzy</h3>
<p>Po zalogowaniu się w serwisie możesz sprawdzić  stan swojego konta. Wysokość należnych Tobie prowizji zależy od aktualnego cennika. Aktualnie otrzymujesz 10zł za każdą ściągnięta prezentację maturalną oraz 4zł w przypadku innej pracy. Pieniądze możesz wypłacać po zgromadzeniu na koncie co najmniej 10zł. Pamiętaj jednak, że to kosztuje 1 zł, wiec czasem lepiej nazbierać więcej pieniędzy. Po dokonaniu zlecenia wypłaty - pieniądze przelejemy Ci w ciągu 3 dni roboczych.</p>
                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
	<?php show_template('section.column.latest.stuff'); ?>
    
<?php show_template('section.footer.php'); ?>