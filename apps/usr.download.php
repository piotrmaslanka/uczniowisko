<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!APISession::isLogged()) Location(APPPATH.'profile.login');
	
	if (empty($argv[1])) Location(APPPATH);
	if (empty($argv[2])) Location(APPPATH);
	
	$res = $db->query('SELECT attachment.* FROM purchase, worder, work, attachment WHERE
			   (attachment.fk_work=work.id) AND (work.id=worder.fk_work) AND
			   (worder.id=purchase.fk_worder) AND (attachment.id=%s) AND (purchase.id=%s)',array($argv[1],$argv[2]));
			   
	if ($db->getRows($res) == 1)
	{
		$row = $db->toArray($res);
		header('Content-type: application/octet-stream');
			// TODO: autodetect mime type?
			
		header('Content-Disposition: attachment; filename="'.$row['filename'].'"');
		readfile('files/'.$row['id']);
		
	} else Location(APPPATH);	   
	
?>