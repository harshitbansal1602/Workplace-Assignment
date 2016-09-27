<?php
require_once 'vars.inc.php';
if($user->isLoggedIn()){
	if($user->getRole() == 1){
		header('Location: head.php');
	}
	elseif($user->getRole() == 0){
		header('Location: subhead.php');
	}
}

if(isset($_POST['userid']) && !empty($_POST['userid'])){
	if($user->getRole() == 1){
		header('Location: head.php');
	}
	elseif($user->getRole() == 0){
		header('Location: subhead.php');
	}
}
?>