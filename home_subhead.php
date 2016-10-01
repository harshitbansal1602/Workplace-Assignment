<?php
require_once 'connect.php';

if(!$user->isLoggedIn()){
	header("Location: index.php");
}
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
	<link rel="stylesheet" href="css/home_subhead.css">

</head>
<body>
	<header>
		<div class="row">
			<div class="col s6">Welcome</div>
			<div class="col s2">
				<a id="my_task" href="#!">My Tasks</a>
			</div>
			<div class="col s2">
				<a id="all_task" href="#!">All Tasks</a>
			</div>
			<div class="col s2">
				<a href="logout.php">Logout</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container" >
			<ul class="collapsible" id="task_list_head" data-collapsible="accordion">
				<li>
					<div class="collapsible-header">
						<div class="row">
							<div class="col s3"><b>Task</b></div>
							<div class="col s2"><b>Task given by</b></div>
							<div class="col s3"><b>Sub-Head(s) working on it</b></div>
							<div class="col s2"><b>Last updated on</b></div>
							<div class="col s2"><b>Completed On</b></div>
						</div>
					</div>
				</li>
			</ul>
			<ul class="collapsible" id="task_list" data-collapsible="accordion">
				<!--insert tasks here-->
			</ul>
		</div>
	</main>
	<footer style="text-align: center;">
		Harshit Bansal &bull; Pradhumn Goyal
	</footer>

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="sources/jquery-3.0.0.min.js"></script>
	<script type="text/javascript" src="sources/materialize/js/materialize.min.js"></script>
	<!--Jquery for this file-->
	<script>
		var userid = <?php echo $_SESSION['userid']; ?> ;
	</script>
	<script type="text/javascript" src="jquery/home_subhead.js"></script>
</body>
</html>