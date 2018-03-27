<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing department information to be deleted
$SCHEDULE_ID = $_POST["sid"];

// Putting it all in into one long string for the query
$sql = "DELETE FROM SCHEDULE WHERE SCHEDULE_ID = '$SCHEDULE_ID'";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    echo "Success";
}

// Closing the connection
closeConn($conn);
?>