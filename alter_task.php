<?php
session_start();
if( isset($_POST['t_id']) && isset($_POST['action']) && !empty($_POST['t_id']) && !empty($_POST['action']) ){
	$t_id = $_POST['t_id'];
	$action = $_POST['action'];
	if($action === 'delete'){
		$result = $user->ALTER_TASK($t_id,$action);
		echo $result;
	}elseif ($action === 'update' || $action === 'create') {
		if( isset($_POST['userid']) && isset($_POST['userid']) &&
			isset($_POST['task_sum']) && isset($_POST['task_sum']) &&
			isset($_POST['task_des']) && isset($_POST['task_des']) &&
			isset($_POST['subhead']) && isset($_POST['subhead'])  ){

			$userid = $_POST['userid'];
			$task_sum = $_POST['task_sum'];
			$task_des = $_POST['task_des'];
			$subhead = $_POST['subhead'];

			$result = $user->ALTER_TASK($t_id,$action);
			echo $result;
			
		}else{
			echo "FAILED";
		}
	}
}
?>