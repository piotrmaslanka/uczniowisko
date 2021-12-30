<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
		// our content distribution doesn't say we can let you download, lololox
		// so make it admin-only
	if (!$_SESSION['admin']) Location(APPPATH);
	
	$att = new DBattachment($db);
	if (!$att->__load($argv[1])) Location(APPPATH);
	
	header('Content-type: application/octet-stream');
			// TODO: autodetect mime type?
			
	header('Content-Disposition: attachment; filename="'.$att->filename.'"');
	readfile('files/'.$att->id);
?>