<?php
/**
 * Phpmail form class
 * Generate a complete contact form, with captha (If enabled, requires GD!)
 * @auteur Paul Sohier
 *
 **/
class form{
	private static $init = false;
	private static $hfield,$field,$area = array();
	private static $captcha = true;
	private static $captcha_be;
	private static $url,$durl;
	private static $mes;
	private static $to_name;
	private static $subject;
	private static $to;
	private static $to_desc;
	private static $from;
	private static $from2;
	/**
	 * Intiliaze all things
	 * @access private
	 **/	 
	static private function init(){
	 	if(self::$init){
	 	 	return;
	 	}
	 	if(main::$init === false){
	 	 	main::init();
	 	}
	 	self::$captcha_be= main::$lang['captcha_desc'];
	 	self::$url = self::$durl= 'http://127.0.0.1/';
	 	self::$init = true;
	 	//Check if main class exists.
	 	if(!class_exists('main')){
	 		trigger_error('Phpmail main class don\'t exist!');
	 	}
	 	if(isset($_GET['captcha'])){
			//Captcha is set.
			//Lets display :)
			ob_end_clean();//Delete all printed things.
			ob_start();
			header("content-type:image/png");
			if (function_exists('imageCreateTruecolor'))
			{
				$image = imageCreateTruecolor(150, 25);
				$background = imageColorAllocate($image, 255,255, 255);
				imageFilledRectangle($image , 0, 0, 150, 25, $background);
			}
			elseif(function_exists('imageCreate'))
			{
				$image = imageCreate(150, 25);
				$background = imageColorAllocate($image ,255,255,255);
			}
			
			
			$color2 = imageColorAllocate($image ,0,0,0);
			$ex = explode(" ",base64_decode($_GET['captcha']));
			for($i = 0; $i < count($ex); $i++){
				imageString($image, 5, (25 + $i * 14), rand(0,10),$ex[$i] , $color2);
			}
			for ($i = 0; $i < 15; $i++)
			{
				$iX = rand(0, 150);
				$iX2 = (rand(0, 1) == 1) ? $iX - rand(0, 100) : $iX + rand(0, 100);
				$rRandom_color = imageColorAllocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
				imageLine($image, $iX, 0, $iX2, 25, $rRandom_color);
			}			

			imagepng($image);
	 	 	imagedestroy($image);	 	 	
			die;
	 	}
	}
	/**
	 * Sets the text for the email
	 * @access public
	 **/
	 
