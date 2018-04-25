<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for the vehicle
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

// Putting it all in into one long string for the query
$sql = "INSERT INTO vehicle (VEHICLE_ID, DEPARTMENT_ID, VEHICLE_MAKE, VEHICLE_MODEL, VEHICLE_YEAR, VEHICLE_VIN, VEHICLE_MILEAGE, VEHICLE_ENGINE, VEHICLE_TIRES, VEHICLE_CONDITION, VEHICLE_REQUIRED_LICENSE) 
						VALUES  ('$VEHICLE_ID', '$DEPARTMENT_ID', '$VEHICLE_MAKE', '$VEHICLE_MODEL', '$VEHICLE_YEAR', '$VEHICLE_VIN', '$VEHICLE_MILEAGE', '$VEHICLE_ENGINE', '$VEHICLE_TIRES', '$VEHICLE_CONDITION', '$VEHICLE_REQUIRED_LICENSE')";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
	$error = mysqli_errno($conn);
	if($error == 1062)
		echo "Can't have duplicate Vehicle ID";
    echo $error;
} else {
    // Once we have inserted a vehicle we insert a default checkup with its information
    // This helps us build our reports
    $DATE = date('Y-m-d');
    
    $sql = "INSERT INTO CHECKUP (VEHICLE_ID, DATE, MILEAGE, GAS_PRICE, COMMENTS)
				VALUES ('$VEHICLE_ID', '$DATE', '$VEHICLE_MILEAGE', '0', 'INITIAL CREATION')";
    
    // Sending the query and catching any errors
    if (! $conn->query($sql)) {
        $error = $conn->error;
        echo $error;
    } else {
        echo "Success";
    }
}

// Closing the connection
closeConn($conn);
?>