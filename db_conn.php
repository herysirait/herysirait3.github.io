<?php
// KONEKSI DATABASE
error_reporting(E_ALL^E_DEPRECATED);
$conn = mysql_connect($db_host,$db_user,$db_pass) or die("can not access database");
mysql_select_db($db_name,$conn) or die("can not connect");
?>