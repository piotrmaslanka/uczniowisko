<?php
ob_start();
error_reporting(E_ALL | E_STRICT);
require("class.smtp.php");
require("constants.php");
require("class.form.php");
class main{
	static public $lang = array();
	static public $config;
	static public $init = false;
	static public $method = MAIL;//Use default the mail() function.
	static public $error = array();
	static public $to,$cc,$bcc,$reply = array();
	static public $from = 'localhost@localdomain.localhost';
	static public $from2;
	static public $lnd = "\n";
	static public $boundary;
	static public $subject;
	static public $priority = '3';
	static public $message;
	static public $header = array();
	static public $smtp_host = 'localhost';
	static public $smtp_port = '25';
	static public $auth = false;
	static public $user = '';
	static public $pass = '';
	static private $attachment = array();
	static private $has_inline = false;
	
	const versie = '0.0.2';
	static public function reset(){
		self::$lang = array();
		self::$config;
		self::$init = false;
		self::$method = MAIL;//Use default the mail() function.
		self::$error = array();
		self::$to = $cc = $bcc = $reply = array();
		self::$from = 'localhost@localdomain.localhost';
		self::$from2;
		self::$lnd = "\r\n";
		self::$boundary;
		self::$subject;
		self::$priority = '3';
		self::$message;
		self::$header = array();
		self::$smtp_host = 'localhost';
		self::$smtp_port = '25';
		self::$auth = false;
		self::$user = '';
		self::$pass = '';	
		self::$has_inline = false;
		self::$attachment = array();
		self::init();	
	}
	
	static public function init(){
		if(self::$init === true){
		 	trigger_error(self::$lang['already_init'],E_USER_ERROR);
		}
		self::$init = true;
		//Load Configuration
		$config = array();
		require("config.inc.php");
		self::$config = $config;
		//Load lang. 
		//Give error if not exists.
		if(!file_exists("lang/" . self::$config['lang'] . ".php")){
			if(self::$config['lang'] == "en"){
				//The default lang is english, but that don't exists.
				self::$lang['lang_not_exists'] = 'The english (Thats set as default) don\'t exists.';
			}else{
				$lang = array();
		 		include("lang/en.php");
		 		self::$lang = array_merge(self::$lang,$lang);
		 		//set default lang into that var!
		 		self::$lang['lang_not_exists'] = sprintf(self::$lang['lang_not_exists'],self::$config['lang']);
		 	}
		 	trigger_error(self::$lang['lang_not_exists'],E_USER_ERROR);
		}else{
			$lang = array();
	 		include("lang/en.php");
	 		self::$lang = array_merge(self::$lang,$lang);		 	
		}
	}
	static private function inited(){
		if(self::$init !== true){
		 	self::init();
		}
	}
	static public function setSmtpServer($host,$port,$user = false,$pass = ''){
	 	self::$smtp_host = $host;
	 	self::$smtp_port = $port;
	 	self::$auth = ($user === false || empty($pass)) ? false : true;
	 	self::$user = $user;
	 	self::$pass = $pass;
	}                   
	//Main functions
	static public function setMethod($sMethod){
		self::inited();
		//Detect the method to send email.
		//At this moment only mail() and smtp can be used.
		switch($sMethod){
			case MAIL:
			case SMTP:
				self::$method = $sMethod;//Method valid, we can use $sMethod.
			break;
			default:{
				trigger_error(sprintf(self::$lang['method_not_exists'],$sMethod));
			}		  
		}
	}
	static public function setFrom($from = '',$name = ''){
		if(!self::check_email($from)){
			self::$error[] = sprintf(self::$lang['email_not_valid'],htmlspecialchars($from));
			self::error();
		}
		self::$from = $from;	
		self::$from2 = $name;
	}
	static public function setMessage($message){
		self::$message = $message;
	}
	static public function setSubject($subject){
		self::$subject = $subject;
	}
	static public function setReply($reply){
		self::checksetting($reply,self::$error,'reply');
	}	
	static public function setTo($to){
		self::checksetting($to,self::$error);
	}
	static public function setBcc($bcc){
		self::checksetting($from,self::$error,'bcc');
	}
	static public function setCc($cc){
		self::checksetting($from,self::$error,'cc');
	}
	static public function addHeader($a,$b){
		$c = count(self::$header);
		self::$header[$c][0] = $a;
		self::$header[$c][1] = $b;
	}
	static public function error(&$error = array()){
		if(count(self::$error) & !count($error)){
		 	$error = self::$error;
		}
		if(!count($error)){
		 	return;
		}
		//There are errors :)
		$err = self::$lang['error'];
		$err .= "<br /><ol>";
		for($i = 0; $i < count($error);$i++){
			$err .= "<li>";
			$err .= $error[$i];
			$err .= "</li>";
		}
		$err .= "</ol>";
		trigger_error($err,E_USER_ERROR);
	}
	
