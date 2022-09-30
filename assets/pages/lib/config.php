<?php
$hostname= "localhost";
$database = "toko";
$username = "root";
$password = "";
$config = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database);
//home URL
$url = "http://localhost/toko/admin_toko/";

//path Upload Gambar
$path="images/";
?>