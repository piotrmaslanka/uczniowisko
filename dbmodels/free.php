<?php 
/**
* @package models
 **/
class DBfree extends APIDBObject 
 {
 protected $__fields = array('id','title','body','fk_category');
 protected $__table = 'free';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($title,$body,$fk_category)
 {
  global $conf;
  return parent::__create(array(
   'title' => $title,
   'body' => $body,
   'fk_category' => $fk_category
   ));
 }
}
 ?>