	//Private functions
	static private function checksetting(&$email,&$error,$mode = 'to'){
		if(!is_array($email) && $mode != 'from'){
		  $error[] = self::$lang['no_valid_' . $mode];
		  return;
		}
		for($i = 0; $i < count($email);$i++){
		 	if((!is_array($email[$i]) || count($email[$i]) != 2)){
		 		$error[] = self::$lang['no_valid_' . $mode];
		 		continue;
		 	}
		 	if($mode != 'from'){
			 	if(!self::check_email($email[$i][0])){
			 		$error[] = sprintf(self::$lang['email_not_valid'],htmlspecialchars($email[$i][0]));
			 		continue;
			 	}
			}else{
			
			}
		 	//There has been no error :)
	 		switch($mode){
	 		 	case 'to':
	 		 		self::$to[] = $email[$i];
	 		 	break;
	 		 	case 'cc':
	 		 		self::$cc[] = $email[$i];
	 		 	break;
	 		 	case 'bcc':
	 		 		self::$bcc[] = $email[$i];
	 		 	break;
	 		 	case 'reply':
	 		 		self::$reply[] = $email[$i];
	 		 	break;
	 		}
		 	
		}
		if(count($error)){
		 	//There has been an error.
		 	//Run error handler :)
		 	self::error($error);
		}	
	}
	public static function check_email(&$email){
	 	return preg_match('/^[A-Za-z0-9\+._-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,6}$/', $email);
	}
	public static function send(){
		$result = false;
	      switch(self::$method){
			case MAIL:
				$header = self::CreateHeader();
				//$header = str_replace();
				self::$message = self::createBody();
				
		            $old_from = @ini_get("sendmail_from");
		            @ini_set("sendmail_from", self::$from);
		            $params = sprintf("-oi -f %s", self::$from);
				$to = "";
				$ar = self::$to;
				if(count(self::$cc)){
				 	$ar = array_merge($ar,self::$cc);
				}
				for($i = 0; $i < count($ar); $i++){
					if($i != 0) { 
						$to .= ", "; 
					}
					$to .= $ar[$i][0];
				}            
				if(mail($to,self::$subject,self::$message,$header,$params)){//
					$result = true;
				}else{
					$result = false;
				}
				@ini_set("sendmail_from", $old_from);
			break;
			case SMTP:
				$result =  smtp::send();
			break;
			default:{
				trigger_error(sprintf(self::$lang['method_not_exists'],self::$method));
			}					
	      }
		return $result;
	}	
	/* *
	 *  Some function from phpmailer. Will be changed later to our functions.
	 **/
	
	static private function AddrAppend($type, $addr) {
		$addr_str = $type . ": ";
		$addr_str .= self::AddrFormat($addr[0]);
		if(count($addr) > 1){
			for($i = 1; $i < count($addr); $i++){
				$addr_str .= ", " . self::AddrFormat($addr[$i]);
			}
		}
		$addr_str .= self::$lnd;
		
		return $addr_str;
	}
	
