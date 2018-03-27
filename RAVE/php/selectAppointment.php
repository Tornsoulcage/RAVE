<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering the variables needed from the form
$VEHICLE_ID = $_POST["vid"];
$SCHEDULE_ID = $_POST["sid"];

// Long string for our query
// If we get an asterisk for schedule id then we want all schedule records for that vehicle
// If we get an asterisk for vehicle id then we want all records from the table
// Otherwise we select the requested record from the table
if ($SCHEDULE_ID == '*') {
    $sql = "SELECT * FROM schedule WHERE VEHICLE_ID = '$VEHICLE_ID'";
} else if ($VEHICLE_ID == '*') {
    $sql = "SELECT * FROM schedule";
} else {
    $sql = "SELECT * FROM schedule WHERE SCHEDULE_ID = '$SCHEDULE_ID'";
}

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    // Storing the result the query
    $res = $conn->query($sql);
    
    // Grabbing all of the rows from the query and putting it into a numeric array
    $content = mysqli_fetch_all($res);
    
    // Echo the json equivalent of the result
    echo json_encode($content);
}

// Closing the connection
closeConn($conn);
?>