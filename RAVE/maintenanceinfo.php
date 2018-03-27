<!DOCTYPE html>
<html lang="en">
<head>
<!-- 
			RAVE UI Mockup
			Filename: maintenanceinfo.php
			
			Authors: Group 8
				Nathan Chan, Jeffrey Holst, Cristian Johnson, Joseph Scott
			Date: 12/01/17
		-->
<title>RAVE</title>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width">
<link rel="stylesheet" href="styles.css">
<link rel="shortcut icon" href="images/wranchico.ico">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<p class="skipnavigation">
				<a href="#contentstart">Skip navigation</a>
			</p>
			<header>
				<div class="col-sm-3 hidden-xs">
					<a href="index.php"><img src="images/wranch.png" width="224"
						height="105" alt=""></a>
				</div>
				<div class="col-sm-6 hidden-xs">
					<h1>RAVE</h1>
				</div>
				<div class="col-sm-3 hidden-xs">
					<a href="index.php"><img src="images/track.png" width="224"
						height="105" alt=""></a>
				</div>
			</header>
		</div>
		<div class="row">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="#myNavbar">
							<span class="icon-bar"></span> <span class="icon-bar"></span> <span
								class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="login.php">LOGIN</a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li class="allRights"><a href="index.php">Home</a></li>
							<li class="allRights"><a href="fleetinfo.php">Fleet Information</a></li>
							<li class="allRights active"><a href="maintenanceinfo.php">Maintenance
									Information</a></li>
							<li class="allRights"><a href="scheduleinfo.php">Schedule
									Information</a></li>
							<li class="genRights"><a href="analyzecosts.php">Analyze Costs</a></li>
							<li class="adminRights"><a href="admintasks.php">Administrative
									Tasks</a></li>
							<li class="allRights"><a href="help.php">Help</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="row">
			<article>
				<p>Maintenance Information</p>
				<p class="mecRights">
					<a href="editmaintenance.php">Edit Maintenance</a>
				</p>
				<p class="genRights">
					<a href="viewmaintenance.php">View Maintenance</a>
				</p>
			</article>
		</div>
		<div class="row">
			<footer> </footer>
		</div>
	</div>
	<!-- jQuery library -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script
		src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- Primary JavaScript file for the system -->
	<script src="js/main.js"></script>
	<script>setUserRights('maintenanceinfo');</script>
</body>
</html>