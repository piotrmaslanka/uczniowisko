<?php 
/**
* @package models
 **/
class DBpurchase extends APIDBObject 
 {
 protected $__fields = array('id','fk_worder','activated','vkey');
 protected $__table = 'purchase';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($fk_worder,$activated,$vkey)
 {
  global $conf;
  return parent::__create(array(
   'fk_worder' => $fk_worder,
   'activated' => $activated,
   'vkey' => $vkey
   ));
 }
}
 ?>