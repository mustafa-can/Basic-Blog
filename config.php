<?php
$db =  @new mysqli('localhost', 'root', '', 'xblog');
    if ($db->connect_error) die('Connection Failed');
    $db->set_charset('utf8');
?>