	static private function AddrFormat($addr) {
		if(empty($addr[1])){
			$formatted = $addr[0];
		}else
		{
			$formatted =  self::EncodeHeader($addr[1], 'phrase') . "<" . $addr[0] . ">";
		}
		
		return $formatted;
	}		
	public static function CreateHeader() {
		$result = "";
		
		// Set the boundaries
		$uniq_id = md5(uniqid(time()));
		self::$boundary = array();
		self::$boundary[1] = "b1_" . $uniq_id;
		self::$boundary[2] = "b2_" . $uniq_id;
		
		$result .= self::HeaderLine("Date", self::RFCDate());
		$result .= self::HeaderLine("Return-Path", trim(self::$from));
		
		$from = array();
		$from[0][0] = trim(self::$from);
		if(!eregi("WIN",PHP_OS)){
			//Bug 1436866
			$from[0][1] = trim(self::$from2);
		}
		$result .= self::AddrAppend("From", $from); 

		if(self::$method != MAIL){
			//With the mail() function, this headers will be added automatticly.
			if(count(self::$to) > 0){
				$result .= self::AddrAppend("To", self::$to);
			}else if (count(self::$cc) == 0){
				$result .= self::HeaderLine("To", "undisclosed-recipients:;");
			}
			if(count(self::$cc) > 0){
				$result .= self::AddrAppend("Cc", self::$cc);
			}
		}


		
		
	
		if((count(self::$bcc) > 0)){
			$result .= self::AddrAppend("Bcc", $this->bcc);
		}
		
		if(count(self::$reply) > 0){
			$result .= self::AddrAppend("Reply-to",self::$reply);
		}
		
		
		
		$result .= self::HeaderLine("Subject", self::EncodeHeader(trim(self::$subject)));
		
		
		$result .= "Message-ID: <".$uniq_id."@".$_SERVER['SERVER_NAME'] . ">" . self::$lnd;
		$result .= self::HeaderLine("X-Priority", self::$priority);
		$result .= self::HeaderLine("X-Mailer", "php mail system version " . self::versie . "");
		

		for($i = 0; $i < count(self::$header);$i++)
		{
			$result .= self::HeaderLine(trim(self::$header[$i][0]), self::EncodeHeader(trim(self::$header[$i][1])));
		}                                                    
		$result .= self::HeaderLine("MIME-Version", "1.0"); 
		
		if(count(self::$attachment)){
			if(self::$has_inline)
			{
				$result .= sprintf("Content-Type: %s;%s\ttype=\"text/html\";%s\tboundary=\"%s\"%s", 
				"multipart/related",self::$lnd, self::$lnd, 
				self::$boundary[1], self::$lnd);
			}
			else
			{
				$result .= self::HeaderLine("Content-Type", "multipart/mixed;");
				$result .= "\tboundary=\"" . self::$boundary[1] . '"';
			}
		}else{
			$result .= self::HeaderLine("Content-Type", "multipart/alternative;");
			$result .= "\tboundary=\"" . self::$boundary[1] . '"' . self::$lnd;	
		}

		
		$result .= self::$lnd.self::$lnd;
		
		return $result;
	}
	static private function HeaderLine($name, $value) {
		return $name . ": " . $value . self::$lnd;
	}
	static public function CreateBody() {
		$result = "";
		
		$tmp = self::$message;
		$tmp = preg_replace("<(.*?)br(.*)>","\n",$tmp);
		$tmp = preg_replace("<(.*?)>","",$tmp);
		if(!count(self::$attachment)){
			//There are no attachments :)
			$result .= self::GetBoundary(self::$boundary[1], "", "text/plain", "");
			$result .= self::EncodeString($tmp, self::$config['Encoding']);
			$result .= self::$lnd.self::$lnd;
			$result .= self::GetBoundary(self::$boundary[1], "", "text/html", "");
			
			$result .= self::EncodeString(self::$message, self::$config['Encoding']);
			$result .= self::$lnd.self::$lnd;           
			
			$result .= self::EndBoundary(self::$boundary[1]);
		}else{
			$result .= sprintf("--%s%s", self::$boundary[1], self::$lnd);
			$result .= sprintf("Content-Type: %s;%s\tboundary=\"%s\"%s", "multipart/alternative", self::$lnd,  self::$boundary[2], self::$lnd.self::$lnd);
	
			// Create text body
			$result .= self::GetBoundary(self::$boundary[2], "", "text/plain", "") . self::$lnd;

			$result .= self::EncodeString($tmp, self::$config['Encoding']);
			$result .= self::$lnd.self::$lnd;
	
			// Create the HTML body
			$result .= self::GetBoundary(self::$boundary[2], "", "text/html", "") . self::$lnd;
	
			$result .= self::EncodeString(self::$message, self::$config['Encoding']);
			$result .= self::$lnd.self::$lnd;

			$result .= self::EndBoundary(self::$boundary[2]);
			
			$mime = array();
	
			// Add all attachments
			for($i = 0; $i < count(self::$attachment); $i++)
			{
				$d = self::$attachment[$i];
				
				$data = $d['content'];
	
				$filename	= $d['file'];
				$name		= $d['name'];
				$encoding	= $d['encoding'];
				$type		= $d['type'];
				$disposition = $d['attach_type'];
				$cid		 = $d['cid'];
				
				$mime[] = sprintf("--%s%s", self::$boundary[1], self::$lnd);
				$mime[] = sprintf("Content-Type: %s; name=\"%s\"%s", $type, $name, self::$lnd);
				$mime[] = sprintf("Content-Transfer-Encoding: %s%s", $encoding, self::$lnd);
	
				if($disposition == "inline"){//This isn't used yet!
					$mime[] = sprintf("Content-ID: <%s>%s", $cid, self::$lnd);
				}
	
				$mime[] = sprintf("Content-Disposition: %s; filename=\"%s\"%s", $disposition, $name, self::$lnd.self::$lnd);
	
				$mime[] = self::EncodeString($data, $encoding);
				$mime[] = self::$lnd.self::$lnd;

			}
	
			$mime[] = sprintf("--%s--%s", self::$boundary[1], self::$lnd);
	
			$result .= implode("",$mime);
				
		}
	
		
		return $result;
	}
	static private function EndBoundary($boundary) {
		return self::$lnd . "--" . $boundary . "--" . self::$lnd; 
	}	
	static private function GetBoundary($boundary, $charSet, $contentType, $encoding) {
		$result = "";
		if($charSet == "") { 
			$charSet = self::$config['CharSet']; 
		}
		if($contentType == "") { 
			$contentType = self::$config['ContentType']; 
		}
		if($encoding == "") { 
			$encoding = self::$config['Encoding']; 
		}
		
		$result .= "--" . $boundary . self::$lnd;
		$result .= sprintf("Content-Type: %s; charset = \"%s\"", $contentType, $charSet);
		$result .= self::$lnd;
		$result .= self::HeaderLine("Content-Transfer-Encoding", $encoding);
		$result .= self::$lnd;
		       
		return $result;
	}	
	/*
	 * Encoding functions, from phpmailer, modified to use.
	 */
	static private function EncodeString ($str, $encoding = "base64") {
		$encoded = "";
		switch(strtolower($encoding)) {
			case "base64":
				// chunk_split is found in PHP >= 3.0.6
				$encoded = chunk_split(base64_encode($str), 76, self::$lnd);
				break;
			case "7bit":
			case "8bit":
				$encoded = self::FixEOL($str);
				if (substr($encoded, -(strlen(self::$lnd))) != self::$lnd){
					$encoded .= self::$lnd;
				}
				break;
			case "binary":
				$encoded = $str;
				break;
			case "quoted-printable":
				$encoded = self::EncodeQP($str);
				break;			
		}			
		return $encoded;
	}
	static private function FixEOL($str) {
		$str = str_replace("\r\n", "\n", $str);
		$str = str_replace("\r", "\n", $str);
		$str = str_replace("\n", self::$lnd, $str);
		return $str;
	}	
	
