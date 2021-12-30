<?php 
    require_once('config.php');
    require_once('techplatform/libtechplatform.php');
    require_once('tplpatcher.php');
    define('APPPATH','http://uczniowisko.pl/index.php/');
    define('SRCPATH','http://uczniowisko.pl/');
    $db = new APIDatabase($cfg['db_host'], $cfg['db_user'], $cfg['db_pass']);
    $db->connect();
    $db->selectDatabase($cfg['db_db']);
    if (@$cfg['debug'])	$db->setDebug(true);
    
    ini_set('display_errors',1);
    error_reporting(E_ALL);
   ?>