<?php
	//Opening connection to the database
	include ('db_connection.php');
	$conn = openConn();
	
	//Grabbing all of the information from the form
	$VEHICLE_ID = $_POST["vid"];
	$MILEAGE = $_POST["mil"];
	$GAS_PRICE = $_POST["gas"];
	$COMMENTS = $_POST["com"];
	$DATE = date("Y-m-d");
	
	//Putting it all in into one long string for the query
	$sql = "INSERT INTO CHECKUP (VEHICLE_ID, DATE, MILEAGE, GAS_PRICE, COMMENTS)
				VALUES ('$VEHICLE_ID', '$DATE', '$MILEAGE', '$GAS_PRICE', '$COMMENTS')";
	
	//Sending the query to the database and catching any errors to display
	if(!$conn -> query($sql)){
	    $error = $conn -> error;
	    echo $error;
	} else {
	    //Changing the mileage for the vehicle in question
	    $sql = "UPDATE VEHICLE
                SET VEHICLE_MILEAGE = '$MILEAGE'
                WHERE VEHICLE_ID = '$VEHICLE_ID'";
	   
	    //Sending the query
        $conn -> query($sql);
        
	    echo "Success";
	}
	
	//Closing the connection
	closeConn($conn);
?>