<?php
    //Opening the connection to the database
    include('db_connection.php');
    $conn = openConn();
    
    //Query we will send to the database
    $sql = "SELECT * FROM LABORCODE";

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