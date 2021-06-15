<?php
include './assets/dbconnect.php';
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buynow'])){
        $pid = $_POST['pid'];
        $user_id = $_SESSION['userid'];
        $quantity = 1;
        $price = $_POST['price'];

        $del = "DELETE FROM `buynow` WHERE `user_id` = $user_id";
        $del_result = mysqli_query($conn, $del);

        $sql2 = "INSERT INTO `buynow` (`user_id`, `product_id`, `product_quantity`, `product_price`, `total_price`) VALUES (' $user_id', '$pid', ' $quantity', '$price', '$price')";
        $result2 = mysqli_query($conn, $sql2);
        if($result2){
            header('location:buynow.php');
        }

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['placeorder'])){

        $user_id = $_SESSION['userid'];
      
        $del = "DELETE FROM `buynow` WHERE `user_id` = $user_id";
        $del_result = mysqli_query($conn, $del);

        $pid = $_POST['pid'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $pid_length = count($pid);   
        for($x=0; $x<$pid_length ; $x++){

            $product_id = $pid[$x];
            $product_quantity = $quantity[$x];
            $product_price = $price[$x];
            $total_price = $product_quantity *  $product_price ;

            $sql2 = "INSERT INTO `buynow` (`user_id`, `product_id`, `product_quantity`, `product_price`, `total_price`) VALUES (' $user_id', '$product_id', ' $product_quantity', '$product_price', '$total_price')";
            $result2 = mysqli_query($conn, $sql2);
        }   
        header('location:buynow.php');

    }


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])){
        $user_id = $_SESSION['userid'];
        $quantity = $_POST['quantity'];
        $pid = $_POST['pid'];
        $product_price = $_POST['product_price'];
        $total_price = $product_price * $quantity;
        

        $sql = "UPDATE `buynow` SET `product_quantity` = '$quantity', `total_price` = '$total_price' WHERE `Product_id` = $pid AND `user_id` = $user_id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location:buynow.php');
        }
    }

}
else{
    header('location:login.php');
}


?>