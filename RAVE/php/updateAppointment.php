<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information for the appointment
$SCHEDULE_ID = $_POST["sid"];
$SCHEDULE_DATE = $_POST["date"];
$VEHICLE_ID = $_POST["vid"];
$MECHANIC_ID = $_POST["mec"];
$SCHEDULE_TIME_START = $_POST["startTime"];
$SCHEDULE_TIME_REQUIRED = $_POST["timeRequired"];
$SCHEDULE_DESCRIPTION = $_POST["desc"];

// Putting it all in into one long string for the query
$sql = "UPDATE SCHEDULE
            SET VEHICLE_ID = '$VEHICLE_ID',
                MECHANIC_ID = '$MECHANIC_ID',
                SCHEDULE_DATE = '$SCHEDULE_DATE',
                SCHEDULE_TIME_START = '$SCHEDULE_TIME_START',
                SCHEDULE_TIME_REQUIRED = '$SCHEDULE_TIME_REQUIRED',
                SCHEDULE_DESCRIPTION = '$SCHEDULE_DESCRIPTION'
            WHERE SCHEDULE_ID = '$SCHEDULE_ID'";

// Sending the query to the database and catching any errors to display
if (! $conn->query($sql)) {
	$error = mysqli_errno($conn);
	if($error == 1452)
		echo "Incorrect vehicle ID";
		else
			echo $error;
} else {
    echo "Success";
}

// Closing the connection
closeConn($conn);
?>