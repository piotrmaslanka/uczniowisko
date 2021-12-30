<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="keywords" content="prezentacje maturalne, prezentacja maturalna, prace maturalne, praca maturalna, referaty, wypracowania" />
<meta name="description" content=" Uczniowisko.pl – Twój Portal Wiedzy. Znajdziesz tutaj wzory prezentacji maturalnych, prac akademickich oraz licealnych. " />
<meta name="classification" content="Prezentacje maturalne, prace akademickie, motywy literackie, liceum" />


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo SRCPATH; ?>" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--<link rel="stylesheet" href="css/style1.css" type="text/css" />-->
<link rel="stylesheet" href="css/ieonly.css" type="text/css" />
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
<title>Uczniowisko.pl</title>
</head>
<body>
<div id="top_box">
    <div id="top_main_box">
        <div id="top_center_box">
        <?php if (APISession::isLogged()): ?>
            <div id="login_info">
                <span class="welcome">Witaj w uczniowisko.pl. Jesteś zalogowany jako: </span><a class="user_name" href="<?php echo APPPATH; ?>profile.own" title="Nazwa użytkownika"><?php echo $_SESSION['profile']['name']." ".$_SESSION['profile']['surname']; ?></a>
            </div>
        <?php endif; ?>
            <div id="profile_info">
        <?php if (APISession::isLogged()): ?>
        		<a class="your_profile" href="<?php echo APPPATH; ?>profile.logout" title="Wyloguj">Wyloguj</a>
                <a class="your_profile" href="<?php echo APPPATH; ?>profile.own" title="Twój profil">Twój profil</a>
                <?php if ($_SESSION['admin']): ?>
                	<a href="<?php echo APPPATH; ?>admin.panel">Panel admina</a>
                <?php endif; ?>
        <?php else: ?>
                <a class="log_in" href="<?php echo APPPATH; ?>profile.login" title="Zaloguj">Zaloguj</a>
        <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="clearfloat"> <!-- --> </div>

<div id="global"> <!-- global_box -->
    
    <div id="header_box"> <!-- header_box -->
        <a id="logo" href="#" title="Uczniowisko.pl - Twój portal wiedzy"><img src="images/logo_uczniowisko.gif" height="89" width="280" alt="Uczniowisko.pl - Twój portal wiedzy" /></a>
        <div id="search_box"> <!-- search_box -->
        <div id="search_header">
            <img src="images/szukaj_header.gif" height="20" width="48" alt="Szukaj" />
        </div>
        <div id="search_input_box">
            <form action="index.php" method="get">
                <input class="search_input" name="was" alt="Szukaj" type="text" value="szukana fraza"  onblur="if(this.value=='') this.value='szukana fraza';" onfocus="if(this.value=='szukana fraza') this.value='';" />
                <input class="search_button" value="" type="submit" />
            </form>
        </div>
        <div class="advanced_search"><a href="<?php echo APPPATH; ?>fikus.entry" title="Wyszukiwanie zaawansowane">wyszukiwanie zaawansowane</a></div>
        </div> <!-- [end] search_box -->
    </div> <!-- [end] header_box -->
    
    <div class="clearfloat"> <!-- --> </div>
    
    <div id="mainmenu_box"> <!-- mainmenu_box -->
    <ul>
        <li class="mainmenu_separator"> <!-- --> </li>
        <li id="itemid_1"><a href="<?php echo APPPATH; ?>" title="O nas">O nas</a></li>
        <li class="mainmenu_separator"> <!-- --> </li>
        <li id="itemid_2"><a href="<?php echo APPPATH; ?>mainpage.static/jakkupic" title="Jak kupić">Jak kupić</a></li>
        <li class="mainmenu_separator"> <!-- --> </li>
        <li id="itemid_3"><a href="<?php echo APPPATH; ?>mainpage.static/jaksprzedac" title="Jak sprzedać">Jak sprzedać</a></li>
        <li class="mainmenu_separator"> <!-- --> </li>
        <li id="itemid_4"><a href="<?php echo APPPATH; ?>mainpage.static/pricing" title="Ceny">Ceny</a></li>
        <li class="mainmenu_separator"> <!-- --> </li>
        <li id="itemid_5"><a href="<?php echo APPPATH; ?>mainpage.static/contact" title="Kontakt">Kontakt</a></li>
        <li class="mainmenu_separator"> <!-- --> </li>
        <li id="itemid_6"><a href="<?php echo APPPATH; ?>mainpage.static/regulamin" title="Regulamin">Regulamin</a></li>
        <li class="mainmenu_separator"> <!-- --> </li>
    </ul>
    </div> <!-- [end] mainmenu_box -->
    
    <div class="clearfloat"> <!-- --> </div>