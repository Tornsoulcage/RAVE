<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for the department
$MECH_ID = $_POST["mechID"];
$MECH_FNAME = $_POST["mechFName"];
$MECH_LNAME = $_POST["mechLNAME"];

// Putting it all in into one long string for the query
$sql = "Update MECHANIC
			SET MECHANIC_ID = '$MECH_ID', MECHANIC_FIRST_NAME = '$MECH_FNAME', MECHANIC_LAST_NAME = '$MECH_LNAME'
			WHERE MECHANIC_ID = '$MECH_ID'";

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