<?php
require_once 'connect.php';

$t_id = $_POST['t_id'];

if($user->isLoggedIn()){
	$user->completed($t_id);
}

?>