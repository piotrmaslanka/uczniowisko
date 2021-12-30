<?php
    function ftradmin_email_get(&$parent, $data, &$fdata)
    {
        global $db;
        /*$res = $db->query('SELECT token FROM tpusers WHERE type=1');
        $row = $db->toArray($res);
        $fdata = $row['token'];*/
        $fdata = 'uczniowisko@uczniowisko.pl';
    }

FilterManager::addHook('admin.email.get', 'ftradmin_email_get');
?>