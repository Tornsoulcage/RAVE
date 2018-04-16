<!DOCTYPE html>
<html lang="en">
<head>
<!-- 
			RAVE UI Mockup
			Filename: analyzecosts.php
			
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
							<li class="allRights"><a href="maintenanceinfo.php">Maintenance
									Information</a></li>
							<li class="allRights"><a href="scheduleinfo.php">Schedule
									Information</a></li>
							<li class="genRights active"><a href="analyzecosts.php">Analyze
									Costs</a></li>
							<li class="adminRights"><a href="admintasks.php">Administrative
									Tasks</a></li>
							<li class="allRights"><a href="help.php">Help</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="row">
			<article class="genRights">
				<h2 id="contentstart">Analyze Costs</h2>
				<p>These are the main two reports</p>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#vehicle">Vehicle
							Reports</a></li>
					<li><a data-toggle="tab" href="#department">Department Reports</a></li>
					<li><a data-toggle="tab" href="#maintenance">Maintenance Reports</a></li>
				</ul>
				<div class="tab-content">
					<div id="vehicle" class="tab-pane fade in active">
						<p>Vehicle Report</p>
						<form autocomplete="off" id="vehicleReportForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Select Vehicle's ID</legend>
								<div class="autocomplete">
									<label for="editVehicleIDInput"> Vehicles ID <input type="text"
										name="editVehicleIDInput" id="editVehicleIDInput"
										placeholder="Vehicles ID">
									</label>
								</div>
								<div class="col-xs-6 formcol placeLeft noPadding">
									<label for="startReportDate"> Start Date <input type="date"
										id="vehicleStartDate" name="startReportDate"
										class="startReportDate">
									</label>
								</div>
								<div class="col-xs-6 formcol placeRight noPadding">
									<label for="endReportDate"> End Date <input type="date"
										id="vehicleEndDate" name="endReportDate" class="endReportDate">
									</label>
								</div>
							</fieldset>
							<input type="submit" class="confirmButton placeCenter"
								onclick="selectPartialVehicle('vReport'), selectVehicleReport()"
								value="Confirm">
							<fieldset class="databaseForms">
								<legend>Vehicle Information</legend>
								<label for="editDepartmentNameInput"> Department's Name <input
									type="text" name="editDepartmentNameInput"
									id="editDepartmentNameInput" placeholder="Department's Name">
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
								</label> <label for="editMileageInput"> Mileage <input
									type="number" name="editMileageInput" id="editMileageInput"
									placeholder="Mileage" readonly>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Report Information</legend>
								<label for="vehicleTotalMileage"> Total Mileage <input
									type="text" name="vehicleTotalMileage" id="vehicleTotalMileage"
									placeholder="Total Mileage" readonly>
								</label> <label for="vehicleTotalGasCost"> Total Gas Cost <input
									type="text" name="vehicleTotalGasCost" id="vehicleTotalGasCost"
									placeholder="Total Gas Cost" readonly>
								</label> <label for="vehicleTotalMaintenanceCost"> Maintenance
									Cost <input type="text" name="vehicleTotalMaintenanceCost"
									id="vehicleTotalMaintenanceCost"
									placeholder="Total Maintenance Cost" readonly>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Maintenance Requests</legend>
								<table id="vehicleMainTable">
									<!-- Will be populated by a script -->
								</table>
							</fieldset>
						</form>
					</div>
					<div id="department" class="tab-pane fade">
						<p>Department Report</p>
						<form autocomplete="off" id="departmentReportForm"
							onsubmit="return false">
							<fieldset class="databaseForms">
								<legend>Select Department</legend>
								<label for="departmentNameInput"> Department's Name <!-- Will be populated by Javascript -->
									<select id="departmentNameInput"></select>
								</label>
								<div class="col-xs-6 formcol placeLeft noPadding">
									<label for="departmentStartDate"> Start Date <input type="date"
										id="departmentStartDate" name="departmentStartDate"
										class="startReportDate">
									</label>
								</div>
								<div class="col-xs-6 formcol placeRight noPadding">
									<label for="departmentEndDate"> End Date <input type="date"
										id="departmentEndDate" name="departmentEndDate"
										class="endReportDate">
									</label>
								</div>
							</fieldset>
							<input type="submit" class="confirmButton placeCenter"
								onclick="selectDepartmentReport()" value="Confirm">
							<fieldset class="databaseForms">
								<legend>Report Info</legend>
								<label for="departmentTotalGasCost"> Total Gas Cost <input
									type="text" name="departmentTotalGasCost"
									id="departmentTotalGasCost" placeholder="Total Gas Cost"
									readonly>
								</label> <label for="departmentTotalMileage"> Total Mileage <input
									type="text" name="departmentTotalMileage"
									id="departmentTotalMileage" placeholder="Total Mileage"
									readonly>
								</label> <label for="departmentAvgMileage"> Average Mileage <input
									type="text" name="departmentAvgMileage"
									id="departmentAvgMileage"
									placeholder="Average Mileage per Vehicle" readonly>
								</label> <label for="departmentTotalMaintenanceCost">
									Maintenance Cost <input type="text"
									name="departmentTotalMaintenanceCost"
									id="departmentTotalMaintenanceCost"
									placeholder="Total Maintenance Costs" readonly>
								</label> <label for="departmentTotalMaintenanceRequests">
									Requests <input type="text"
									name="departmentTotalMaintenanceRequests"
									id="departmentTotalMaintenanceRequests"
									placeholder="Total Maintenance Requests" readonly>
								</label> <label for="departmentTotalVehicles"> Vehicles <input
									type="text" name="departmentTotalVehicles"
									id="departmentTotalVehicles"
									placeholder="Total Number of Vehicles" readonly>
								</label>
							</fieldset>
						</form>
					</div>
					<div id="maintenance" class="tab-pane fade">
						<p>Maintenance Report</p>
						<form autocomplete="off" onsubmit="return false"
							id="maintenanceReportForm">
							<fieldset class="databaseForms">
								<legend>Select Vehicle Filter</legend>
								<label for="editRequiredLicenseInput"> License Class <select
									id="editRequiredLicenseInput" name="editRequiredLicenseInput">
										<option value="CLASS_A">Class A</option>
										<option value="CLASS_B">Class B</option>
										<option value="CLASS_C">Class C</option>
										<option value="CLASS_D">Class D</option>
										<option value="CLASS_ALL">All Classes</option>
								</select>
								</label>
								<div class="col-xs-6 formcol placeLeft noPadding">
									<label for="mainStartDate"> Start Date <input type="date"
										id="mainStartDate" name="mainStartDate"
										class="startReportDate">
									</label>
								</div>
								<div class="col-xs-6 formcol placeRight noPadding">
									<label for="mainEndDate"> End Date <input type="date"
										id="mainEndDate" name="mainEndDate" class="endReportDate">
									</label>
								</div>
							</fieldset>
							<input type="submit" class="confirmButton placeCenter"
								onclick="selectMaintenanceReport()" value="Confirm">
							<fieldset class="databaseForms">
								<legend>Report Info</legend>
								<label for="maintenanceLaborCost"> Labor Cost <input
									type="number" name="maintenanceLaborCost"
									id="maintenanceLaborCost" placeholder="Labor Cost" readonly>
								</label> <label for="maintenancePartsCost"> Parts Cost <input
									type="number" name="maintenancePartsCost"
									id="maintenancePartsCost" placeholder="Parts Cost" readonly>
								</label>
							</fieldset>
							<fieldset class="databaseForms">
								<legend>Maintenance Information</legend>
								<table id="maintenanceTable">
									<!-- Will be populated by a script -->
								</table>
							</fieldset>
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
	<!-- Primary JavaScript file for the system -->
	<script src="js/main.js"></script>
	<script>
			setUserRights('analyzecosts');
		</script>
</body>
</html>