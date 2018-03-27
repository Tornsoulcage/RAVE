<?php
    //Opening connection to the database
    include ('db_connection.php');
    $conn = openConn();

    //Grabbing all of the information from text boxes
    $VEHICLE_ID = $_POST["vid"];
    $MAINTENANCE_REPAIR_ID = $_POST["mid"];
    $LABOR_CODES = $_POST["laborCodes"];
    $MAINTENANCE_DATE = $_POST["mainDate"];
    $MAINTENANCE_MILEAGE = $_POST["mileage"];
    $MAINTENANCE_MECHANIC = $_POST["mechanic"];
    $MAINTENANCE_APPOINTMENT = $_POST["workType"];
    $MAINTENANCE_SPECIAL_WORK = $_POST["specialWork"];
    $MAINTENANCE_PARTS_COST = $_POST["partsCost"];
    $MAINTENANCE_LABOR_COST = $_POST["laborCost"];


    //Putting it all in into one long string for the query
    $sql = "UPDATE MAINTENANCE
            SET VEHICLE_ID = '$VEHICLE_ID',
                MECHANIC_ID = '$MAINTENANCE_MECHANIC', 
                MAINTENANCE_LABOR_CODE = '$LABOR_CODES', 
                MAINTENANCE_DATE = '$MAINTENANCE_DATE',
                MAINTENANCE_APPOINTMENT = '$MAINTENANCE_APPOINTMENT', 
                VEHICLE_MILEAGE = '$MAINTENANCE_MILEAGE',
                MAINTENANCE_REASON = '$MAINTENANCE_SPECIAL_WORK',
                MAINTENANCE_PARTS_COST = '$MAINTENANCE_PARTS_COST', 
                MAINTENANCE_LABOR_COST = '$MAINTENANCE_LABOR_COST'
            WHERE MAINTENANCE_REPAIR_ID = '$MAINTENANCE_REPAIR_ID' ";

    //Sending the query to the database and catching any errors to display
    if(!$conn -> query($sql)){
        $error = $conn -> error;
        echo $error;
    } else {
        //Changing the mileage for the vehicle in question
        $sql = "UPDATE VEHICLE
                SET VEHICLE_MILEAGE = '$MAINTENANCE_MILEAGE'
                WHERE VEHICLE_ID = '$VEHICLE_ID'";
        
        //Sending the query
        $conn -> query($sql);
        
        echo "Success";
    }

    //Closing the connection
    closeConn($conn);
?>