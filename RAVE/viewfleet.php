<!DOCTYPE html>
<html lang="en">
<head>
<!-- 
			RAVE UI Mockup
			Filename: viewfleet.php
			
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
			<article class="genRights">
				<h2 id = "contentstart">View Fleet</h2>
				<p>These are the two main options for the View Fleet Use Case</p>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#ind">View one Vehicle</a></li>
					<li><a data-toggle="tab" href="#all">View all Vehicles</a></li>
				</ul>
				<div class = "tab-content">
					<div id="ind" class= "tab-pane fade in active">
						<p>Form for selecting and viewing Vehicle Information</p>
        				<form autocomplete="off" id="viewVehicleForm" onsubmit="return false">
        					<fieldset class="databaseForms">
        						<legend>Select Vehicle's ID</legend>
        						<div class="autocomplete">
        							<label for="editVehicleIDInput"> Vehicle's ID <input type="text"
        								name="editVehicleIDInput" id="editVehicleIDInput"
        								onblur="selectVehicle()" placeholder="Vehicle's ID">
        							</label>
        						</div>
        					</fieldset>
        					<fieldset class="databaseForms">
        						<legend>Vehicle's Information</legend>
        						<label for="editDepartmentNameInput"> Department's Name <!-- Will be populated by Javascript -->
									<select disabled id="editDepartmentNameInput"></select>
								</label> <label for="editMakeInput"> Make <input type="text"
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
        						</label> <label for="editMileageInput"> Mileage <input
        							type="number" name="editMileageInput" id="editMileageInput"
        							placeholder="Mileage" readonly>
        						</label> <label for="editEngineInput"> Engine <input type="text"
        							name="editEngineInput" id="editEngineInput" placeholder="Engine"
        							readonly>
        						</label> <label for="editTiresInput"> Tires <select
        							id="editTiresInput" name="editTiresInput" disabled>
        								<option value="11/32">11/32</option>
        								<option value="10/32">10/32</option>
        								<option value="9/32">9/32</option>
        								<option value="8/32">8/32</option>
        								<option value="7/32">7/32</option>
        								<option value="6/32">6/32</option>
        								<option value="5/32">5/32</option>
        								<option value="4/32">4/32</option>
        								<option value="3/32">3/32</option>
        								<option value="2/32">2/32</option>
        						</select>
        						</label> <label for="editConditionInput"> Condition <select
        							id="editConditionInput" name="editConditionInput" disabled>
        								<option value="POOR">Poor</option>
        								<option value="GOOD">Good</option>
        								<option value="VERY GOOD">Very Good</option>
        								<option value="EXCELLENT">Excellent</option>
        						</select>
        						</label> <label for="editRequiredLicenseInput"> Required License <select
        							id="editRequiredLicenseInput" name="editRequiredLicenseInput"
        							disabled>
        								<option value="CLASS_A">Class A</option>
        								<option value="CLASS_B">Class B</option>
        								<option value="CLASS_C">Class C</option>
        								<option value="CLASS_D">Class D</option>
        						</select>
        						</label>
        					</fieldset>
        					<input type="reset" class="confirmButton placeCenter" value="Clear">
        				</form>
					</div>
					<div id = "all" class = "tab-pane fade">
						<p>Form for selecting and viewing Fleet Information</p>
						<form autocomplete = "off" onsubmit = "return false" id = "viewFleetForm">
							<fieldset class = "databaseForms">
								<legend>Select Department</legend>
								<label for = "fleetDepartmentNameInput">
									Department Name
									<select id = "fleetDepartmentNameInput" onchange = "selectFleet()">
										<!-- Will be populated by Javascript -->
									</select>
								</label>
							</fieldset>
							<fieldset class = "databaseForms">
							<legend>Fleet Information</legend>
								<table id = "fleetInfoTable">
									<!-- Will be populated by Javascript -->
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
			setUserRights('viewfleet');
		</script>
</body>
</html>