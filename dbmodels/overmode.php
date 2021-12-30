<?php 
/**
* @package models
 **/
class DBovermode extends APIDBObject 
 {
 protected $__fields = array('id','tag');
 protected $__table = 'overmode';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($tag)
 {
  global $conf;
  return parent::__create(array(
   'tag' => $tag
   ));
 }
}
 ?>