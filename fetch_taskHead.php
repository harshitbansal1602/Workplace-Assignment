<?php
require_once 'connect.php';
if($user->isLoggedIn()){
	$userid = $_POST['userid'];
	$user->fetchHeadTask($userid);
}
?>