	static public function set_email_text($mes){
		self::$mes= $mes;
	}
	/**
	 * Description of the to field
	 * @access public
	 **/
	static public function to_desc($mes){
		self::$to_desc = $mes;
	}
	/**
	 * Set the to field
	 * @param string $mode Set the mode to use, see below
	 * @param array $array set the array, needed for the mode
	 * @param string $naam, only required for mode 1
	 * Description of modes:
	 * 1:
	 * Set one person that got the email
	 * Use $array as string with the email, and $naam as string for the name
	 * 2:
	 * Send to more then one person the email
	 * Usage:
	 * $array as array:
	 * array(
	 * array('EMAIL','NAME'),
	 * array('EMAIL2','NAME2'	
	 * )
	 * $naam can be empty, will not be used
	 * @access private
	 **/
	static public function add_to($mode,$array,$naam = ''){
		switch($mode){
		 	case 1:
		 	      self::$to= $array;
		 	      self::$to_name = $naam;
		 	break;
		 	case 2:
		 		self::$to = $array;
		 	break;
		}
	}
	/**
	 * Function to check the to field set from the selectbox
	 * Only used when the mode of add_to is 2!
	 * @access private
	 **/ 	
	static private function set_to(){
	 	if(is_array(self::$to)){
	 	 	if(!isset($_POST['to'])){
	 	 	 	main::$error[] = main::$lang['to_not_set'];
	 	 	}else{
	 	 		$to = intval($_POST['to']);
	 	 		if(!isset(self::$to[$to])){
	 	 			main::$error[] = main::$lang['to_not_set'];
	 	 		}else{
	 	 			self::$to_name = self::$to[$to][1];
	 	 			self::$to = self::$to[$to][0];
	 	 		}	 	 		
	 	 	}	 	 	
	 	}
	}
	/**
	 * Check if every field is filled in correctly
	 * @access public
	 **/
	static public function check(){
		self::set_to();
		//First check captcha :)
		$error = false;
		if(self::$captcha === true){
			$str = $_POST['cmd'];
			if(strlen($str) != 32){
			 	trigger_error('Hacking attempt.',E_USER_ERROR);
			}
			$str2 = $_POST['cmd2'];
			$str2 = strtoupper($str2);
			$str2 = md5($str2);
			if($str !== $str2){//Captcha nog valid!!!!
				main::$error[] = main::$lang['captcha_error'];
				$error = true;				
			}
		}
		//Lets validated the other fields.
		$new = array();
		for($i = 0; $i < count(self::$hfield);$i++){	
			self::$hfield[$i]['type'] = 'hfield';
			self::$hfield[$i]['checked'] = false;
			$new[] = self::$hfield[$i];
		}		
		for($i = 0; $i < count(self::$field);$i++){	
			self::$field[$i]['type'] = 'field';
			self::$field[$i]['checked'] = true;
			$new[] = self::$field[$i];
		}
		for($i = 0; $i < count(self::$area);$i++){	
			self::$area[$i]['type'] = 'area';
			self::$area[$i]['checked'] = true;
			$new[] = self::$area[$i];
		}
		$message = self::$mes;
		//Lets validated every field!
		for($i = 0; $i < count($new);$i++){
			$tmp = $new[$i];
			$value = htmlspecialchars($_POST[$tmp['id']]);
			$checked = true;
			if($tmp['checked'] === true && $tmp['sort'] != CAPTCHA){
				switch($tmp['sort']){
				 	case EMPTY_FIELD:
				 		//No checking, always good :P
				 	break;
				 	case MONTH:
				 		$value = intval($value);
				 		if($value < 1 || $value > 12){
				 			$error = true;
				 			$checked = false;
				 			if(empty($tmp['error'])){
				 			 	$tmp['error'] = sprintf(main::$lang['month_invalid'],$value);
				 			 	$checked = false;
				 			 	$error = true;
				 			}
				 			main::$error[] = $tmp['error'];					 		
				 		}
				 	break;
				 	case DAY:
				 		$value = intval($value);
				 		if($day < 1 || $day > 31){
				 			$error = true;
				 			$checked = false;
				 			if(empty($tmp['error'])){
				 			 	$tmp['error'] = sprintf(main::$lang['day_invalid'],$value);
				 			 	$checked = false;
				 			 	$error = true;
				 			}
				 			main::$error[] = $tmp['error'];					 		
				 		}
				 	break;
				 	case YEAR:
				 		$value = intval($value);
				 		if(strlen($value) != 4){
				 			$error = true;
				 			$checked = false;
				 			if(empty($tmp['error'])){
				 			 	$tmp['error'] = sprintf(main::$lang['year_invalid'],$value);
				 			 	$checked = false;
				 			 	$error = true;
				 			}
				 			main::$error[] = $tmp['error'];					 		
				 		}
				 	break;				 	
				 	case URL:
				 	      $val = preg_match("/^[a-zA-z0-9:\/\.\-\?&_=]+$/",$value);
				 	      if(!$val){
				 			$error = true;
				 			$checked = false;
				 			if(empty($tmp['error'])){
				 			 	$tmp['error'] = sprintf(main::$lang['url_invalid'],$value);
				 			 	$checked = false;
				 			 	$error = true;
				 			}
				 			main::$error[] = $tmp['error'];				 			
				 	      }
				 	break;
				 	case EMAIL:
				 	      $val = main::check_email($value);
				 	      if(!$val){
				 			$error = true;
				 			$checked = false;
				 			if(empty($tmp['error'])){
				 			 	$tmp['error'] = sprintf(main::$lang['email_invalid'],$value);
				 			 	$checked = false;
				 			 	$error = true;
				 			}
				 			main::$error[] = $tmp['error'];				 			
				 	      }
				 	break;
					case NOT_EMPTY:
				 		if(empty($_POST[$tmp['id']])){
				 			if(empty($tmp['error'])){
				 			 	$tmp['error'] = sprintf(main::$lang['field_empty'],$tmp['id']);
				 			 	$checked = false;
				 			 	$error = true;
				 			}
				 			main::$error[] = $tmp['error'];
				 		}
				 	break;
				 	case SUBJECT:
			 			if(empty($_POST[$tmp['id']])){
				 			if(empty($tmp['error'])){
				 			 	$tmp['error'] = sprintf(main::$lang['field_empty'],$tmp['id']);
				 			 	$checked = false;
				 			 	$error = true;
				 			}
				 			main::$error[] = $tmp['error'];
				 		}else{
				 	      	self::$subject = $value;
				 	      }
				 	break;
				}			 
			}
			$message = eregi_replace("\r", "\n", $message);
			//Don't replace if there is a checked error!
			if($tmp['sort'] != CAPTCHA && $checked === true){
				$message = preg_replace("#\[".$tmp['id']."\]#si",$value,$message);
			}			
		}		
		//Replace default entry's
		$array = array(
			"#\[to\]#" => self::$to_name,
			"#\[ip\]#" => htmlspecialchars($_SERVER['REMOTE_ADDR'])
		);
		while(list($el,$wa) = each($array)){
		 	$message = preg_replace($el . "si",$wa,$message);
		}
		$message = nl2br($message);
		self::$mes = $message;
		
		return !$error;
	}
	/**
	 * Set the from adress.
	 * @access public
	 **/
	public static function set_from($email,$naam){
		self::$from = htmlspecialchars($_POST[$email]);
		self::$from2 = htmlspecialchars($_POST[$naam]);
	}
	/**
	 * Mail the email
	 * @param constant $method Method to send mail
	 * @param array $param Parameter for SMTP
	 **/
	public static function mail($method,$param){
		//Lets send the email :P
		main::setMethod($method);
		if($method == SMTP){
			main::setSmtpServer($param['smtp'],$param['port'],$param['user'],$param['pass']);
		}
		if(!is_array(self::$to)){
			main::setTo(array(array(self::$to,self::$to_name)));
		}else{
		 	main::setTo(self::$to);
		}
		main::setFrom(self::$from,self::$from2);
		
		main::setSubject(self::$subject);
		main::setMessage(self::$mes);
		return main::send(); 		
	}
	/**
	 * Build the form
	 * @auteur paul sohier
	 * @acces public
	 **/
	public static function build($submit_text = '',$desc_text = '',$table_class = '',$field_class = '',$area_class = '',$submit_class = ''){
		self::init();
		$test = 0;
		$test += count(self::$field);
		$test += count(self::$area);
		if($test === 0){
			main::$error[] = main::$lang['no_fields'];
			main::error();
		}
		if(self::$captcha === true){
			//Generate a nice string :)
			$string = self::generate_string(6);
			//Add a field, so we see the captcha :)
			self::add_hidden_field('cmd',md5(implode("",$string)),CAPTCHA);
			$string = implode(" ",$string);
			if(self::$url == self::$durl){
			 	trigger_error('No url added.');
			}
			$url = self::$url;
			if(!eregi("\?",$url)){
				$url .= "?captcha=" . base64_encode($string);
			}else{
				$and = "&";
				if(function_exists("ini_get")){
					if(@ini_get("arg_separator.input")){
						$and = @ini_get("arg_separator.input");
					}
				}
				$url .= $and . "captcha=" . base64_encode($string);
			}			
			self::add_field('cmd2',self::$captcha_be . "<br /><img src='".$url."' alt='captcha' />",CAPTCHA,'','',100001);
		}
		$new = array();
		for($i = 0; $i < count(self::$hfield);$i++){	
			self::$hfield[$i]['type'] = 'hfield';
			$new[-1][] = self::$hfield[$i];
		}
		for($i = 0; $i < count(self::$field);$i++){	
			self::$field[$i]['type'] = 'field';
			$new[self::$field[$i]['order']][] = self::$field[$i];
		}
		for($i = 0; $i < count(self::$area);$i++){	
			self::$area[$i]['type'] = 'area';
			$new[self::$area[$i]['order']][] = self::$area[$i];
		}
		print "<form method=\"post\" action=\"".self::$url."\">\n";
		print "<table class=\"$table_class\">\n";
		if(!empty($desc_text)){
			print "<tr>\n<td colspan=\"2\">$desc_text</td>\n</tr>\n";
		}
		if(is_array(self::$to)){
			print "<tr>\n<td>".self::$to_desc."</td>\n<td>";
			print "<select name=\"to\">";
			for($i = 0; $i < count(self::$to);$i++){
				print "<option value=\"$i\" ".self::$to[$i][2].">".self::$to[$i][1]."</option>";
			}
			print "</select>\n</td>\n</tr>\n";
		}		
		ksort($new,SORT_NUMERIC);
		//print "<pre>";htmlspecialchars(var_dump($new));print "</pre>";
		while(list(,$wa) = each($new)){
			ksort($wa);
			while(list(,$wa2) = each($wa)){
				self::make_form($wa2,$field_class,$area_class);			 	
			}
		}
		
		print "<tr>\n<td colspan=\"2\">\n<input type=\"submit\" name=\"submit\" value=\"$submit_text\" class=\"$submit_class\" />\n</td>\n</tr>\n";
		eval(base64_decode("cHJpbnQoJw0KPHRyPg0KPHRkIGNvbHNwYW49IjIiPg0KUG93ZXJlZCBieSA8YSBocmVmPSJodHRwOi8vd3d3LnBocG1haWwubmwvIj5QaHBtYWlsPC9hPiBmb3JtIGdlbmVyYXRvci4gJmNvcHkgMjAwNiBwaHBtYWlsLm5sDQo8L3RkPg0KPC90cj4nKTsNCg=="));
		print "</table>\n</form>";
		
	}
	/**
	 * Internal function to build the form
	 * @access private
	 **/
	static private function make_form($array,$c1,$c2){
		if($array['type'] == 'hfield'){
			//Iam an hidden field :P
			print "<input type=\"hidden\" value=\"".$array['value']."\" name=\"".$array['id']."\" id=\"".$array['id']."\" />";
		 	return;
		}
		print "<tr>\n";
		print "<td>\n";
		print $array['text'];
		print "</td>\n<td>";
		switch($array['type']){
			case "field":
			      print "<input type=\"text\" class=\"$c1\" name=\"".$array['id']."\" id=\"".$array['id']."\" value=\"".$array['value']."\" />";
			break;
			case "area":
				print "<textarea rows=\"".$array['rows']."\" cols=\"".$array['cols']."\" class=\"$c2\" name=\"".$array['id']."\" id=\"".$array['id']."\">".$array['value']."</textarea>";
			break;
		}
		print "</tr>\n</tr>\n";
	}
	/**
	 * Set the url of the contact form
	 * DONT FORGET THIS, IF YOU DON'T SET IT CORRECTLY, THE FORM DON'T WORK CORRECTLY!!!
	 * @access publuc
	 **/
	static public function set_url($url){
		self::init();
		self::$url = $url;
	}
	/**
	 * Add a hidden field
	 * @access public
	 **/
	static public function add_hidden_field($id,$value,$sort = EMPTY_FIELD){
		self::init();
		$i = count(self::$hfield);
		self::$hfield[$i] = array(
			"id" => $id,
			"value" => $value,
			"sort" => $sort
		);	
	}
	/**
	 * Add a field
	 * @acces public
	 **/
	public static function add_field($id,$text,$sort = EMPTY_FIELD,$error = '',$value = '',$order = 100000){
		self::init();
		$i = count(self::$field);
		self::$field[$i] = array(
			"id" => $id,
			"value" => $value,
			"text" => $text,
			"order" => $order,
			"sort" => $sort,
			"error" => $error
		);		
	}
	/**
	 * Add a textarea
	 * @access public
	 **/
	public static function add_area($id,$text,$sort = EMPTY_FIELD,$error = '',$cols = 35,$rows = 10,$value = '',$order = 100000){
		self::init();
		$i = count(self::$area);
		self::$area[$i] = array(
			"id" => $id,
			"value" => $value,
			"text" => $text,
			"order" => $order,
			"sort" => $sort,
			"cols" => $cols,
			"rows" => $rows,
			"error" => $error
		);		
	}
	/**
	 * Generate a string, used for Captcha.
	 * @access private	
	 **/
	private static function generate_string($num  = 5){
		self::init();
	 	$vars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	 	$i = 0;
	 	$return = array();
	 	while($i != $num){
	 	       $i++;
	 	       $return[] = strtoupper($vars[rand(0,(count($vars) - 1))]);
	 	       
	 	}                                                  
	 	return $return;
	}
}
?>
