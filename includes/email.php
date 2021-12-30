<?php	
	include_once('phpmailer/class.phpmailer.php');
	
	/**
	 * connects to a SMTP server and returns the object
	 * @return SMTPServer
	 */
	function MAILsend($to, $title, $text)
	{
		global $cfg;
		
		mail($to, $title, $text, 'Content-type: text/html; charset=utf-8');
		/*$mail = new PHPMailer();
		$mail->IsSMTP();
	    $mail->PluginDir = 'phpmailer/';
		$mail->Mailer = "smtp";
		$mail->Host	= $cfg['smtp_host'];

  		$mail->SMTPSecurity   = $cfg['smtp_ssl'];
		$mail->Port			= $cfg['smtp_port'];

  $mail->SMTPAuth		= $cfg['smtp_auth'];
  $mail->Username		= $cfg['smtp_user'];
  $mail->Password		= $cfg['smtp_pass'];
  
  // Optional: Specify character coding and encoding
  $mail->CharSet	= "utf-8";
  $mail->Encoding	= "quoted-printable";

  // Some mail info
  $mail->FromName	= $cfg['smtp_friendly'];
  $mail->From = $cfg['smtp_email'];
//  $mail->AddReplyTo("REPLY_TO_ADDRESS");
  $mail->Subject	= $title;
  $mail->Body		= $text;
  $mail->AddAddress($to,$to);
  
  $mail->SMTPDebug = true;
  
  // And finaly - send the mail
  if(!$mail->Send())
  { var_dump($mail->ErrorInfo);
	new APILogEvent(4,1,'email.php failed to send an email','Failed to send an email',
	array('data'=>$mail->ErrorInfo),'error');
	}		

	*/
	}
	
?>