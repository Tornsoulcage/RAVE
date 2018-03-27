<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering the variables from the form
$VEHICLE_ID = $_POST["vid"];
$START_DATE = $_POST["sDate"];
$END_DATE = $_POST["eDate"];

// These are the three results we are quering to fill
$TOTAL_GAS_PRICE = 0;
$TOTAL_MAINTENANCE_COST = 0;
$TOTAL_MILEAGE = 0;

// Query to select all checkups for our vehicle
$sql = "SELECT * FROM CHECKUP WHERE VEHICLE_ID = '$VEHICLE_ID' AND DATE >= '$START_DATE' AND DATE <= '$END_DATE' ORDER BY DATE ASC";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    $res = $conn->query($sql);
    
    // If the result isn't an empty table
    if (mysqli_num_rows($res) > 0) {
        $c_res = mysqli_fetch_all($res);
        
        // Finding the difference between the most recent mileage and the oldest mileage
        // Assumes the user doesnt mess up mileage and that mileages dont decrease
        $lastIndex = count($c_res) - 1;
        $TOTAL_MILEAGE = $c_res[$lastIndex][2] - $c_res[0][2];
    }
    
    // Query to find the average gas price of all checkups for a vehicle
    $sql = "SELECT AVG(GAS_PRICE) FROM CHECKUP WHERE VEHICLE_ID = '$VEHICLE_ID' AND DATE >= '$START_DATE' AND DATE <= '$END_DATE'";
    
    // Sending the query and catching any errors
    if (! $conn->query($sql)) {
        $error = $conn->error;
        echo $error;
    } else {
        $res = $conn->query($sql);
        
        // If the result is non empty
        if (mysqli_num_rows($res) > 0) {
            $c_res = mysqli_fetch_array($res);
            
            // And if it's not null - We get null values when there are no records for that vehicle
            if ($c_res[0] != null) {
                $TOTAL_GAS_PRICE = $c_res[0] * $TOTAL_MILEAGE;
            }
        }
        
        // Query to sum the total maintenance costs for this vehicle
        $sql = "SELECT SUM(MAINTENANCE_LABOR_COST + MAINTENANCE_PARTS_COST) FROM MAINTENANCE WHERE VEHICLE_ID = '$VEHICLE_ID' AND MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
        
        // Sending the query and catching any errors
        if (! $conn->query($sql)) {
            $error = $conn->error;
            echo $error;
        } else {
            $res = $conn->query($sql);
            
            // If the result is non empty
            if (mysqli_num_rows($res) > 0) {
                $c_res = mysqli_fetch_array($res);
                
                // And non null - We get a null result when there are no records for that vehicle
                if ($c_res[0] != null) {
                    $TOTAL_MAINTENANCE_COST = $c_res[0];
                }
            }
            
            // Making the array we are gonna send to the client
            $content = array();
            array_push($content, $TOTAL_MILEAGE, $TOTAL_GAS_PRICE, $TOTAL_MAINTENANCE_COST);
            echo (json_encode($content));
        }
    }
}

// Closing the connection
closeConn($conn);
?>