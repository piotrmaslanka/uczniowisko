<?php 
/**
* @package models
 **/
class DBaccount extends APIDBObject 
 {
 protected $__fields = array('id','fk_tpusers','name','surname','address','postal','city','email','phone','gg','bankaccount','school','cash');
 protected $__table = 'account';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($fk_tpusers,$name,$surname,$address,$postal,$city,$email,$phone,$gg,$bankaccount,$school)
 {
  global $conf;
  return parent::__create(array(
   'fk_tpusers' => $fk_tpusers,
   'name' => $name,
   'surname' => $surname,
   'address' => $address,
   'postal' => $postal,
   'city' => $city,
   'email' => $email,
   'phone' => $phone,
   'gg' => $gg,
   'bankaccount' => $bankaccount,
   'school' => $school
   ));
 }
}
 ?>