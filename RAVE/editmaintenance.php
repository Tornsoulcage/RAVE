<!DOCTYPE html>
<html lang="en">
<head>
<!-- 
			RAVE UI Mockup
			Filename: editmaintenance.php
			
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
			<article class="mecRights">
				<h2 id="contentstart">Edit Maintenance</h2>
				<p>These are the three main options for the Edit Maintenance Use
					Case</p>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#add">Add a
							Maintenance Appointment</a></li>
					<li><a data-toggle="tab" href="#edit">Edit an Existing Maintenance
							Appointment</a></li>
					<li><a data-toggle="tab" href="#remove">Remove an Appointment</a></li>
				</ul>
				<div class="tab-content">
					<div id="add" class="tab-pane fade in active">
						<p>Form for adding Maintenance Information to a Vehicle</p>
						<form autocomplete="off" id="addMaintenanceForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Select Vehicle's ID</legend>
								<div class="autocomplete">
									<label for="addVehicleIDInput"> Vehicles ID <input type="text"
										name="addVehicleIDInput" id="addVehicleIDInput"
										onblur="selectPartialVehicle('add')" placeholder="Vehicles ID">
									</label>
								</div>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Vehicle Information</legend>
								<label for="addDepartmentNameInput"> Department's Name <input
									type="text" name="addDepartmentNameInput"
									id="addDepartmentNameInput" placeholder="Department's Name"
									readonly>
								</label> <label for="addMakeInput"> Make <input type="text"
									name="addMakeInput" id="addMakeInput" placeholder="Make"
									readonly>
								</label> <label for="addModelInput"> Model <input type="text"
									name="addModelInput" id="addModelInput" placeholder="Model"
									readonly>
								</label> <label for="addYearInput"> Year <input type="number"
									name="addYearInput" id="addYearInput" placeholder="Year"
									readonly>
								</label> <label for="addVINInput"> Vehicles VIN <input
									type="text" name="addVINInput" id="addVINInput"
									placeholder="Vehicles VIN" readonly>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Maintenance Information</legend>
								<div class="autocomplete">
									<label> Labor Codes <input type="text"
										class="addLaborCodeInputs"
										onblur="addLaborInputField('add'), autocompleteLaborCodes('add')"
										placeholder="01103">
									</label>
									<div id="addLaborCodeInputs">
										<!-- Populated by Javascript -->
									</div>
								</div>
								<label for="addMaintenanceDateInput"> Date Done <input
									type="date" name="addMaintenanceDateInput"
									id="addMaintenanceDateInput" placeholder="Date">
								</label> <label for="addMaintenanceMechanicInput"> Mechanic <select
									id="addMaintenanceMechanicInput"
									name="addMaintenanceMechanicInput">
										<!-- Will be populated by javascript -->
								</select>
								</label> <label for="addMaintenanceMileageInput"> Mileage <input
									type="number" id="addMaintenanceMileageInput"
									name="addMaintenanceMileageInput" placeholder="Current Mileage">
								</label> <label for="addMaintenanceWorkTypeInput"> Work Type <select
									id="addMaintenanceWorkTypeInput"
									name="addMaintenanceWorkTypeInput">
										<option value="SPECIAL">SPECIAL</option>
										<option value="SCHEDULED">SCHEDULED</option>
								</select>
								</label> <label for="addMaintenanceSpecialWorkInput"> Special
									Work <input type="text" name="addMaintenanceSpecialWorkInput"
									id="addMaintenanceSpecialWorkInput"
									placeholder="Worked Performed">
								</label> <label for="addMaintenancePartsCostInput"> Cost of
									Parts <input type="number" step=".01"
									name="addMaintenancePartsCostInput"
									id="addMaintenancePartsCostInput" placeholder="Cost of Parts">
								</label> <label for="addMaintenanceLaborCostInput"> Labor Cost <input
									type="number" step=".01" name="addMaintenanceLaborCostInput"
									id="addMaintenanceLaborCostInput" placeholder="Cost of Labor">
								</label>
							</fieldset>
							<div class="col-xs-6 formcol">
								<input type="reset" class="confirmButton placeRight" id="reset"
									value="Clear">
							</div>
							<div class="col-xs-6 formcol">
								<input type="submit" class="confirmButton placeLeft"
									onclick="insertMaintenance()" value="Confirm">
							</div>
						</form>
					</div>
					<div id="edit" class="tab-pane fade">
						<p>Form for editing Maintenance Information to a Vehicle</p>
						<form autocomplete="off" id="editMaintenanceForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Select Vehicle ID and Date to Edit</legend>
								<div class="autocomplete">
									<label for="editVehicleIDInput"> Vehicles ID <input type="text"
										id="editVehicleIDInput" name="editVehicleIDInput"
										onblur="selectPartialVehicle('edit'), selectMaintenance('editDateInput', 'editVehicleIDInput')"
										placeholder="Vehicles ID">
									</label>
								</div>
								<label for="editDateInput"> Date Performed <!-- Will be filled by javascript -->
									<select id="editDateInput" onblur="selectMaintenanceDropDown()"></select>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Vehicle Information</legend>
								<label for="editDepartmentNameInput"> Department's Name <input
									type="text" name="editDepartmentNameInput"
									id="editDepartmentNameInput" placeholder="Department's Name"
									readonly>
								</label> <label for="editMakeInput"> Make <input type="text"
									name="editMakeInput" id="editMakeInput" placeholder="Make"
									readonly>
								</label> <label for="editModelInput"> Model <input type="text"
									name="editModelInput" id="editModelInput" placeholder="Model"
									readonly>
								</label> <label for="editYearInput"> Year <input type="number"
									name="editYearInput" id="editYearInput" placeholder="Year"
									readonly>
								</label> <label for="editVINInput"> Vehicles VIN <input
									type="text" name="editVINInput" id="editVINInput"
									placeholder="Vehicles VIN" readonly>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Maintenance Information</legend>
								<div class="autocomplete">
									<label> Labor Codes <input type="text"
										class="editLaborCodeInputs" placeholder="01103">
									</label>
									<!-- Will be filled by Javascript -->
									<div id="editLaborCodeInputs"></div>
								</div>
								<label for="editMaintenanceDateInput"> Date Done <input
									type="date" name="editMaintenanceDateInput"
									id="editMaintenanceDateInput" placeholder="Date">
								</label> <label for="editMaintenanceMechanicInput"> Mechanic
									Assigned <select id="editMaintenanceMechanicInput"
									name="editMaintenanceMechanicInput">
										<!-- Will be populated by javascript -->
								</select>
								</label> <label for="editMaintenanceMileageInput"> Mileage <input
									type="number" id="editMaintenanceMileageInput"
									name="editMaintenanceMileageInput"
									placeholder="Current Mileage">
								</label> <label for="editMaintenanceWorkTypeInput"> Work Type <select
									id="editMaintenanceWorkTypeInput"
									name="editMaintenanceWorkTypeInput">
										<option value="SPECIAL">SPECIAL</option>
										<option value="SCHEDULED">SCHEDULED</option>
								</select>
								</label> <label for="editMaintenanceSpecialWorkInput"> Comments
									<input type="text" name="editMaintenanceSpecialWorkInput"
									id="editMaintenanceSpecialWorkInput"
									placeholder="Worked Performed">
								</label> <label for="editMaintenancePartsCostInput"> Cost of
									Parts <input type="number" name="editMaintenancePartsCostInput"
									id="editMaintenancePartsCostInput" placeholder="Cost of Parts">
								</label> <label for="editMaintenanceLaborCostInput"> Labor Cost
									<input type="number" name="editMaintenanceLaborCostInput"
									id="editMaintenanceLaborCostInput" placeholder="Cost of Labor">
								</label>
							</fieldset>
							<div class="col-xs-6 formcol">
								<input type="reset" class="confirmButton placeRight" id="reset"
									value="Clear">
							</div>
							<div class="col-xs-6 formcol">
								<input type="submit" class="confirmButton placeLeft"
									onclick="updateMaintenance()" value="Confirm">
							</div>
						</form>
					</div>
					<div id="remove" class="tab-pane fade">
						<p>Form for removing a Maintenance Appointment from a Vehicle</p>
						<form autocomplete="off" id="removeMaintenanceForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Select Vehicle ID and Date to Remove</legend>
								<div class="autocomplete">
									<label for="removeVehicleIDInput"> Vehicles ID <input
										type="text" name="removeVehicleIDInput"
										id="removeVehicleIDInput"
										onblur="selectMaintenance('removeDateInput', 'removeVehicleIDInput')"
										placeholder="Vehicles ID">
									</label>
								</div>
								<label for="removeDateInput"> Date Performed <select
									id="removeDateInput"></select>
								</label>
							</fieldset>
							<input type="submit" class="confirmButton placeCenter"
								onclick="removeMaintenance()" value="Confirm">
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
	<!-- Primary Javascript file for the site -->
	<script src="js/main.js"></script>
	<script>
			setUserRights('editmaintenance');
		</script>
</body>
</html>