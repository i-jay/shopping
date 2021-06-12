<?php
include './assets/dbconnect.php';
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addproduct'])){
        $pid = $_POST['pid'];
        $user_id = $_SESSION['userid'];
        $quantity = 1;

        $sql = "SELECT * FROM `cart` WHERE `Product_id` = $pid AND `user_id` = $user_id";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if($num == 0){
            $sql2 = "INSERT INTO `cart` (`user_id`, `product_id`, `product_quantity`) VALUES (' $user_id', '$pid', ' $quantity')";
            $result2 = mysqli_query($conn, $sql2);
    
            if($result2){
                header('location:index.php');
            }
        }
        else{
            session_start();
            $_SESSION['productadded'] = true;
            header('location:mycart.php');
        }

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteproduct'])){
        $pid = $_POST['pid'];
        $user_id = $_SESSION['userid'];

        $sql = "DELETE FROM `cart` WHERE `Product_id` = $pid AND `user_id` = $user_id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location:mycart.php');
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['emptycart'])){
        $user_id = $_SESSION['userid'];

        $sql = "DELETE FROM `cart` WHERE `user_id` = $user_id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location:mycart.php');
        }
    }

}
else{
    header('location:login.php');
}


?>