<?php
require_once('includes/bootstrap.php');
function __autoload($classname)
{
    if (substr($classname, 0, 2) == 'DB')
        require_once('dbmodels/'.substr($classname, 2).'.php');
}
APISession::start();
$argv = explode('/',substr(@$_SERVER['PATH_INFO'],1)); 

if (!$argv[0]) $argv[0] = 'index'; 
if (!@include_once('apps/'.$argv[0].'.php')) include_once('apps/index.php'); 
?>