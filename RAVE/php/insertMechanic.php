<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for mechanic
$MECH_ID = $_POST["mechID"];
$MECH_FNAME = $_POST["mechFName"];
$MECH_LNAME = $_POST["mechLNAME"];

// Putting it all in into one long string for the query
$sql = "INSERT INTO MECHANIC (MECHANIC_ID, MECHANIC_FIRST_NAME, MECHANIC_LAST_NAME) 
						VALUES  ('$MECH_ID', '$MECH_FNAME', '$MECH_LNAME')";

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