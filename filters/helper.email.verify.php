<?php
	/**
	 * @param string $data email
	 * @param bool $fdata whether it is valid
	 */
    function ftrhelper_email_verify(&$parent, $data, &$fdata)
    {        
        if (preg_match('/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-.]+\.[a-zA-Z]+/U', $data)==0)
			$fdata = false;
		else
			$fdata = true;
        
    }

FilterManager::addHook('helper.email.verify', 'ftrhelper_email_verify');
?>