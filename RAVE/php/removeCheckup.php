<?php
// Starting connection to database
include ('db_connection.php');
$conn = openConn();

// Grabbing the id for the vehicle
$vid = $_POST["vid"];
$cid = $_POST["cid"];

$sql = "DELETE FROM CHECKUP WHERE VEHICLE_ID = '$vid' AND DATE = '$cid'";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
	$error = mysqli_errno($conn);
	if($error == 1452)
		echo "Incorrect vehicle ID";
		else
			echo $error;
} else {
    $conn->query($sql);
    echo "Success";
}

// Closing the connection
closeConn($conn);
?>
