<?php
// We will utilize session objects in this script
session_start();

// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for our user
$USERNAME = $_POST["user"];
$PASSWORD = $_POST["pass"];

// To check for a valid login we grab the rights for the requested user
$sql = "SELECT * FROM LOGIN WHERE LOGIN_USER = '$USERNAME'";

// Sending the query to the database and catching any errors to display
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    $res = $conn->query($sql);
    $row = mysqli_fetch_array($res);
    
    // Verifying the user's password and changing the rights if it's true
    if (password_verify($PASSWORD, $row[1]) == true) {
        $_SESSION["USER_RIGHTS"] = $row[2];
        echo true;
    } else {
        echo false;
    }
}

// Closing the connection
closeConn($conn);
?>