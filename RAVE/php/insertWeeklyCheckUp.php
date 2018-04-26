<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information from the form
$VEHICLE_ID = $_POST["vid"];
$MILEAGE = $_POST["mil"];
$GAS_PRICE = $_POST["gas"];
$COMMENTS = $_POST["com"];
$DATE = date("Y-m-d");

//First we have to check if the user is entering a larger amount for the vehicle's mileage
$sql = "SELECT VEHICLE_MILEAGE FROM VEHICLE WHERE VEHICLE_ID = '$VEHICLE_ID'";

if(!$conn->query($sql)){
    $error = mysqli_error($conn);
    echo $error;
} else {
    $res = $conn -> query($sql);
    $row = mysqli_fetch_array($res);
    
    //If the amount is smaller than what we have than we echo a message and end
    if($row[0] > $MILEAGE){
        echo "Mileage cannot be lower than the previous value";
    } else {
        // Putting it all in into one long string for the query
        $sql = "INSERT INTO CHECKUP (VEHICLE_ID, DATE, MILEAGE, GAS_PRICE, COMMENTS)
        				VALUES ('$VEHICLE_ID', '$DATE', '$MILEAGE', '$GAS_PRICE', '$COMMENTS')";
        
        // Sending the query to the database and catching any errors to display
        if (! $conn->query($sql)) {
        	$error = mysqli_errno($conn);
        	if($error == 1452)
        		echo "Incorrect vehicle ID";
        		else
        			echo $error;
        } else {
            // Changing the mileage for the vehicle in question
            $sql = "UPDATE VEHICLE
                        SET VEHICLE_MILEAGE = '$MILEAGE'
                        WHERE VEHICLE_ID = '$VEHICLE_ID'";
            
            // Sending the query
            $conn->query($sql);
            
            echo "Success";
        }
    }
}

// Closing the connection
closeConn($conn);
?>