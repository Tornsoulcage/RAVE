<?php
    // Opening the connection to the database
    include ('db_connection.php');
    $conn = openConn();
    
    $DEPARTMENT_ID = $_POST["did"];
    
    // Query we will send to the database
    if ($DEPARTMENT_ID == '*') {
        $sql = "SELECT * FROM VEHICLE";
        
        // Sending the query and catching any errors
        if (! $conn->query($sql)) {
            $error = $conn->error;
            echo $error;
        } else {
            $res = $conn->query($sql);
            $content = mysqli_fetch_all($res);
            echo json_encode($content, MYSQLI_NUM);
        }
    } else {
        $sql = "SELECT * FROM VEHICLE WHERE DEPARTMENT_ID = '$DEPARTMENT_ID'";
        
        // Sending the query and catching any errors
        if (! $conn->query($sql)) {
            $error = $conn->error;
            echo $error;
        } else {
            $res = $conn->query($sql);
            $content = mysqli_fetch_all($res);
            
            // Convert the array into a javascript readable version and return it
            echo json_encode($content, MYSQLI_NUM);
        }
    }
    
    // Closing the connection
    closeConn($conn);
?>