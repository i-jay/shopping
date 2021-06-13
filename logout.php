<?php
include './assets/dbconnect.php';
session_start();
$user_id = $_SESSION['userid'];
$sql = "DELETE FROM `buynow` WHERE `user_id` = $user_id";
$result = mysqli_query($conn, $sql);
session_destroy();

header('location:index.php') ;
exit;
