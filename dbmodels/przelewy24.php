<?php 
/**
* @package models
 **/
class DBprzelewy24 extends APIDBObject 
 {
 protected $__fields = array('id','fk_worder','phase','p24_order_id_full','p24_order_id','error');
 protected $__table = 'przelewy24';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($fk_worder)
 {
  global $conf;
  return parent::__create(array(
   'fk_worder' => $fk_worder
   ));
 }
}
 ?>