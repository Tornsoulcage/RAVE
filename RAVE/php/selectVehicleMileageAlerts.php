<?php
// Opening the connection to the database
include ('db_connection.php');
$conn = openConn();

// Query to select all of our recommended mileages for service
$sql = "SELECT * FROM RECOMMENDED";

// Sending the query and catching any errors
if (! $conn->query($sql)) {
    $error = $conn->error;
    echo $error;
} else {
    // Storing the results of the query
    $res = $conn->query($sql);
    
    $rec_table = mysqli_fetch_all($res);
    
    // Making the array we will send to the client
    $content = array();
    
    // Loops through each record from the recommended table we queried
    for ($x = 0; $x < count($rec_table); $x ++) {
        $RECC_MILEAGE = $rec_table[$x][0];
        $RECC_DESC = $rec_table[$x][1];
        
        //Upper and Lower limits for the alerts
        $upper = .05 * $RECC_MILEAGE;
        $lower = -.05 * $RECC_MILEAGE;
        
        // Query to select all vehicles whose mileage falls within these bounds
        $sql = "SELECT * FROM `VEHICLE` WHERE MOD(VEHICLE_MILEAGE,'$RECC_MILEAGE') <= $upper OR MOD(VEHICLE_MILEAGE, '$RECC_MILEAGE') - '$RECC_MILEAGE' >= $lower";
        
        // Sending the query and catching any errors
        if (! $conn->query($sql)) {
            $error = $conn->error;
            echo $error;
        } else {
            $res = $conn->query($sql);
            
            // If we got a hit we add it to the records for the vehicle and then add it to the array we will send to the client
            // This will make a three dimensional array
            // One - a entry for each vehicle that got a hit
            // Two - The vehicle array along with some extra info
            // Three - The individual attriubutes for each vehicle we got
            if (mysqli_num_rows($res) > 0) {
                $res_table = mysqli_fetch_all($res, MYSQLI_NUM);

                // For every vehicle we pull the latest maintenance record associated with it
                for ($j = 0; $j < count($res_table); $j ++) {
                    $VEHICLE_ID = $res_table[$j][0];
                    $CURRENT_MILEAGE = $res_table[$j][6];
                    
                    $sql = "SELECT VEHICLE_MILEAGE 
                                FROM MAINTENANCE 
                                WHERE VEHICLE_ID = '$VEHICLE_ID' 
                                AND MAINTENANCE_DATE = (SELECT MAX(MAINTENANCE_DATE) FROM MAINTENANCE WHERE VEHICLE_ID = '$VEHICLE_ID')";
                    
                    // Send the query and catch any errors
                    if (! $conn->query($sql)) {
                        $error = $conn->error;
                        echo $error;
                    } else {
                        $res = $conn->query($sql);
                        // Array to hold the vehicle information and some extra info
                        $vehicle = array();
                        
                        if (mysqli_num_rows($res) > 0) {
                            //Pulling out the mileage for the most recent maintenance appointment
                            $main_res = mysqli_fetch_array($res);
                            $MAIN_MILEAGE = $main_res[0];
                            
                            //Finding how far away from our recc_mileage the most recent maintenance appointment was
                            $MAIN_MOD = $MAIN_MILEAGE % $RECC_MILEAGE;
                            
                            // If the record mileage is in the range then we assume that the reccommended maintenance was done
                            // So if the mileage is not in our range we push the vehicle into our content table
                            if (!($MAIN_MOD <= $upper || ($MAIN_MOD - $RECC_MILEAGE) >= $lower)) {
                                // If the vehicle's mileage is above the target mileage than we flag it to be restyled
                                $VEHICLE_MOD = $CURRENT_MILEAGE % $RECC_MILEAGE;
                                if ($VEHICLE_MOD <= $upper) {
                                    array_push($vehicle, $res_table[$j], $RECC_DESC, true);
                                    array_push($content, $vehicle);
                                } else {
                                    array_push($vehicle, $res_table[$j], $RECC_DESC, false);
                                    array_push($content, $vehicle);
                                }
                            }
                            
                        //If the vehicle has no maintenance records then we assume the reccommended maintenance has not been done
                        } else {
                            array_push($vehicle, $res_table[$j], $RECC_DESC, true);
                            array_push($content, $vehicle);
                        }
                    }
                }
            }
        }
    }
    
    // Convert the array into a javascript readable version and return it
    echo json_encode($content, MYSQLI_NUM);
}

// Closing the connection
closeConn($conn);
?>