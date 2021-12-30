<?php 
/**
* @package models
 **/
class DBcomment extends APIDBObject 
 {
 protected $__fields = array('id','fk_account','fk_work','added','data','nick','status');
 protected $__table = 'comment';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($fk_account,$fk_work,$added,$data,$nick)
 {
  global $conf;
  return parent::__create(array(
   'fk_account' => $fk_account,
   'fk_work' => $fk_work,
   'added' => $added,
   'data' => $data,
   'nick' => $nick
   ));
 }
}
 ?>