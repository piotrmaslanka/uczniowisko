<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
		// ON ALERT!
		// Shall przelewy24 site get changed, this file will have to be changed as well, as it uses 
		// string effects to insert base_href
	if (!$_SESSION['oid']) Location(APPPATH);
		
	$pp24 = new DBprzelewy24($db);
	
	if ($pp24->__checkBy('fk_worder',$_SESSION['oid'])) Location(APPPATH);
	
	$pp24->__create($_SESSION['oid']);
	
	$ord = new DBworder($db);
	$ord->__load($_SESSION['oid']);
	$wrk = new DBwork($db);
	$wrk->__load($ord->fk_work);
	$acc = new DBaccount($db);
	$acc->__load($ord->fk_account);
	$cat = new DBcategory($db);
	$cat->__sload($wrk->fk_category,array('fk_overmode'));

	$p24 = curl_init('https://secure.przelewy24.pl');
	$c = curl_setopt($p24, CURLOPT_POST, 1);
	$c = curl_setopt($p24, CURLOPT_POSTFIELDS,array('p24_session_id'=>$pp24->id,
										 'p24_id_sprzedawcy'=>6690,
										 'p24_kwota'=>$cfg['work_prices'][$cat->fk_overmode]*100,
										 'p24_klient'=>$acc->name.' '.$acc->surname,
										 'p24_kod'=>$acc->postal,
										 'p24_adres'=>$acc->address,
										 'p24_miasto'=>$acc->city,
										 'p24_kraj'=>'PL',
										 'p24_email'=>$ord->email,
										 'p24_return_url_ok'=>'http://uczniowisko.pl/index.php/przelewy24.parser/ok',
										 'p24_return_url_error'=>'http://uczniowisko.pl/index.php/przelewy24.parser/error',
										 'p24_opis'=>//'TEST_OK',		// substitute with
										 		$ord->adnots,
										 		// to get WORKING mode 
										 'p24_language'=>'pl'));

		/* przelewy24.pl doesn't present itself with a valid certificate. skip the checks */
		 
	curl_setopt($p24, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($p24, CURLOPT_SSL_VERIFYPEER, false);
	
	curl_setopt($p24, CURLOPT_RETURNTRANSFER, true);

	$page_content = curl_exec($p24);
	
		// HACK OF ETERNITY BEGINS
	
	$headpos = strpos($page_content, '<head>')+6;
	$str1 = substr($page_content, 0, $headpos);
	$str2 = substr($page_content, $headpos);
	
	echo $str1.'<!-- inserted by uczniowisko.pl STARTS --><base href="https://secure.przelewy24.pl/" /><!-- insert ends -->'.$str2;
	
		// HACK OF ETERNITY ENDS
		
	curl_close($p24);
?>