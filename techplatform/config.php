<?php
	/**
	 * 	config
	 * 	
	 *  Techplatform config info
	 * 
	 * @package techplatform
	 *  */	 
	
		
	 if (isset($cfg['db_techplatform_params'])) 
	 {
	 	$tpInternal['cfg'] = $cfg['db_techplatform_params'];
	 } else
	 {
	 	$tpInternal['cfg'] = 
	 	array(
	 			'database_host' => 'localhost',
	 			'database_user' => 'uczniowi_uczniow',
	 			'database_pass' => 'twardehaslo',
	 			'database_dbase'=> 'uczniowi_uczniowisko'	
	 	  	);
	 }
?>
