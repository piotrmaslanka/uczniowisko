<?php 
/**
* @package models
 **/
class DBwork extends APIDBObject 
 {
 protected $__fields = array('id','fk_category','title','fk_account','usedworks','downloads','added','comment','grade','mode');
 protected $__table = 'work';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($fk_category,$title,$fk_account,$usedworks,$added,$comment,$grade)
 {
  global $conf;
  return parent::__create(array(
   'fk_category' => $fk_category,
   'title' => $title,
   'fk_account' => $fk_account,
   'usedworks' => $usedworks,
   'added' => $added,
   'comment' => $comment,
   'grade' => $grade
   ));
 }
}
 ?>