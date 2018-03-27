<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing user information to be deleted
$USER_NAME = $_POST["username"];

// Putting it all in into one long string for the query
$sql = "DELETE FROM LOGIN WHERE LOGIN_USER = '$USER_NAME'";

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