<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Gathering the variables needed from the forms
$DEPARTMENT_NAME = $_POST["dName"];
$START_DATE = $_POST["sDate"];
$END_DATE = $_POST["eDate"];

// The variables we are looking to fill
$TOTAL_MILEAGE = 0;
$TOTAL_GAS_PRICE = 0;
$AVG_MILEAGE = 0;
$TOTAL_VEHICLES = 0;
$TOTAL_MAINTENANCE_COST = 0;
$TOTAL_REQUESTS = 0;

// Query to change Department Name to Department ID
$sql = "SELECT DEPARTMENT_ID FROM department WHERE DEPARTMENT_NAME = '$DEPARTMENT_NAME'";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    $res = $conn->query($sql);
    $row = mysqli_fetch_array($res);
    
    // Setting our department id
    $DEPARTMENT_ID = $row[0];
    
    // Selects all vehicle id's that are associated with our department
    $sql = "SELECT VEHICLE_ID FROM VEHICLE WHERE DEPARTMENT_ID = '$DEPARTMENT_ID'";
    
    // Sending the query and catching any errors
    if (! $conn->query($sql)) {
        $error = $conn->error;
        echo $error;
    } else {
        $res = $conn->query($sql);
        
        // If our result isn't empty
        if (mysqli_num_rows($res) > 0) {
            $v_res = mysqli_fetch_all($res);
            
            // Loops through all of the vehicles we recieved earlier
            for ($x = 0; $x < count($v_res); $x ++) {
                $VEHICLE_ID = $v_res[$x][0];
                
                // Selects all checkups associated with that vehiclec
                $sql = "SELECT * FROM CHECKUP WHERE VEHICLE_ID = '$VEHICLE_ID' AND DATE >= '$START_DATE' AND DATE <= '$END_DATE' ORDER BY DATE ASC";
                
                // Sending the query and catching any errors
                if (! $conn->query($sql)) {
                    $error = $conn->error;
                    echo $error;
                } else {
                    $res = $conn->query($sql);
                    
                    // If our result is not empty
                    if (mysqli_num_rows($res) > 0) {
                        $c_res = mysqli_fetch_all($res);
                        
                        // Adding the difference in mileage for that vehicle to our total
                        $lastIndex = count($c_res) - 1;
                        $TOTAL_MILEAGE += $c_res[$lastIndex][2] - $c_res[0][2];
                    }
                }
            }
        }
        
        // Gets the average gas price for all checkups where the vehicle belongs to our department
        $sql = "SELECT AVG(GAS_PRICE) FROM CHECKUP JOIN VEHICLE ON CHECKUP.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE VEHICLE.DEPARTMENT_ID = '$DEPARTMENT_ID' AND DATE >= '$START_DATE' AND DATE <= '$END_DATE'";
        
        // Sending the query and catching any errors
        if (! $conn->query($sql)) {
            $error = $conn->error;
            echo $error;
        } else {
            $res = $conn->query($sql);
            
            // If our result is not empty
            if (mysqli_num_rows($res) > 0) {
                $c_res = mysqli_fetch_array($res);
                
                // And not null - We get a null result if there are no records
                if ($c_res[0] != null) {
                    $TOTAL_GAS_PRICE = $c_res[0] * $TOTAL_MILEAGE;
                }
            }
            
            // Sums the maintenance costs for all vehicles that are in our department
            $sql = "SELECT SUM(MAINTENANCE_LABOR_COST + MAINTENANCE_PARTS_COST) FROM MAINTENANCE JOIN VEHICLE ON MAINTENANCE.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE VEHICLE.DEPARTMENT_ID = '$DEPARTMENT_ID' AND MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
            
            // Sending the query and catching any errors
            if (! $conn->query($sql)) {
                $error = $conn->error;
                echo $error;
            } else {
                $res = $conn->query($sql);
                
                // If our result is not empty
                if (mysqli_num_rows($res) > 0) {
                    $c_res = mysqli_fetch_array($res);
                    
                    // And not null - We get a null result if there are no records available
                    if ($c_res[0] != null) {
                        $TOTAL_MAINTENANCE_COST = $c_res[0];
                    }
                }
                
                // Counts all vehicles that are in our department
                $sql = "SELECT COUNT(VEHICLE_ID) FROM VEHICLE WHERE DEPARTMENT_ID = '$DEPARTMENT_ID'";
                
                // Sending the query and catching any errors
                if (! $conn->query($sql)) {
                    $error = $conn->error;
                    echo $error;
                } else {
                    $res = $conn->query($sql);
                    
                    // If our result is not empty
                    if (mysqli_num_rows($res) > 0) {
                        $c_res = mysqli_fetch_array($res);
                        
                        // And not null - We get a null result if there are no records available
                        if ($c_res[0] != null) {
                            $TOTAL_VEHICLES = $c_res[0];
                            
                            // If our total is not still zero we can find the average mileage
                            if ($TOTAL_VEHICLES != 0) {
                                $AVG_MILEAGE = $TOTAL_MILEAGE / $TOTAL_VEHICLES;
                            }
                        }
                    }
                    
                    // Counts the number of maintenance records with vehicles in our department
                    $sql = "SELECT COUNT(MAINTENANCE_REPAIR_ID) FROM MAINTENANCE JOIN VEHICLE ON MAINTENANCE.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE DEPARTMENT_ID = '$DEPARTMENT_ID' AND MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
                    
                    // Sending the query and catching any errors
                    if (! $conn->query($sql)) {
                        $error = $conn->error;
                        echo $error;
                    } else {
                        $res = $conn->query($sql);
                        
                        // If our result is not empty
                        if (mysqli_num_rows($res) > 0) {
                            $c_res = mysqli_fetch_array($res);
                            
                            // And not null
                            if ($c_res[0] != null) {
                                $TOTAL_REQUESTS = $c_res[0];
                            }
                        }
                        
                        // Array we will send to the client
                        $content = array();
                        
                        // Adding all of our variables to the array and sending it back
                        array_push($content, $TOTAL_MILEAGE, $TOTAL_GAS_PRICE, $TOTAL_MAINTENANCE_COST, $TOTAL_REQUESTS, $TOTAL_VEHICLES, $AVG_MILEAGE);
                        echo (json_encode($content));
                    }
                }
            }
        }
    }
}

// Closing the connection
closeConn($conn);
?>