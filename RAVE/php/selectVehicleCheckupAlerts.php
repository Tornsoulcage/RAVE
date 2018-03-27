<?php
    //Opening the connection to the database
    include('db_connection.php');
    $conn = openConn();
    $DATE = date("Y-m-d");
    
    //Query to select our vehicle table
    $sql = "SELECT * FROM VEHICLE";
    
    //Sending the query and catching any errors
    if(!$conn -> query($sql)){
        $error = $conn -> error;
        echo $error;
    } else {
        //Storing the results of the query
        $res = $conn -> query($sql);
        
        $veh_table = mysqli_fetch_all($res);
        
        //The array we will send to the client
        $content = array();
        
        //Loops through all of our vehicles
        for($x = 0; $x < count($veh_table); $x++){
            $VEHICLE_ID = $veh_table[$x][0];
            
            //Query that selects the most recent checkup for any vehicle whose most recent checkup is more than a week past
            $sql = "SELECT * FROM vehicle JOIN checkup ON vehicle.VEHICLE_ID = checkup.VEHICLE_ID 
                    WHERE vehicle.VEHICLE_ID = $VEHICLE_ID AND DATEDIFF('$DATE', (SELECT MAX(checkup.DATE) FROM checkup WHERE checkup.VEHICLE_ID = $VEHICLE_ID)) >= 7 
                    AND checkup.DATE = (SELECT MAX(checkup.DATE) FROM checkup WHERE checkup.VEHICLE_ID = $VEHICLE_ID)";
            
            
            $res = $conn -> query($sql);
            
            //If we got a hit we add it to our array
            if(mysqli_num_rows($res) > 0){
                $res_table = mysqli_fetch_all($res);
                array_push($content, $res_table);
            }
        }
        
        //Convert the array into a javascript readable version and return it
        echo json_encode($content, MYSQLI_NUM);
    }

    //Closing the connection
    closeConn($conn);
?>