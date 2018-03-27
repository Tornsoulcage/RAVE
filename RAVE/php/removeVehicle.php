<?php
// Starting connection to database
include ('db_connection.php');
$conn = openConn();

// Grabbing the id for the vehicle
$id = $_REQUEST["q"];

// In order to delete the vehicle record we must first remove all records from other tables that are refers to it
$sql = "DELETE FROM CHECKUP WHERE VEHICLE_ID = '$id'";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    $sql = "DELETE FROM MAINTENANCE WHERE VEHICLE_ID = '$id'";
    
    // Sending the query and catching any errors
    if (! $conn->query($sql)) {
        $error = $conn->error;
        echo $error;
    } else {
        $sql = "DELETE FROM SCHEDULE WHERE VEHICLE_ID = '$id'";
        
        // Sending the query and catching any errors
        if (! $conn->query($sql)) {
            $error = $conn->error;
            echo $error;
        } else {
            $sql = "DELETE FROM VEHICLE WHERE VEHICLE_ID = '$id'";
            
            // Sending the query and catching any errors
            if (! $conn->query($sql)) {
                $error = $conn->error;
                echo $error;
            } else {
                echo "Success";
            }
        }
    }
}
// Closing the connection
closeConn($conn);
?>