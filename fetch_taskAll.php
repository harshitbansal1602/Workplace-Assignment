<?php
require_once 'connect.php';



if($user->isLoggedIn()){
	$user->fetchAllTask();
}
?>