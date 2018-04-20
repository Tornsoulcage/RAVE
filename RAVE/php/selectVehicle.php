<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing the id for the vehicle
$id = $_REQUEST["q"];

// Query we will send to the database
if ($id == '*') {
    $sql = "SELECT VEHICLE_ID FROM VEHICLE";
    
    // Sending the query and catching any errors
    if (! $conn->query($sql)) {
        $error = $conn->error;
        echo $error;
    } else {
        $res = $conn->query($sql);
        $content = mysqli_fetch_all($res);
        echo json_encode($content, MYSQLI_NUM);
    }
} else {
    $sql = "SELECT * FROM VEHICLE WHERE VEHICLE_ID = '$id'";
    
    // Sending the query and catching any errors
    if (! $conn->query($sql)) {
    	$error = mysqli_errno($conn);
    	if($error == 1452)
    		echo "Incorrect vehicle ID";
    		else
    			echo $error;
    } else {
        $res = $conn->query($sql);
        
        // Putting that result into an array
        $row = mysqli_fetch_array($res);
        
        // Convert the array into a javascript readable version and return it
        echo json_encode($row);
    }
}

// Closing the connection
closeConn($conn);
?>