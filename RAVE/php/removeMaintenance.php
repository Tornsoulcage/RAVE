<?php
// Starting connection to database
include ('db_connection.php');
$conn = openConn();

// Grabbing the id for the appointment
$MAINTENANCE_REPAIR_ID = $_POST["mid"];

$sql = "DELETE FROM MAINTENANCE WHERE MAINTENANCE_REPAIR_ID = '$MAINTENANCE_REPAIR_ID'";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    $conn->query($sql);
    echo "Success";
}

// Closing the connection
closeConn($conn);
?>
