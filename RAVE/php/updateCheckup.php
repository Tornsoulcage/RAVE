<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering all of the information for the vehicle
$VEHICLE_ID = $_POST["vid"];
$DATE = $_POST["cid"];
$MILEAGE = $_POST["mileage"];
$GAS_PRICE = $_POST["gas"];
$COMMENTS = $_POST["comments"];

// Putting all the information into a long string for the query
$sql = "UPDATE checkup
    			SET MILEAGE = '$MILEAGE', GAS_PRICE = '$GAS_PRICE', COMMENTS = '$COMMENTS'
    			WHERE VEHICLE_ID = '$VEHICLE_ID' AND DATE = '$DATE'";

// Sending the query to the database and catching any errors to display
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    $sql = "UPDATE VEHICLE
            SET VEHICLE_MILEAGE = '$MILEAGE'
            WHERE VEHICLE_ID = '$VEHICLE_ID'";
    if(!$conn -> query($sql)){
        $error = $conn->error;
        echo $error;
    } else {
        echo "Success";
    }
}

// Closing the connection
closeConn($conn);
?>