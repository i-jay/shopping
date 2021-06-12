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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Hello, world!</title>
  <style>
    body{
      
    }

    .form-control:focus,
    button:focus,
    .remove:focus,
    .empty-cart:focus {
      border-color: rgba(0, 0, 0, 0.8);
      box-shadow: none;
      outline: 0 none;
    }

    button {
      background: #ffe500;
      color: black;
    }

    .navbarsearch {
      width: 450px;
    }

    .cart {
      background: rgb(226, 225, 225);
      min-height:65vh;
    }

    .cart-items {
      background: rgb(255, 255, 255);
      width: 70%;
      border-radius: 10px;
      height:auto;
    }

    .price {
      background: rgb(255, 255, 255);
      width: 25%;
      height: 300px;
      border-radius: 10px;
    }

    .title {
      border-bottom: 1px solid gray;
    }

    .form-col a {
      width: 80%;
      text-align: center;
    }

    .form-col a button {
      background: #ffe500;
      color: black;
      width: 100%;
      font-size: 22px;
    }

    .remove {
      text-decoration: none;
      color: black;
      font-size: 15px;
      cursor: pointer;
      outline:none;
      border:none;
    }

    .remove:hover {
      text-decoration: underline;
      color:blue;
    }
    .empty{
      min-height:55vh;
      width: 100vw;
      background: rgb(255, 255, 255);
      border-radius: 10px;
      margin:20px;
    }

  </style>
</head>

<body>
  <?php include './assets/navbar.php';

    if(isset($_SESSION['productadded']) && $_SESSION['productadded'] == true){
      echo '<div class="m-0 alert alert-warning alert-dismissible fade show" role="alert">
            <strong></strong> Product is already added in cart
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      $_SESSION['productadded'] = null;
    }

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
      $user_id = $_SESSION['userid'];
    
      $sql = "SELECT * FROM `cart` WHERE `user_id` = $user_id";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
    
    }
    else{
      header('location:login.php');
    }

  ?>


  <div class="cart overflow-hidden d-flex">
  
            <?php

                if($num > 0){

                  echo '<div class="cart-items ms-3 my-2">
                            <div class="title d-flex align-items-center justify-content-between py-2 px-3">
                              <h4>My Cart</h4>
                              <form action="cartoperation.php" method="post">
                                <button class="empty-cart btn btn-danger" name="emptycart"> Empty Cart</button>
                              </form>
                            </div>';
                  while($row = mysqli_fetch_assoc($result)){
                    $pid = $row['product_id'];
      
                    $sql2 = "SELECT * FROM `products` WHERE `product_id` = $pid";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
      
                    $pname = $row2['product_name'];
                    $pimage = $row2['product_image'];
                    $price = $row2['product_price'];
                    $pseller = $row2['product_seller'];
                    $link = "'/shopping/product.php?pid=$pid'";
      
                    echo '
                    <div class="product d-flex my-3 overflow-hidden">
                        <div class="product-photo border-0">
                          <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                            <img src="./admin/' . $pimage .'" style="width: 90px; object-fit: fill;" class="mx-auto " alt="...">
                          </div>
                        </div>
                        <div class="product-info px-3 py-2">
                          <h5 onclick="location.href=' . $link .';" style="cursor: pointer;">' . $pname .'</h5>
                          <p>Seller : ' . $pseller .'</p>
                          <h3 class="my-3"> ₹' . $price .'</h3>
                          <form action="cartoperation.php" method="post">
                          <input type="hidden" name="pid" value="' . $pid .  '">
                          <button name="deleteproduct" class="btn btn-sm mt-2 remove">REMOVE</button>
                          </form>
                        </div>
                    </div>
                    <hr>
                   
                    ';
      
                  }
                  echo ' </div><div class="price ms-3 my-2 px-3">
                            <div class="title d-flex align-items-center py-2 px-3">
                              <h4>Price Detail</h4>
                            </div>
                            <div class="d-flex justify-content-between px-3 py-2">
                              <h5>Price (3 items)</h5>
                              <h5> ₹63,690</h5>
                            </div>
                            <div class="d-flex justify-content-between px-3 py-2">
                              <h5>Delivery Charges</h5>
                              <h5> ₹100</h5>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between px-3">
                              <h5>Total Amount</h5>
                              <h5> ₹64,000</h5>
                            </div>
                            <div class="form-col my-2 d-flex justify-content-center">
                              <a href="./buynow.php"> <button type="submit" class="btn my-2">Place Order</button></a>
                              <!-- <button type="submit" class="btn my-2 mx-3">Place Order</button> -->
                            </div>
                            </div>';
                }
                else{
                  echo '<div class="empty d-flex align-items-center justify-content-center flex-column">
                    <h4>Your Cart is Empty.</h4>
                    <a href="./index.php" class="btn btn-primary mt-3">Shopping Now</a>
                    </div>';
                  
                }
            ?>
             </div>
  </div>

  <?php include './assets/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>

</body>

</html>