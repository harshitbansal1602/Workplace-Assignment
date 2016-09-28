<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!--Import Google Icon Font-->
	<!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="sources/materialize/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title></title>
	<link rel="shortcut icon" href="images/">
	
	<!--CSS for this file-->
	<link rel="stylesheet" href="css/">
	<style>
	</style>
</head>
<body>
	<header>
		<div class="row">
			<div class="col s6">Welcome</div>
			<div class="col s2">All Tasks</div>
			<div class="col s2">
				<a class="modal-trigger" href="#modal1">Create Task</a>
			</div>
			<div class="col s2">
				<a href="logout.php">Logout</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container" >
			<ul class="collapsible" id="task_list" data-collapsible="accordion">
				<li>
					<div class="collapsible-header">
						<div class="row">
							<div class="col s7"><b>Task</b></div>
							<div class="col s3"><b>Sub-Head(s) working on it</b></div>
							<div class="col s2"><b>Status</b></div>
						</div>
					</div>
				</li>
				<!--prepend tasks here-->	
				<li>
					<div class="collapsible-header">
						<div class="row">
							<div class="col s7">Make a workspace</div>
							<div class="col s3">Name of subhead(s)</div>
							<div class="col s2">uncompleted</div>
						</div>
					</div>
					<div class="collapsible-body">
						<div class="row">
							<div class="col s12">Discription of the uncompleted task</div>
						</div>
					</div>
				</li>
				
				<li>
					<div class="collapsible-header">
						<div class="row">
							<div class="col s7">Make a workspace</div>
							<div class="col s3">Name of subhead(s)</div>
							<div class="col s2">uncompleted</div>
						</div>
					</div>
					<div class="collapsible-body">
						<div class="row">
							<div class="col s12">Discription of the uncompleted task</div>
						</div>
					</div>
				</li>

			</ul>
		</div>
	</main>
	<footer style="text-align: center;">
		Harshit Bansal &bull; Pradhumn Goyal
	</footer>
	
	
	<!-- Modal1 Structure -->
	<div id="modal1" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Create/Edit Task Here.</h4>
			<hr>
			<form>
				<label for="task">Enter Task Summary</label>
				<textarea name="task" id="task_sum" cols="10" rows="5" maxlength="50" required></textarea>
				<br>
				<label for="task_des">Enter Task Description</label>
				<textarea name="task_des" id="task_des" cols="20" rows="25" maxlength="500"></textarea>
				<br>
				<p>
					<input type="checkbox" id="test5" value="Red" />
					<label for="test5">Red</label>
				</p>
			</form>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action btn-flat" id="task_create">Create</a>
			<a href="#!" class="modal-action modal-close btn-flat">Cancel</a>
		</div>
	</div>

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="sources/jquery-3.0.0.min.js"></script>
	<script type="text/javascript" src="sources/materialize/js/materialize.min.js"></script>
	<!--Jquery for this file-->
	<script>
		var userid = <?php echo $_SESSION['userid']; ?> ;
	</script>
	<script type="text/javascript" src="jquery/home_head.js"></script>
</body>
</html>