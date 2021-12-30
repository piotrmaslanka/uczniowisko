<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
		include_once('includes/email.php');

        $adminmail = null;
        new FilterInstance('admin.email.get',null,$adminmail);

	$p24 = new DBprzelewy24($db);
	if (!$p24->__load($_POST['p24_session_id']))
	{
		new APILogEvent(4,1,'Przelewy24 sent invalid session ID',
			'Normally palazmatmy uses Przelewy24 session_id as a container for przelewy24 database primary key. But this time it couldnt load the ID given by Przelewy24',
			array(),'error');
			die();
	}

	if ($argv[1]=='ok')
	{
		$p24->p24_order_id_full = $_POST['p24_order_id_full'];	
		$p24->p24_order_id = $_POST['p24_order_id'];
		
		$pc = curl_init('https://secure.przelewy24.pl/transakcja.php');
		curl_setopt($pc, CURLOPT_POST, 1);
		curl_setopt($pc, CURLOPT_POSTFIELDS, array('p24_session_id'=>$p24->id,
											  'p24_order_id'=>$_POST['p24_order_id'],
											  'p24_id_sprzedawcy'=>6690,
											  'p24_kwota'=>$_POST['p24_kwota']
											  ));
		curl_setopt($pc, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($pc, CURLOPT_SSL_VERIFYHOST, false);											  
		curl_setopt($pc, CURLOPT_SSL_VERIFYPEER, false);
		$ret = curl_exec($pc);
		curl_close($pc);
		
		
		$T = explode(chr(13).chr(10),$ret);
		$res = false;
		foreach($T as $line){ echo $line.'<br>';
		$line = ereg_replace("[\n\r]","",$line);
		if($line != "RESULT" and !$res) continue;
		if($res) $RET[] = $line;
		else $res = true;
		}
		
		
		if ($RET[0]=='TRUE')
		{
			$p24->phase = 2;
			$p24->__store();
			new EventInstance('order.accept.pending',array($p24->fk_worder));
			MAILsend($adminmail,
        		'Uczniowisko.pl - Przelewy24',
        		"Transakcja nr $p24->fk_worder została zrealizowana pomyślnie");
		} else
		{
			$p24->phase = 1;
			$p24->error = $RET[1];
			$p24->__store();
		      MAILsend($adminmail,
        		'Uczniowisko.pl - nieudane Przelewy24',
        		"Serwis Przelewy24 zwrócił nieudaną odpowiedź na transakcję nr $p24->fk_worder o kodzie błędu ".$RET[1]."o opisie ".$RET[2]);
        		
	        $ord = new DBworder($db);
        	$ord->__load($p24->fk_worder);

        	MAILsend($ord->email,
        		'Uczniowisko.pl - nieudane Przelewy24',
        		"Serwis Przelewy24 zwrócił nieudaną odpowiedź na transakcję nr $p24->fk_worder o kodzie błędu $p24->error. Spróbuj ponownie lub skontaktuj się z administratorem. Pieniądze nie zostały przesłane na konto uczniowisko.pl");			
		}
		
		
			
	} elseif ($argv[1]=='error')
	{
		$p24->error = $_POST['p24_error_code'];
		$p24->phase = 1;
		$p24->__store();
		
		include_once('includes/email.php');

        $adminmail = null;
        new FilterInstance('admin.email.get',null,$adminmail);
   
    
        MAILsend($adminmail,
        		'Uczniowisko.pl - nieudane Przelewy24',
        		"Serwis Przelewy24 zwrócił nieudaną odpowiedź na transakcję nr $p24->fk_worder o kodzie błędu $p24->error");
        		
        $ord = new DBworder($db);
        $ord->__load($p24->fk_worder);

        MAILsend($ord->email,
        		'Uczniowisko.pl - nieudane Przelewy24',
        		"Serwis Przelewy24 zwrócił nieudaną odpowiedź na transakcję nr $p24->fk_worder o kodzie błędu $p24->error. Skontaktuj się z administratorem.");
        		
	}
?>