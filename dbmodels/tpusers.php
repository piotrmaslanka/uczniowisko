<?php 
/**
* @package models
 **/
class DBtpusers extends APIDBObject 
 {
 protected $__fields = array('id','username','password','token','registry','privileges','licenses','type');
 protected $__table = 'tpusers';
 function __construct(&$dbh) { parent::__construct($dbh); }
 function __create($username,$password,$token,$registry,$privileges,$licenses,$type)
 {
  global $conf;
  return parent::__create(array(
   'username' => $username,
   'password' => $password,
   'token' => $token,
   'registry' => $registry,
   'privileges' => $privileges,
   'licenses' => $licenses,
   'type' => $type
   ));
 }
}
 ?>