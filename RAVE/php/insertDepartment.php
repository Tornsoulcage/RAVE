<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for department
$DEPART_ID = $_POST["deptID"];
$DEPART_NAME = $_POST["deptName"];

// Putting it all in into one long string for the query
$sql = "INSERT INTO DEPARTMENT (DEPARTMENT_ID, DEPARTMENT_NAME) 
						VALUES  ('$DEPART_ID', '$DEPART_NAME')";

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