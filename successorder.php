<?php
include './assets/dbconnect.php';
   
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Hello, world!</title>
      <style>
    .form-control:focus,button:focus {
        border-color: rgba(0, 0, 0, 0.8);
        box-shadow: none;
        outline: 0 none;
    }
    button{
      background: #ffe500; 
      color: black;
      padding: 8px;
      border-radius: 5px;
      outline: none;
      border: none;
    }
    .navbarsearch{
      width: 450px;
    }
    .successorder {
      background: rgb(226, 225, 225);
      margin: 0;
    }
    .placed,.address , .order-detail {
      background: rgb(255, 255, 255);
      margin: 15px auto;
      border-radius: 8px;
    }
    .icons{
            position: relative;
        }
    .cartnumber[data-count]:after{
        width: 25px;
        height: 25px;
        position:absolute;
        right:-10px;
        top:-17px;
        content: attr(data-count);
        font-size:15px;
        padding:2px;
        border-radius:50%;
        color: black;
        background:#ffe500;
        text-align:center;
    }
</style>
  </head>
  <body>
    <?php include './assets/navbar.php';
      $user_id = $_SESSION['userid'];
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])){

            $address_id = $_POST['addresses'];
            $payment_method = $_POST['payments'];
            $pid = $_POST['pid'];
            $quantity = $_POST['quantity'];
            $total_price = $_POST['total_price'];
            $order_id = rand(24738,94525);

            function checkOrderId($order_id, $conn){
              $search = "SELECT * FROM `orders` WHERE `order_id` = '$order_id'";
              $result = mysqli_query($conn, $search);
              $num = mysqli_num_rows($result);
              if($num > 0){
                $order_id = rand(24738,94525);
                checkOrderId($order_id, $conn);
              }else{
                return $order_id;
              }
            }

            checkOrderId($order_id, $conn);
 
            $pid_length = count($pid);   
            for($x=0; $x<$pid_length ; $x++){
    
                $product_id = $pid[$x];
                $product_quantity = $quantity[$x];
                
                $insert = "INSERT INTO `orders` (`order_id`,`status`, `user_id`, `product_id`, `quantity`, `order_total_price`, `address_id`, `payment_method`, `order_date`, `payment_status`) VALUES ('$order_id','0', '$user_id', '$product_id', '$product_quantity', '$total_price', '$address_id', '$payment_method', current_timestamp(), '1')";
                $insert_result = mysqli_query($conn, $insert);
            } 

            $del = "DELETE FROM `buynow` WHERE `user_id` = $user_id";
            $del_result = mysqli_query($conn, $del);

            $del_cart = "DELETE FROM `cart` WHERE `user_id` = $user_id";
            $del_cart_result = mysqli_query($conn, $del_cart);

      }
      else{
        header('location:login.php');
        }
      }
    ?>

    <div class="successorder overflow-hidden"> 
        <div class="placed container py-4 px-4 d-flex justify-content-between">
            <h4>Order Placed</h4>
            <a href="./myorder.php" class="pe-5"><button type="submit" class="mx-3 bg-primary text-light">Go to My Orders</button> </a>
        </div>
        <div class="address container py-2 px-4">
            <div class="d-flex flex-column">
                <h4>Delivery Address</h4>
                <?php

                    $sql2 = "SELECT * FROM `address` WHERE `address_id` = $address_id";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);

                    ?>

                <div class="d-flex">
                    <div class="d-flex flex-column mt-2 me-5">
                        <h6 class="my-1"><?php echo $row2['fullname'];?>, <?php echo $row2['phone_number'];?></h6>
                        <p class="mb-1"><?php echo $row2['area'];?>,</p>
                        <p class="mb-1"><?php echo $row2['city'];?>, <?php echo $row2['state'];?>, <?php echo $row2['pincode'];?> </p>
                    </div> 
                    <div class="mx-5 mt-2"> 
                        <h6>Delivery Expected by 15 August</h6>
                    </div>
                </div>
            </div> 
        </div>
        <div class="order-detail container py-2 px-4">
            <div class="d-flex flex-column">
                <h4>Order Detail</h4>
                <?php 
                   $sql4 = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
                   $result4 = mysqli_query($conn, $sql4);
                while($row4 = mysqli_fetch_assoc($result4)){
                  $pid = $row4['product_id'];
                  $product_quantity = $row4['quantity'] ;
                  $total_price = $row4['order_total_price'];

              
                  $sql5 = "SELECT * FROM `products` WHERE `product_id` = $pid";
                  $result5 = mysqli_query($conn, $sql5);
                  $row5 = mysqli_fetch_assoc($result5);
          
                  $pname = $row5['product_name'];
                  $pimage = $row5['product_image'];

                  $link = "'/shopping/product.php?pid=$pid'";
                
                  echo '<div class="product d-flex my-2 overflow-hidden">
                  <div class="product-photo border-0">
                      <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                          <img src="./admin/'.$pimage.'" style="width: 80px; object-fit: fill;" class="mx-auto "
                              alt="...">
                      </div>
                  </div>
                  <div class="product-info px-3 py-2">
                      <h5>'.$pname.' X '.$product_quantity.'</h5>
                      
                  </div>
              </div>
              <hr class="m-1">'; }
                ?>
                <h4 class="p-2">Total Price : ₹<?php echo $total_price ;?></h4>
            </div> 
        </div>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
  </body>
</html>