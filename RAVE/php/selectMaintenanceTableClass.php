<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering the variables needed from the form
$LICENSE_CLASS = $_POST["licenseClass"];
$START_DATE = $_POST["sDate"];
$END_DATE = $_POST["eDate"];

// Query we will send to the database
// If we get an asterisk for the license class then we want all the maintenace records for each vehicle in the range
// Otherwise we only want the records associatied with vehicles of that class
if ($LICENSE_CLASS == '*') {
    $sql = "SELECT * FROM MAINTENANCE JOIN MECHANIC ON MAINTENANCE.MECHANIC_ID = MECHANIC.MECHANIC_ID WHERE MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
} else {
    $sql = "SELECT * FROM MAINTENANCE JOIN MECHANIC ON MAINTENANCE.MECHANIC_ID = MECHANIC.MECHANIC_ID JOIN VEHICLE ON MAINTENANCE.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE VEHICLE.VEHICLE_REQUIRED_LICENSE = '$LICENSE_CLASS' AND MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
}

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    // Storing the results of the query
    $res = $conn->query($sql);
    
    // Putting that result into an array
    $content = mysqli_fetch_all($res);
    
    // Convert the array into a javascript readable version and return it
    echo json_encode($content);
}

// Closing the connection
closeConn($conn);
?>