<?php
include '../assets/dbconnect.php';
session_start();
session_destroy();
header('location:sellerlogin.php') ;
exit;
