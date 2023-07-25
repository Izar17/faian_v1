<?php 

session_start();

require_once 'db_connect.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location:'.$store_url);	
} 
date_default_timezone_set('Asia/Bangkok');
$curDate = date("m/d/Y"); 



?>