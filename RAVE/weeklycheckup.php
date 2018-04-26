<!DOCTYPE html>
<html lang="en">
<head>
<!--
			RAVE UI Mockup
			Filename: weeklycheckup.php
			
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
		<div class="row" id="nav">
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
							<li class="allRights active"><a href="fleetinfo.php">Fleet
									Information</a></li>
							<li class="allRights"><a href="maintenanceinfo.php">Maintenance
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
			<article class="adminRights">
				<h2 id="contentstart">Weekly Check-Ins</h2>
				<p>These are the three main options for the Weekly Check-In Use Case</p>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#add">Add a Check-In</a></li>
					<li><a data-toggle="tab" href="#edit">Edit a Existing Check-In</a></li>
					<li><a data-toggle="tab" href="#remove">Remove a Check-In</a></li>
				</ul>
				<div class="tab-content">
					<div id="add" class="tab-pane fade in active">
						<form autocomplete="off" id="addCheckupForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Weekly Check-In</legend>
								<div class="autocomplete">
									<label for="addVehicleIDInput"> Vehicle's ID <input type="text"
										name="addVehicleIDInput" id="addVehicleIDInput"
										onblur="selectPartialVehicle('add')" placeholder="Vehicle's ID">
									</label>
								</div>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Vehicle's Information</legend>
								<label for="addDepartmentNameInput"> Department's Name <!-- Will be populated by Javascript -->
									<select disabled id="addDepartmentNameInput"></select>
								</label>
								<label for="addMakeInput"> Make <input type="text"
									name="addMakeInput" id="addMakeInput" placeholder="Make"
									readonly>
								</label> <label for="addModelInput"> Model <input type="text"
									name="addModelInput" id="addModelInput" placeholder="Model"
									readonly>
								</label> <label for="addYearInput"> Year <input type="number"
									name="addYearInput" id="addYearInput" placeholder="Year"
									readonly>
								</label> <label for="addVINInput"> Vehicle's VIN <input
									type="text" name="addVINInput" id="addVINInput"
									placeholder="Vehicle's VIN" readonly>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Weekly Check-In</legend>
								<label for="addCurrentMileageInput"> Mileage <input
									type="number" name="addCurrentMileageInput"
									id="addCurrentMileageInput" placeholder="Current Mileage">
								</label> <label for="addCurrentGasPriceInput"> Gas Price <input
									type="number" step="any" name="addCurrentGasPriceInput"
									id="addCurrentGasPriceInput" placeholder="Current Gas Price">
								</label> <label for="addCurrentCommentsInput"> Comments <input
									type="text" name="addCurrentCommentsInput"
									id="addCurrentCommentsInput"
									placeholder="Any Comments or Concerns">
								</label>
							</fieldset>
							<div class="col-xs-6 formcol">
								<input type="reset" class="confirmButton placeRight"
									value="Clear">
							</div>
							<div class="col-xs-6 formcol">
								<input type="submit" class="confirmButton placeLeft"
									onclick="insertCheckup()" value="Confirm">
							</div>
						</form>
					</div>
					<div id="edit" class="tab-pane fade">
						<form autocomplete="off" id="editCheckupForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Select Vehicle's ID and Check-In to Edit</legend>
								<div class="autocomplete">
									<label for="editVehicleIDInput"> Vehicle's ID <input
										type="text" name="editVehicleIDInput" id="editVehicleIDInput"
										onblur="selectPartialVehicle('edit'), selectCheckup('editCheckupInput', 'editVehicleIDInput')"
										placeholder="Vehicle's ID">
									</label>
								</div>
								<label for="editCheckupInput"> Select Check-In <select
									id="editCheckupInput" onblur="selectCheckupDropDown()">
										<!-- Will be filled by javascript -->
								</select>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Vehicle Information</legend>
								<label for="editDepartmentNameInput"> Department's Name <!-- Will be populated by Javascript -->
									<select disabled id="editDepartmentNameInput"></select>
								</label>
								<label for="editMakeInput"> Make <input type="text"
									name="editMakeInput" id="editMakeInput" placeholder="Make"
									readonly>
								</label> <label for="editModelInput"> Model <input type="text"
									name="editModelInput" id="editModelInput" placeholder="Model"
									readonly>
								</label> <label for="editYearInput"> Year <input type="number"
									name="editYearInput" id="editYearInput" placeholder="Year"
									readonly>
								</label> <label for="editVINInput"> Vehicle's VIN <input
									type="text" name="editVINInput" id="editVINInput"
									placeholder="Vehicle's VIN" readonly>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Weekly Check-In</legend>
								<label for="editCurrentMileageInput"> Mileage <input
									type="number" name="editCurrentMileageInput"
									id="editCurrentMileageInput" placeholder="Current Mileage">
								</label> <label for="editCurrentGasPriceInput"> Gas Price <input
									type="number" step="any" name="editCurrentGasPriceInput"
									id="editCurrentGasPriceInput" placeholder="Current Gas Price">
								</label> <label for="editCurrentCommentsInput"> Comments <input
									type="text" name="editCurrentCommentsInput"
									id="editCurrentCommentsInput"
									placeholder="Any Comments or Concerns">
								</label>
							</fieldset>
							<div class="col-xs-6 formcol">
								<input type="reset" class="confirmButton placeRight"
									value="Clear">
							</div>
							<div class="col-xs-6 formcol">
								<input type="submit" class="confirmButton placeLeft"
									onclick="updateCheckup()" value="Confirm">
							</div>
						</form>
					</div>
					<div id="remove" class="tab-pane fade">
						<form autocomplete="off" id="removeCheckupForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Select Vehicle's ID</legend>
								<div class="autocomplete">
									<label for="removeVehicleIDInput"> Vehicle's ID <input
										type="text" name="removeVehicleIDInput"
										id="removeVehicleIDInput"
										onblur="selectCheckup('removeCheckupInput', 'removeVehicleIDInput')"
										placeholder="Vehicle's ID">
									</label>
								</div>
								<label for="removeCheckupInput"> Select Check-In <select
									id="removeCheckupInput">
										<!-- Will be filled by javascript -->
								</select>
								</label>
							</fieldset>
							<input type="submit" class="confirmButton placeCenter"
								onclick="removeCheckup()" value="Confirm">
						</form>
					</div>
				</div>
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
	<!-- Main javascript file -->
	<script src="js/main.js"></script>
	<script>
			setUserRights('weeklycheckup');
		</script>
</body>
</html>