<?php
// Opening connection to the database
include ('db_connection.php');
$conn = openConn();

// Grabbing all of the information from text boxes
$VEHICLE_ID = $_POST["vid"];
$LABOR_CODES = $_POST["laborCodes"];
$MAINTENANCE_DATE = $_POST["mainDate"];
$MAINTENANCE_MECHANIC = $_POST["mechanic"];
$MAINTENANCE_MILEAGE = $_POST["mileage"];
$MAINTENANCE_APPOINTMENT = $_POST["workType"];
$MAINTENANCE_SPECIAL_WORK = $_POST["specialWork"];
$MAINTENANCE_PARTS_COST = $_POST["partsCost"];
$MAINTENANCE_LABOR_COST = $_POST["laborCost"];

//First we have to check if the user is entering a larger amount for the vehicle's mileage
$sql = "SELECT VEHICLE_MILEAGE FROM VEHICLE WHERE VEHICLE_ID = '$VEHICLE_ID'";

if(!$conn->query($sql)){
    $error = mysqli_error($conn);
    echo $error;
} else {
    $res = $conn -> query($sql);
    $row = mysqli_fetch_array($res);
    
    //If the amount is smaller than what we have than we echo a message and end
    if($row[0] > $MAINTENANCE_MILEAGE){
        echo "Mileage cannot be lower than the previous value";
    } else {
        // Putting it all in into one long string for the query
        $sql = "INSERT INTO MAINTENANCE (VEHICLE_ID, MECHANIC_ID, VEHICLE_MILEAGE, MAINTENANCE_LABOR_CODE, MAINTENANCE_DATE, MAINTENANCE_APPOINTMENT, MAINTENANCE_REASON, MAINTENANCE_PARTS_COST, MAINTENANCE_LABOR_COST)
        	       			VALUES ('$VEHICLE_ID', '$MAINTENANCE_MECHANIC', '$MAINTENANCE_MILEAGE', '$LABOR_CODES', '$MAINTENANCE_DATE', '$MAINTENANCE_APPOINTMENT', '$MAINTENANCE_SPECIAL_WORK', '$MAINTENANCE_PARTS_COST', '$MAINTENANCE_LABOR_COST')";
        
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
                        SET VEHICLE_MILEAGE = '$MAINTENANCE_MILEAGE'
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