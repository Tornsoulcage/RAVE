<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing department information to be deleted
$MECH_ID = $_POST["mechID"];

// Putting it all in into one long string for the query
$sql = "DELETE FROM MECHANIC WHERE MECHANIC_ID = '$MECH_ID'";

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