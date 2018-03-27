<?php
	//Opening connection to the database
	include ('db_connection.php');
	$conn = openConn();
	
	//Grabbing all of the information for the user
	$USER_NAME = $_POST["username"];
	$USER_PASS = $_POST["password"];
	$USER_RIGHTS = $_POST["adminRights"];

	$HASH = password_hash($USER_PASS, PASSWORD_DEFAULT);
	
	//Putting it all in into one long string for the query
	$sql = "Update LOGIN
			SET LOGIN_USER = '$USER_NAME', LOGIN_PASSWORD = '$HASH', LOGIN_RIGHTS = '$USER_RIGHTS'
			WHERE LOGIN_USER = '$USER_NAME'";
						
	//Sending the query and catching any errors
	if(!$conn -> query($sql)){
	    $error = $conn -> error;
	    echo $error;
	} else {
	    echo "Success";
	}
	
	//Closing the connection
	closeConn($conn);
?>