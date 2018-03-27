<?php

// Opens a connection to the database using root login
function openConn()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "edenbay";
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection Error: %s\n" . $conn->error);
    return $conn;
}

// Closes the connection to the database
function closeConn($conn)
{
    $conn->close();
}
?>