	static private function EncodeHeader ($str, $position = 'text') {
		$x = 0;
		  
		switch (strtolower($position)) {
			case 'phrase':
				if (!preg_match('/[\200-\377]/', $str)) {
					// Can't use addslashes as we don't know what value has magic_quotes_sybase.
					$encoded = addcslashes($str, "\0..\37\177\\\"");
					
					if (($str == $encoded) && !preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -]/', $str)){
						return ($encoded);
					}else{
						return ("\"$encoded\"");
					}
				}
				$x = preg_match_all('/[^\040\041\043-\133\135-\176]/', $str, $matches);
			break;
			case 'comment':
				$x = preg_match_all('/[()"]/', $str, $matches);
				// Fall-through
			case 'text':
			default:
				$x += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/', $str, $matches);
			break;
		}
		
		if ($x == 0){
			return ($str);
		}
		
		$maxlen = 75 - 7 - strlen(self::$config['CharSet']);
		

		$encoding = 'B';
		$encoded = base64_encode($str);
		$maxlen -= $maxlen % 4;
		$encoded = trim(chunk_split($encoded, $maxlen, "\n"));

		
		$encoded = preg_replace('/^(.*)$/m', " =?".self::$CharSet."?$encoding?\\1?=", $encoded);
		$encoded = trim(str_replace("\n", self::$lnd, $encoded));
		  
