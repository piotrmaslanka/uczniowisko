<?php
    $cfg['db_host'] = 'localhost';
    $cfg['db_user']='visionit';
    $cfg['db_pass']='14041986';
    $cfg['db_db'] = 'visionit_u';
    $cfg['db_techplatform_params'] = 
    array('database_host' => 'localhost',
          'database_user' => 'visionit',
          'database_pass' => '14041986',
          'database_dbase'=> 'visionit_u');
    
    $cfg['db_forum'] = 'visionit_u';
    
    $cfg['max_upload_size'] = 20;	// in MBs
    $cfg['works_per_page'] = 6;	// used in lists
    $cfg['comments_latest'] = 10; 	// amoount of max latest comments to display on comment.latest
	$cfg['activation_time'] = 24*60*60;	// amount of second a activated download is valid for    

    $cfg['smtp_host'] = 'mail.uczniowisko.pl';
    $cfg['smtp_port'] = 465;
    $cfg['smtp_auth'] = true;		// true/false whether to use username/password to login
    	$cfg['smtp_user'] = 'visionit';
    	$cfg['smtp_pass'] = 'twardehaslo';
    $cfg['email'] = 'uczniowisko@uczniowisko.pl';
    $cfg['smtp_friendly'] = 'Uczniowisko.pl';
    $cfg['smtp_ssl'] = '';			// security method
    
    $cfg['cash_for_work'][1] = 10;		// how much cash submitter receives for each sold copy
    $cfg['cash_for_work'][2] = 4;
    $cfg['cash_for_work'][3] = 8;
    $cfg['cash_for_work'][4] = 0;
    $cfg['work_prices'][1] = 35;	// how much Overmode 1 costs each
    $cfg['work_prices'][2] = 10;	// how much Overmode 2 costs each
    $cfg['work_prices'][3] = 20;	// how much Overmode 3 costs each
    $cfg['work_prices'][4] = 0;
    
    $cfg['viewpost_url'] = 'http://uczniowisko.pl/forum/viewtopic.php?p={postid}#{postid}';
    
    //$cfg['debug'] = true;// comment out this line to enable production mode
?>
