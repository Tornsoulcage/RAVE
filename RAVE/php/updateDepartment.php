<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for the department
$DEPART_ID = $_POST["deptID"];
$DEPART_NAME = $_POST["deptName"];

// Putting it all in into one long string for the query
$sql = "Update DEPARTMENT
			SET DEPARTMENT_ID = '$DEPART_ID', DEPARTMENT_NAME = '$DEPART_NAME'
			WHERE DEPARTMENT_ID = '$DEPART_ID'";

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