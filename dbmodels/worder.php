<?php 
/**
* @package models
 **/
class DBworder extends APIDBObject 
 {
 protected $__fields = array('id','fk_account','ordered','state','email','fk_work','adnots');
 protected $__table = 'worder';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($fk_account,$ordered,$email,$fk_work,$adnots)
 {
  global $conf;
  return parent::__create(array(
   'fk_account' => $fk_account,
   'ordered' => $ordered,
   'email' => $email,
   'fk_work' => $fk_work,
   'adnots' => $adnots
   ));
 }
}
 ?>