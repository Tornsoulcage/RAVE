<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for the appointment
$SCHEDULE_DATE = $_POST["date"];
$VEHICLE_ID = $_POST["vid"];
$MECHANIC_ID = $_POST["mec"];
$SCHEDULE_TIME_START = $_POST["startTime"];
$SCHEDULE_TIME_REQUIRED = $_POST["timeRequired"];
$SCHEDULE_DESCRIPTION = $_POST["desc"];

// Putting it all in into one long string for the query
$sql = "INSERT INTO schedule (VEHICLE_ID, MECHANIC_ID, SCHEDULE_DATE, SCHEDULE_TIME_START, SCHEDULE_TIME_REQUIRED, SCHEDULE_DESCRIPTION)
    						VALUES  ('$VEHICLE_ID', '$MECHANIC_ID', '$SCHEDULE_DATE', '$SCHEDULE_TIME_START', '$SCHEDULE_TIME_REQUIRED', '$SCHEDULE_DESCRIPTION')";

// Sending the query to the database and catching any errors to display
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    echo "Success";
}

// Closing the connection
closeConn($conn);
?>