<?php
	// code by Piotr Maślanka, sppiotr@dms-serwis.com.pl
	if (!$_SESSION['admin']) Location(APPPATH);
	
	if ($argv[2] == 'paid')
	{
		$tpl['mode'] = 'paid';		
		conventional_event_call('order.accept.pending',array($argv[1]));		
	} elseif ($argv[2] == 'delete')
	{
		$tpl['mode'] = 'delete';
		conventional_event_call('order.delete.delete',array($argv[1]));		
	} else Location(APPPATH);
	
	_show_template('order.dispose');
?>