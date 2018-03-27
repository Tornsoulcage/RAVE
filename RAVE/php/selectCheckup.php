<?php
    //Opening the connection to the database
    include('db_connection.php');
    $conn = openConn();
    
    //Grabbing the id for the vehicle and date for checkup
    $id = $_POST["vid"];
    $cid = $_POST["cid"];
    
    //Query we will send to the database
    //If our checkup id is an asterisk then we want all the checkups for the vehicle
    if($cid == "*"){
        $sql = "SELECT * FROM CHECKUP WHERE VEHICLE_ID = '$id'";
    } else {
        $sql = "SELECT * FROM CHECKUP WHERE VEHICLE_ID = '$id' AND DATE = '$cid'";
    }
    
    //Sending the query and catching any errors
    if(!$conn -> query($sql)){
        $error = $conn -> error;
        echo $error;
    } else {
        $res = $conn -> query($sql);
        
        //Putting that result into an array
        $content = mysqli_fetch_all($res);
        
        //Convert the array into a javascript readable version and return it
        echo json_encode($content);
    }

    //Closing the connection
    closeConn($conn);
?>
