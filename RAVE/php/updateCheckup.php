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
        // Putting all the information into a long string for the query
        $sql = "UPDATE checkup
            			SET MILEAGE = '$MILEAGE', GAS_PRICE = '$GAS_PRICE', COMMENTS = '$COMMENTS'
            			WHERE VEHICLE_ID = '$VEHICLE_ID' AND DATE = '$DATE'";
        
        // Sending the query to the database and catching any errors to display
        if (! $conn->query($sql)) {
            $error = mysqli_errno($conn);
            if($error == 1452){
                echo "Incorrect vehicle ID";
            } else if($error == 1062){
                echo "Check-in already exists for this date.";
            } else {
                echo $error;
            }
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
    }
}

// Closing the connection
closeConn($conn);
?>