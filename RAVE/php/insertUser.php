<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for the user
$USER_NAME = $_POST["username"];
$USER_PASS = $_POST["password"];
$USER_RIGHTS = $_POST["adminRights"];

// Hashing the user's password
$HASH = password_hash($USER_PASS, PASSWORD_DEFAULT);

// Putting it all in into one long string for the query
$sql = "INSERT INTO LOGIN (LOGIN_USER, LOGIN_PASSWORD, LOGIN_RIGHTS) 
						VALUES  ('$USER_NAME', '$HASH', '$USER_RIGHTS')";

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