<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing the id for the vehicle and maintenance record
$VEHICLE_ID = $_POST["vid"];
$MAINTENANCE_REPAIR_ID = $_POST["mid"];

// Query we will send to the database
// If we get an asterisk for the maintenance id then we want to gather all records for the associated vehicle
// If we get an asterisk for the vehicle id then we want all of the maintenance records
// Otherwise we only select the record in question
if ($MAINTENANCE_REPAIR_ID == '*') {
    $sql = "SELECT * FROM MAINTENANCE JOIN MECHANIC ON MAINTENANCE.MECHANIC_ID = MECHANIC.MECHANIC_ID WHERE VEHICLE_ID = '$VEHICLE_ID'";
} else if ($VEHICLE_ID == '*') {
    $sql = "SELECT * FROM MAINTENANCE";
} else {
    $sql = "SELECT * FROM MAINTENANCE WHERE MAINTENANCE_REPAIR_ID = '$MAINTENANCE_REPAIR_ID'";
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