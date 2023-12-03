<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$baotri = false;

$config_db = array(
	'db_host' => 'localhost',
	'db_user' => 'xlikesub_test',
	'db_name' => 'xlikesub_test',
	'db_pass' => 'nendaica123'
);
$conn = mysqli_connect($config_db['db_host'], $config_db['db_user'], $config_db['db_pass'], $config_db['db_name']);
mysqli_set_charset($conn,"utf8");
//var_dump($conn);

// $getsetting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `Guest` WHERE `guest_id`='GT001'")); 
// $hi = $getsetting['guest_id'];

?>