		return $encoded;
	}

	static private function EncodeQP ($str) {
		$encoded = self::FixEOL($str);
		if (substr($encoded, -(strlen(self::$lnd))) != self::$lnd){
			$encoded .= self::$lnd;
		}
		
		// Replace every high ascii, control and = characters
		$encoded = preg_replace('/([\000-\010\013\014\016-\037\075\177-\377])/e',"'='.sprintf('%02X', ord('\\1'))", $encoded);
		// Replace every spaces and tabs when it's the last character on a line
		$encoded = preg_replace("/([\011\040])".self::$lnd."/e","'='.sprintf('%02X', ord('\\1')).'".self::$lnd."'", $encoded);
		
		// Maximum line length of 76 characters before CRLF (74 + space + '=')
		$encoded = self::WrapText($encoded, 74, true);
		
		return $encoded;
	}
	static private function EncodeQ ($str, $position = "text") {
		$encoded = preg_replace("[\r\n]", "", $str);
		
		switch (strtolower($position)) {
			case "phrase":
			$encoded = preg_replace("/([^A-Za-z0-9!*+\/ -])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
			break;
		case "comment":
			$encoded = preg_replace("/([\(\)\"])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
			case "text":
		default:
			$encoded = preg_replace('/([\000-\011\013\014\016-\037\075\077\137\177-\377])/e',"'='.sprintf('%02X', ord('\\1'))", $encoded);
			break;
		}
	
		// Replace every spaces to _ (more readable than =20)
		$encoded = str_replace(" ", "_", $encoded);
		
		return $encoded;
	}
	static private function RFCDate() {
		$tz = date("Z");
		$tzs = ($tz < 0) ? "-" : "+";
		$tz = abs($tz);
		$tz = ($tz/3600)*100 + ($tz%3600)/60;
		$result = sprintf("%s %s%04d", date("D, j M Y H:i:s"), $tzs, $tz);
		
		return $result;
	}
	static public function add_attachment($file,$name = "",$type = "application/octet-stream",$inline = false,$cid = "",$encoding = "base64"){
		if(!file_exists($file) || !is_file($file)){
			self::$error[] = sprintf(self::$lang['Attach_not_exist'],$file);
			return false;
		}	
		$file2 = file_get_contents($file);
		self::$attachment[] = array(
			"content" => $file2,
			"name" => (!empty($name)) ? $name : basename($file), 
			"file" => $file,//Not used, but save it for if there are problems :)
			"type" => $type,
			"encoding" => $encoding,
			"attach_type" => ($inline) ? "inline" : "attachment",
			"cid" => $cid,
			"filename" => basename($file)			
		);
		self::$has_inline = self::$has_inline || $inline;
		return true;
	}
	static public function add_attachment_string($string,$name,$type = "application/octet-stream",$inline = false,$cid = "",$encoding = "base64"){
		self::$attachment[] = array(
			"content" => $string,
			"name" => $name, 
			"file" => "",
			"type" => $type,
			"encoding" => $encoding,
			"attach_type" => ($inline) ? "inline" : "attachment",
			"cid" => $cid,//Not used yet, will be used later.
			"filename" => ""			
		);
		self::$has_inline = self::$has_inline || $inline;
		return true;
	}		
}
?>
