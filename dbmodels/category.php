<?php 
/**
* @package models
 **/
class DBcategory extends APIDBObject 
 {
 protected $__fields = array('id','name','fk_overmode','fk_category');
 protected $__table = 'category';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($name,$fk_overmode,$fk_category)
 {
  global $conf;
  return parent::__create(array(
   'name' => $name,
   'fk_overmode' => $fk_overmode,
   'fk_category' => $fk_category
   ));
 }
}
 ?>