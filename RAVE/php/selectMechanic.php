<?php
    //Opening the connection to the database
    include('db_connection.php');
    $conn = openConn();
    
    $MEC_ID = $_REQUEST["q"];
    
    //Query we will send to the database
    //If we get the asterisk then we want all of the mechanics from the table
    //Otherwise we only select the info for the specific mechanic in question
    if($MEC_ID == '*'){
        $sql = "SELECT * FROM MECHANIC";
    } else {
        $sql = "SELECT * FROM MECHANIC WHERE MECHANIC_ID = '$MEC_ID'";
    }
    
    //Sending the query and catching any errors
    if(!$conn -> query($sql)){
        $error = $conn -> error;
        echo $error;
    } else {
        //Storing the results of the query
        $res = $conn -> query($sql);
    
        //Putting that result into an array
        $content = mysqli_fetch_all($res);
          
        //Convert the array into a javascript readable version and return it
        echo json_encode($content, MYSQLI_NUM);
    
    }
    
    //Closing the connection
    closeConn($conn);
?>