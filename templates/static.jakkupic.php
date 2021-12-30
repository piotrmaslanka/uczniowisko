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
            
                <h1 class="header_column_r"><span>Jak kupić</span></h1>
                
                <div class="column_r_content"> <!-- column_r_content -->
<h3>I. Poszukiwanie interesującej pracy</h3>
<p>Istnieją dwie metody szukania prac: przez spis prac w menu po lewej stronie lub przez wyszukiwarkę na górze strony. Stosując katalog szukaj kategorii 
odpowiadającej tematowi, który Cię interesuje!. Stosując wyszukiwarkę staraj się wpisywać po kolei różne kombinacje szukanych słów aż do skutku czyli 
znalezienia poszukiwanej pracy.</p>
<h3>II. Zamawianie pracy</h3>
<p>Procedura zamawiania wzoru pracy jest bardzo prosta. Przy wybranej pracy klikasz przycisk „Zamawiam”. Jeśli jest to jedyna praca, którą chcesz zakupić 
klikasz przycisk  „Kupuję”, następnie wypełniasz formularz kontaktowy i potwierdzasz całe zamówienie.</p>
<h3>III. Zapłata</h3>
<p>Po złożeniu i potwierdzeniu całego zamówienia zostaniesz przeniesiony na stronę przelewy24.pl , gdzie w wygodny sposób dokonasz przelewu z jakiegokolwiek 
konta internetowego. Jeżeli nie posiadasz konta możesz zapłacić za pracę przekazem pocztowym. Należy wtedy w tytule przelewu podać swój adres e-mail oraz tytuł
 pracy. Przed wpłatą upewnij się, że praca znajduje się w naszej bazie, gdyż nie piszemy prac na zlecenie!</p>

<p>Dane do wpłaty:
<address>
ING Bank Śląski<br />
Nr konta : 29 1050 1458 1000 0090 6882 5828<br />
„Vision IT”<br />
Daniel Kawa<br />
38-220 Dębowiec, Dębowiec 559<br />
</address></p>
<h3>IV.  E-mail z pracą</h3>
<p>Po zaksięgowaniu pieniędzy na naszym koncie (od 10 minut do maksymalnie 2 dni roboczych w przypadku tradycyjnego przelewu) otrzymujesz zamówioną pracę e-mailem.</p>


                </div> <!-- [end] column_r_content -->
            </div> <!-- [end] column_r -->
            
            <div class="clearfloat"> <!-- --> </div>
            
        </div> <!-- [end] main_box_top -->
    </div> <!-- [end] main_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="bottom_t"> <!-- --> </div>  <!-- bottom_t / [end]bottom_t -->
    
	<?php show_template('section.column.latest.stuff'); ?>
    
<?php show_template('section.footer.php'); ?>