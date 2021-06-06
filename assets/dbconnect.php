<?php

$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "shopping";

$conn = mysqli_connect($servername, $db_username, $db_password, $database);

if($conn){
    // echo "Database Connected";
}

?>