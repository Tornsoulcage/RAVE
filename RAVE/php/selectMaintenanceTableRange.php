<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering the variables needed from the form
$VEHICLE_ID = $_POST["vid"];
$MAINTENANCE_REPAIR_ID = $_POST["mid"];
$START_DATE = $_POST["sDate"];
$END_DATE = $_POST["eDate"];

// Query we will send to the database
// If we get an asterisk for the vehicle id then want to select all of the maintenance records in the range for every vehicle
// Otherwise we only want them for the specific vehicle in question
if ($VEHICLE_ID == '*') {
    $sql = "SELECT * FROM MAINTENANCE JOIN MECHANIC ON MAINTENANCE.MECHANIC_ID =  MECHANIC.MECHANIC_ID WHERE MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
} else {
    $sql = "SELECT * FROM MAINTENANCE JOIN MECHANIC ON MAINTENANCE.MECHANIC_ID =  MECHANIC.MECHANIC_ID WHERE VEHICLE_ID = '$VEHICLE_ID' AND MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
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