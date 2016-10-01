<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name  = "workspace";

try{
	$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	//error in connection
}

require_once 'class_user.php';

$user = new user($db_con);



?>