<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering all of the information for the vehicle
$VEHICLE_ID = $_POST["vid"];
$DEPARTMENT_ID = $_POST["did"];
$VEHICLE_MAKE = $_POST["make"];
$VEHICLE_MODEL = $_POST["model"];
$VEHICLE_YEAR = $_POST["year"];
$VEHICLE_VIN = $_POST["vin"];
$VEHICLE_MILEAGE = $_POST["mileage"];
$VEHICLE_ENGINE = $_POST["engine"];
$VEHICLE_TIRES = $_POST["tires"];
$VEHICLE_CONDITION = $_POST["condition"];
$VEHICLE_REQUIRED_LICENSE = $_POST["license"];

// Putting all the information into a long string for the query
$sql = "UPDATE vehicle
			SET DEPARTMENT_ID = '$DEPARTMENT_ID', VEHICLE_MAKE = '$VEHICLE_MAKE', VEHICLE_MODEL = '$VEHICLE_MODEL',
                VEHICLE_YEAR = '$VEHICLE_YEAR', VEHICLE_VIN = '$VEHICLE_VIN', VEHICLE_MILEAGE = '$VEHICLE_MILEAGE',
                VEHICLE_ENGINE = '$VEHICLE_ENGINE', VEHICLE_TIRES = '$VEHICLE_TIRES', VEHICLE_CONDITION = '$VEHICLE_CONDITION',
                VEHICLE_REQUIRED_LICENSE = '$VEHICLE_REQUIRED_LICENSE'
			WHERE VEHICLE_ID = '$VEHICLE_ID'";

// Sending the query to the database and catching any errors to display
if (! $conn->query($sql)) {
	$error = mysqli_errno($conn);
	if($error == 1452)
		echo "Incorrect vehicle ID";
		else
			echo $error;
} else {
    echo "Success";
}

// Closing the connection
closeConn($conn);
?>