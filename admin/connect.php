<?php
//connect to database
$dbLink=mysql_connect('localhost','root','pass') or die('Could not connect');
mysql_select_db('database',$dbLink) or die('db selection failed');

?>