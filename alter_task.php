<?php
require_once 'connect.php';
echo 'klj';
if( isset($_POST['task_id']) && isset($_POST['action']) && !empty($_POST['task_id']) && !empty($_POST['action']) ){
	$t_id = $_POST['task_id'];
	$action = $_POST['action'];
	if($action == 'delete'){
		$result = $user->alterTask($t_id,$action);
		echo 'there';
		//echo $result;
	}elseif ($action == 'update' || $action == 'create') {
		if( isset($_POST['userid']) && isset($_POST['userid']) &&
			isset($_POST['task_sum']) && isset($_POST['task_sum']) &&
			isset($_POST['task_des']) && isset($_POST['task_des']) &&
			isset($_POST['subhead']) && isset($_POST['subhead'])  ){

			$subhead = $_POST['subhead'];
			$sum = $_POST['task_sum'];
			$des = $_POST['task_des'];

			$result = $user->alterTask($t_id,$action,$subhead,$sum,$des);
			//echo $result;
			echo "here";
			
		}else{
			echo "FAILED3";
		}
	}
}
?>