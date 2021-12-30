<?php 
/**
* @package models
 **/
class DBattachment extends APIDBObject 
 {
 protected $__fields = array('id','filename','fk_work','description');
 protected $__table = 'attachment';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($filename,$fk_work,$description)
 {
  global $conf;
  return parent::__create(array(
   'filename' => $filename,
   'fk_work' => $fk_work,
   'description' => $description
   ));
 }
}
 ?>