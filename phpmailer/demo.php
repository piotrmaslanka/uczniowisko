<?php
require("class.main.php");
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
	form::set_url("http://127.0.0.1/email/trunk/demo.php?");
}else{
 	form::set_url("http://paul.reallycoding.nl/email/trunk/demo.php?");
}
	
form::add_field('from','Jouw naam',NOT_EMPTY,'Naam niet ingevult','',1);
form::add_field('from2','Jouw email',EMAIL,'Email niet ingevult,of ongeldig.','',2);
form::add_field('subject','Onderwerp',SUBJECT,'Onderwerp niet ingevult','',2);
form::add_area('opmerking','Opmerkingen',NOT_EMPTY,'Opmerkingen niet ingevult.',35,10,'',3);
form::set_email_text('<img alt="MyLogo" src="cid:my-logo">Beste [to],<br /><br />Je ontvangt hierbij een email van [from] (Email [from2]). Verzonder vanaf een pc met IP: [IP].<br /><br />Bericht: <br /><br />[opmerking]');
form::to_desc('Naar: ');
form::add_to(2,array(
array("paul@paulscripts.nl","paul",""),
array("paul@reallycoding.nl","paul2",""),
array("bas@reallycoding.nl","bas"),
));
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	form::set_from('from2','from');
	if(form::check()){
		//Send mail :)
		$param = array(
			"smtp" => "SMTP_HOST",
			"port" => "SMTP_PORT",
			"user" => "SMTP_USER",
			"pass" => "SMTP_PASS" 
		);
		//I add to the main class a attachment ;)
		main::add_attachment("E:\mijn documenten\Mijn afbeeldingen\ftp.PNG","","image/png",true,"my-logo");
		
		if(form::mail(MAIL,$param)){
			print "Mail verstuurd";
		}else{
			print "Mail kon niet worden verstuurt.";
		}
	}else{
	//Iets niet goed!
	//Fouten staan in:
	//main::$error,als array.
	//Doe er wat leuks mee ;)
		main::error();
	}
}else{
 	form::build('Verstuur');
}
main::reset();
?>
