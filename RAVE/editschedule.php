<!DOCTYPE html>
<html lang = "en">
	<head>
		<!-- 
			RAVE UI Mockup
			Filename: editschedule.php
			
			Authors: Group 8
				Nathan Chan, Jeffrey Holst, Cristian Johnson, Joseph Scott
			Date: 12/01/17
		-->
		<title>RAVE</title>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width">
		<link rel = "stylesheet" href = "styles.css">
		<link rel = "shortcut icon" href = "images/wranchico.ico">
		<!-- Latest compiled and minified CSS --> 
		<link rel = "stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
	</head>
	<body>
		<div class = "container">
			<div class = "row">
				<p class="skipnavigation"><a href="#contentstart">Skip navigation</a></p> 
				<header>
					<div class = "col-sm-3 hidden-xs">
						<a href="index.php"><img src="images/wranch.png" width="224" height="105" alt=""></a>
					</div>
					<div class = "col-sm-6 hidden-xs">
						<h1>RAVE</h1>
					</div>
					<div class = "col-sm-3 hidden-xs">
						<a href = "index.php"><img src = "images/track.png" width = "224" height = "105" alt = ""></a>
					</div>
				</header>
			</div>
			<div class = "row">
				<nav class="navbar navbar-inverse">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span> 
							</button>
							<a class="navbar-brand" href="login.php">LOGIN</a>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar">
							<ul class="nav navbar-nav">
								<li class = "allRights"><a href="index.php">Home</a></li>
								<li class = "allRights"><a href="fleetinfo.php">Fleet Information</a></li>
								<li class = "allRights"><a href = "maintenanceinfo.php">Maintenance Information</a></li>
								<li class = "allRights active"><a href="scheduleinfo.php">Schedule Information</a></li> 
								<li class = "genRights"><a href="analyzecosts.php">Analyze Costs</a></li>
								<li class = "adminRights"><a href="admintasks.php">Administrative Tasks</a></li>
								<li class = "allRights"><a href = "help.php">Help</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
			<div class = "row">
				<article class = "adminRights">
					<h2 id = "contentstart">Edit Schedule</h2>
					<p>These are the three main options for the Edit Schedule Use Case</p>
					<ul class = "nav nav-tabs">
						<li class = "active"><a data-toggle = "tab" href = "#add">Add a Appointment</a></li>
						<li><a data-toggle = "tab" href = "#edit">Edit an Existing Appointment</a></li>
						<li><a data-toggle = "tab" href = "#remove">Remove a Appointment</a></li>
					</ul>
					<div class = "tab-content">
						<div id = "add" class = "tab-pane fade in active">
							<p>Form for adding Appointment Information</p>
							<form autocomplete = "off" id = "addScheduleForm" onsubmit = "return false">
								<fieldset class = "databaseForms">
									<legend>Schedule Information</legend>
									<label for = "addScheduleDateInput">
										Date for Schedule
										<input type = "date" id = "addScheduleDateInput" name = "addScheduleDateInput">
									</label>
									<div class = "autocomplete">
										<label for = "addVehicleIDInput">
											Vehicle's ID
											<input type = "text" name = "addVehicleIDInput" id = "addVehicleIDInput" placeholder = "Vehicle ID">
										</label>
									</div>
									<label for = "addMechanicNameInput">
										Mechanic Assigned
										<select id = "addMechanicNameInput" name = "addMechanicNameInput">
											<!-- Will be populated by javascript -->
										</select>
									</label>
									<label for = "addScheduleTimeStartInput">
										Start Time
										<input type = "time" name = "addScheduleTimeStartInput" id = "addScheduleTimeStartInput">
									</label>
									<label for = "addScheduleTimeRequired">
										Time Required
										<input type = "number" name = "addScheduleTimeRequired" id = "addScheduleTimeRequired" step = 15 placeholder = "15 minute increments"> 
									</label>
									<label for = "addScheduleDescription">
										Description
										<input type = "text" name = "addScheduleDescription" id = "addScheduleDescription" placeholder = "REBUILD ENGINE">
									</label>
								</fieldset>
								<div class = "col-xs-6 formcol">
									<input type = "reset" class = "confirmButton placeRight" id = "reset" value = "Clear">
								</div>
								<div class = "col-xs-6 formcol">
									<input type = "submit" class = "confirmButton placeLeft" onclick = "insertAppointment()" value = "Confirm">
								</div>
							</form>
						</div>
						<div id = "edit" class = "tab-pane fade">
							<p>Form for editing Appointment Information</p>
							<form autocomplete = "off" id = "editScheduleForm" onsubmit = "return false">
								<fieldset class = "databaseForms">
									<legend>Select Vehicle ID and Date to Edit</legend>
									<div class = "autocomplete">
										<label for = "editVehicleIDInput">
											Vehicles ID
											<input type = "text" name = "editVehicleIDInput" id = "editVehicleIDInput" onblur = "selectAppointment('editVehicleIDInput', 'scheduleDateInput')" placeholder = "Vehicles ID">
										</label>
									</div>
									<label for = "scheduleDateInput">
										Date to Edit
										<!-- Will be populated by Javascript -->
										<select id = "scheduleDateInput" onchange = "selectAppointmentDropDown()"></select>
									</label>
								</fieldset>					
								<fieldset class = "databaseForms">
									<legend>Schedule Information</legend>
									<label for = "editScheduleDateInput">
										Date for Schedule
										<input type = "date" id = "editScheduleDateInput" name = "editScheduleDateInput">
									</label>
									<label for = "editMechanicNameInput">
										Mechanic Assigned
										<select id = "editMechanicNameInput" name = "editMechanicNameInput">
											<!-- Will be populated by javascript -->
										</select>
									</label>
									<label for = "editScheduleTimeStartInput">
										Start Time
										<input type = "time" name = "editScheduleTimeStartInput" id = "editScheduleTimeStartInput">
									</label>
									<label for = "editScheduleTimeRequired">
										Time Required
										<input type = "number" name = "editScheduleTimeRequired" id = "editScheduleTimeRequired" step = 15 placeholder = "15 minute increments"> 
									</label>
									<label for = "editScheduleDescription">
										Description
										<input type = "text" name = "editScheduleDescription" id = "editScheduleDescription" placeholder = "REBUILD ENGINE">
									</label>
								</fieldset>
								<div class = "col-xs-6 formcol">
									<input type = "reset" class = "confirmButton placeRight" id = "reset" value = "Clear">
								</div>
								<div class = "col-xs-6 formcol">
									<input type = "submit" class = "confirmButton placeLeft" onclick = "updateAppointment()" value = "Confirm">
								</div>
							</form>
						</div>
						<div id = "remove" class = "tab-pane fade">
							<p>Form for removing an Appointment</p>
							<form autocomplete = "off" id = "removeScheduleForm" onsubmit = "return false">	
								<fieldset class = "databaseForms">
									<legend>Select Vehicle ID and Date to Remove</legend>
									<div class = "autocomplete">
										<label for = "removeVehicleIDInput">
											Vehicles ID
											<input type = "text" name = "removeVehicleIDInput" id = "removeVehicleIDInput" onblur = "selectAppointment('removeVehicleIDInput', 'removeScheduleDateInput')" placeholder = "Vehicles ID">
										</label>
									</div>
									<label for = "removeScheduleDateInput">
										Date for Schedule
										<select id = "removeScheduleDateInput"></select>
									</label>
								</fieldset>
								<input type = "submit" class = "confirmButton placeCenter" onclick = "removeAppointment()" value = "Confirm">
							</form>
						</div>
					</div>	
				</article>
			</div>
			<div class = "row">
				<footer>
				</footer>
			</div>
		</div>
		<!-- jQuery library --> 
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
		<!-- Latest compiled JavaScript --> 
		<script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<!-- Main Javascript file for the site -->
		<script src = "js/main.js"></script>
		<script>
			setUserRights('editschedule');
		</script> 			
	</body>
</html>