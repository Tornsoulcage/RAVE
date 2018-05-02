<?php
// Just echos whatever the current session rights are
session_start();

//echo "ADMIN";
echo $_SESSION["USER_RIGHTS"];
?>