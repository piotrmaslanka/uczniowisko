<?php
// will be used to patch raw templates into full-fledged page
	function _show_template($tpl)
	{
		header('Content-Type: text/html; charset=utf-8');	// ain't debug
		show_template($tpl);
		
		global $cfg;
		if (@$cfg['debug'])
		{
			echo('<hr><h3 style="text-align: center;">$_SESSION</h3>');
			var_dump($_SESSION);
			echo('<br><h3 style="text-align: center;">$_POST</h3>');
			var_dump($_POST);
		}
	}
?>
