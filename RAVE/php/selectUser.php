<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

$USERNAME = $_POST["username"];

// Query we will send to the database
$sql = "SELECT * FROM LOGIN WHERE LOGIN_USER = '$USERNAME'";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    // Storing the results of the query
    $res = $conn->query($sql);
    
    // Putting that result into an array
    $content = mysqli_fetch_all($res);
    
    // Convert the array into a javascript readable version and return it
    echo json_encode($content, MYSQLI_NUM);
}

// Closing the connection
closeConn($conn);
?>