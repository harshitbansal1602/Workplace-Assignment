<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="sources/materialize/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title></title>
	<link rel="shortcut icon" href="images/">
	
	<!--CSS for this file-->
	<link rel="stylesheet" href="css/">
	
</head>
<body>
	<header>
		<div class="row">
			<div class="col s6">Welcome</div>
			<div class="col s2">All Tasks</div>
			<div class="col s2">
				<a class="modal-trigger" href="#modal1">Create Task</a>
			</div>
			<div class="col s2">Logout</div>
		</div>
	</header>
	<main>
		<div class="container" >
			<ul class="collapsible" id="uncom_task" data-collapsible="accordion">
				<li>
					<div class="collapsible-header">
						<div class="row">
							<div class="col s9">Make a workspace</div>
							<div class="col s3">uncompleted</div>
						</div>
					</div>
					<div class="collapsible-body">
						<div class="row">
							<div class="col s12">Discription of the uncompleted task</div>
						</div>
					</div>
				</li>
			</ul>
			<hr>
			<ul class="collapsible" id="com_task" data-collapsible="accordion">
				
			</ul>
		</div>
	</main>
	<footer style="text-align: center;">
		Harshit Bansal &bull; Pradhumn Goyal
	</footer>
	
	
	<!-- Modal1 Structure -->
	<div id="modal1" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Modal Header</h4>
			<p>A bunch of text</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat ">Create</a>
			<a href="#!" class="modal-action modal-close btn-flat ">Cancel</a>
		</div>
	</div>

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="sources/jquery-3.0.0.min.js"></script>
	<script type="text/javascript" src="sources/materialize/js/materialize.min.js"></script>
	<!--Jquery for this file-->
	<script type="text/javascript" src="jquery/"></script>
	<script>
		$('.modal-trigger').leanModal();
	</script>
</body>
</html>