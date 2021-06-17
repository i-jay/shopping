<?php
include '../assets/dbconnect.php';
session_start();
session_destroy();
header('location:adminlogin.php') ;
exit;
