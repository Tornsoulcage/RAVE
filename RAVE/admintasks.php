<!DOCTYPE html>
<html lang="en">
<head>
<!-- 
			RAVE UI Mockup
			Filename: admintasks.php
			
			Authors: Group 8
				Nathan Chan, Jeffrey Holst, Cristian Johnson, Joseph Scott
			Date: 02/03/2018
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
							<li class="genRights"><a href="analyzecosts.php">Analyze Costs</a></li>
							<li class="adminRights active"><a href="admintasks.php">Administrative
									Tasks</a></li>
							<li class="allRights"><a href="help.php">Help</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="row">
			<article class="adminRights">
				<h2 id="contentstart">Administrative Tasks</h2>
				<p>These are various options for the clerk to perform administrative
					tasks</p>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#user">User Tasks</a></li>
					<li><a data-toggle="tab" href="#department">Department Tasks</a></li>
					<li><a data-toggle="tab" href="#mechanic">Mechanic Tasks</a></li>
				</ul>
				<div class="tab-content">
					<div id="user" class="tab-pane fade in active">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#addUser">Add an
									User</a></li>
							<li><a data-toggle="tab" href="#editUser">Edit an Existing User</a></li>
							<li><a data-toggle="tab" href="#removeUser">Remove an User</a></li>
						</ul>
						<div class="tab-content">
							<div id="addUser" class="tab-pane fade in active">
								<p>Form for adding a new user to access the site</p>
								<form autocomplete="off" id="addUserForm"
									onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>User Information</legend>
										<label for="addUsernameInput"> Username <input type="text"
											name="addUsernameInput" id="addUsernameInput"
											placeholder="Username">
										</label> <label for="addPasswordInput"> Password <input
											type="password" name="addPasswordInput" id="addPasswordInput"
											placeholder="Password">
										</label> <label for="addAdminRightsInput"> Admin Rights <select
											id="addAdminRightsInput">
												<option value="ADMIN">ADMIN</option>
												<option value="MECHANIC">MECHANIC</option>
												<option value="GENERAL">GENERAL</option>
										</select>
										</label>
									</fieldset>
									<div class="col-xs-6 formcol">
										<input type="reset" class="confirmButton placeRight"
											value="Clear">
									</div>
									<div class="col-xs-6 formcol">
										<input type="submit" class="confirmButton placeLeft"
											onclick="insertUser()" value="Confirm">
									</div>
								</form>
							</div>
							<div id="editUser" class="tab-pane fade">
								<p>Form for editing an existing user</p>
								<form autocomplete="off" id="editUserForm"
									onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>Select the user to be edited</legend>
										<label for="selectUsernameInput"> Username <input type="text"
											name="selectUsernameInput" id="selectUsernameInput"
											onblur="selectUser()" placeholder="Username">
										</label>
									</fieldset>
									<fieldset class="databaseForms">
										<legend>Department Information</legend>
										<label for="editPasswordInput"> Password <input
											type="password" name="editPasswordInput"
											id="editPasswordInput" placeholder="Password">
										</label> <label for="editAdminRightsInput"> Admin Rights <select
											id="editAdminRightsInput">
												<option value="ADMIN">ADMIN</option>
												<option value="MECHANIC">MECHANIC</option>
												<option value="GENERAL">GENERAL</option>
										</select>
										</label>
									</fieldset>
									<div class="col-xs-6 formcol">
										<input type="reset" class="confirmButton placeRight"
											value="Clear">
									</div>
									<div class="col-xs-6 formcol">
										<input type="submit" class="confirmButton placeLeft"
											onclick="updateUser()" value="Confirm">
									</div>
								</form>
							</div>
							<div id="removeUser" class="tab-pane fade">
								<p>Form to remove a user from the site</p>
								<form id="removeUserForm" onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>Select the user to be removed</legend>
										<label for="removeUsernameInput"> Username <input type="text"
											name="removeUsernameInput" id="removeUsernameInput"
											placeholder="Username">
										</label>
									</fieldset>
									<input type="submit" class="confirmButton placeCenter"
										onclick="removeUser()" value="Confirm">
								</form>
							</div>
						</div>
					</div>
					<div id="department" class="tab-pane fade">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#addDepartment">Add
									a Department</a></li>
							<li><a data-toggle="tab" href="#editDepartment">Edit an Existing
									Department</a></li>
						</ul>
						<div class="tab-content">
							<div id="addDepartment" class="tab-pane fade in active">
								<p>Form for adding a new Department</p>
								<form id="addDepartmentForm" onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>Department Information</legend>
										<label for="addDepartmentIDInput"> Department's ID <input
											type="text" name="addDepartmentIDInput"
											id="addDepartmentIDInput" placeholder="Department's ID">
										</label> <label for="addDepartmentNameInput"> Department's
											Name <input type="text" name="addDepartmentNameInput"
											id="addDepartmentNameInput" placeholder="Department's Name">
										</label>
									</fieldset>
									<div class="col-xs-6 formcol">
										<input type="reset" class="confirmButton placeRight"
											value="Clear">
									</div>
									<div class="col-xs-6 formcol">
										<input type="submit" class="confirmButton placeLeft"
											onclick="insertDepartment()" value="Confirm">
									</div>
								</form>
							</div>
							<div id="editDepartment" class="tab-pane fade">
								<p>Form for editing an existing Department</p>
								<form id="editDepartmentForm" onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>Select Department</legend>
										<label for="selectDepartmentNameInput"> Department's Name <!-- Will be populated by Javascript -->
											<select id="selectDepartmentNameInput"
											onchange="selectDepartment()"></select>
										</label>
									</fieldset>
									<fieldset class="databaseForms">
										<legend>Department Information</legend>
										<label for="editDepartmentNameInput"> Departmnet's Name <input
											type="text" name="editDepartmentNameInput"
											id="editDepartmentNameInput" placeholder="Department's Name">
										</label>
									</fieldset>
									<div class="col-xs-6 formcol">
										<input type="reset" class="confirmButton placeRight"
											value="Clear">
									</div>
									<div class="col-xs-6 formcol">
										<input type="submit" class="confirmButton placeLeft"
											onclick="updateDepartment()" value="Confirm">
									</div>
								</form>
							</div>

						</div>
					</div>
					<div id="mechanic" class="tab-pane fade">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#addMechanic">Add a
									Mechanic</a></li>
							<li><a data-toggle="tab" href="#editMechanic">Edit an Existing
									Mechanic</a></li>
							<li><a data-toggle="tab" href="#removeMechanic">Remove a Mechanic</a></li>
						</ul>
						<div class="tab-content">
							<div id="addMechanic" class="tab-pane fade in active">
								<p>Form for adding a new mechanic</p>
								<form id="addMechanicForm" onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>Mechanic Information</legend>
										<label for="addMechanicIDInput"> ID <input type="text"
											name="addMechanicIDInput" id="addMechanicIDInput"
											placeholder="Mechanic's ID">
										</label> <label for="addMechanicFirstNameInput"> First Name <input
											type="text" name="addMechanicFirstNameInput"
											id="addMechanicFirstNameInput"
											placeholder="Mechanic's First Name">
										</label> <label for="addMechanicLastNameInput"> Last Name <input
											type="text" name="addMechanicLastNameInput"
											id="addMechanicLastNameInput"
											placeholder="Mechanic's Last Name">
										</label>
									</fieldset>
									<div class="col-xs-6 formcol">
										<input type="reset" class="confirmButton placeRight"
											value="Clear">
									</div>
									<div class="col-xs-6 formcol">
										<input type="submit" class="confirmButton placeLeft"
											onclick="insertMechanic()" value="Confirm">
									</div>
								</form>
							</div>
							<div id="editMechanic" class="tab-pane fade">
								<p>Form for editing an existing Mechanic</p>
								<form id="editMechanicForm" onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>Select Mechanic</legend>
										<label for="selectMechanicIDInput"> Mechanic ID <input
											type="number" id="selectMechanicIDInput"
											name="selectMechanicIDInput" onblur="selectMechanic()"
											placeholder="Mechanic's ID">
										</label>
									</fieldset>
									<fieldset class="databaseForms">
										<legend>Mechanic Information</legend>
										<label for="editMechanicFirstNameInput"> First Name <input
											type="text" name="editMechanicFirstNameInput"
											id="editMechanicFirstNameInput"
											placeholder="Mechanic's First Name">
										</label> <label for="editMechanicLastNameInput"> Last Name <input
											type="text" name="editMechanicLastNameInput"
											id="editMechanicLastNameInput"
											placeholder="Mechanic's Last Name">
										</label>
									</fieldset>
									<div class="col-xs-6 formcol">
										<input type="reset" class="confirmButton placeRight"
											value="Clear">
									</div>
									<div class="col-xs-6 formcol">
										<input type="submit" class="confirmButton placeLeft"
											onclick="updateMechanic()" value="Confirm">
									</div>
								</form>
							</div>
							<div id="removeMechanic" class="tab-pane fade">
								<p>Form to remove a mechanic</p>
								<form id="removeMechanicForm" onsubmit="return false">
									<fieldset class="databaseForms">
										<legend>Select Mechanic</legend>
										<label for="removeMechanicIDInput"> Mechanic ID <input
											type="number" id="removeMechanicIDInput"
											name="removeMechanicIDInput" placeholder="Mechanic's ID">
										</label>
									</fieldset>
									<input type="submit" class="confirmButton placeCenter"
										onclick="removeMechanic()" value="Confirm">
								</form>
							</div>
						</div>
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
			setUserRights('admintasks');
		</script>
</body>
</html>