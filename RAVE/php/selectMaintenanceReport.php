<?php
    //Opening the connection to the database
    include('db_connection.php');
    $conn = openConn();
    
    //Gathering the variables needed from the form
    $LICENSE_CLASS = $_POST["licenseClass"];
    $START_DATE = $_POST["sDate"];
    $END_DATE = $_POST["eDate"];
    
    //These are the two variables we will query to fill
    $TOTAL_LABOR_COST = 0;
    $TOTAL_PARTS_COST = 0;
    
    //If we get CLASS_ALL then we want to query for all vehicles rather than vehicles of a certain class
    //Queries sum labor cost for all the vehicles in question
    if($LICENSE_CLASS == "CLASS_ALL"){
        $sql = "SELECT SUM(MAINTENANCE_LABOR_COST) FROM MAINTENANCE JOIN VEHICLE ON MAINTENANCE.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
    } else {
        $sql = "SELECT SUM(MAINTENANCE_LABOR_COST) FROM MAINTENANCE JOIN VEHICLE ON MAINTENANCE.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE VEHICLE_REQUIRED_LICENSE = '$LICENSE_CLASS' AND MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
    }
    
    //Sending the query and catching any errors
    if(!$conn -> query($sql)){
        $error = $conn -> error;
        echo $error;
    } else {
        $res = $conn -> query($sql);
        
        //If our result isn't empty
        if(mysqli_num_rows($res) > 0) {
            $c_res = mysqli_fetch_array($res);
            
            //And non null - We get a null result if there are no records for the class in question
            if($c_res[0] != null){
                $TOTAL_LABOR_COST = $c_res[0];
            }
        }
        
        //Same thing as the other query above except will sum parts cost instead
        if($LICENSE_CLASS == "CLASS_ALL"){
            $sql = "SELECT SUM(MAINTENANCE_PARTS_COST) FROM MAINTENANCE JOIN VEHICLE ON MAINTENANCE.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
        } else {
            $sql = "SELECT SUM(MAINTENANCE_PARTS_COST) FROM MAINTENANCE JOIN VEHICLE ON MAINTENANCE.VEHICLE_ID = VEHICLE.VEHICLE_ID WHERE VEHICLE_REQUIRED_LICENSE = '$LICENSE_CLASS' AND MAINTENANCE_DATE >= '$START_DATE' AND MAINTENANCE_DATE <= '$END_DATE'";
        }
        
        //Sending the query and catching any errors
        if(!$conn -> query($sql)){
            $error = $conn -> error;
            echo $error;
        } else {
            $res = $conn -> query($sql);
            
            //If our result is not empty
            if(mysqli_num_rows($res) > 0){
                $c_res = mysqli_fetch_array($res);
                
                //And not null
                if($c_res[0] != null){
                    $TOTAL_PARTS_COST = $c_res[0];
                }
                
            }
            
            //The array we will send to the client
            $content = array();
            
            //Adding our variables to the array and returning it to the client
            array_push($content, $TOTAL_LABOR_COST, $TOTAL_PARTS_COST);
            echo(json_encode($content));
        }
    }
    
    //Closing the connection
    closeConn($conn);
?>