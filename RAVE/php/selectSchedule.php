<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering the date from the form
$DATE = $_POST["date"];

// Long string for our query
$sql = "SELECT * FROM schedule JOIN mechanic ON schedule.MECHANIC_ID = mechanic.MECHANIC_ID WHERE SCHEDULE_DATE = '$DATE'";

if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    // Storing the result the query
    $res = $conn->query($sql);
    
    // Grabbing all of the rows from the query and putting it into a numeric array
    $content = mysqli_fetch_all($res, MYSQLI_NUM);
    
    // Echo the json equivalent of the result
    echo json_encode($content);
}

// Closing the connection
closeConn($conn);
?>