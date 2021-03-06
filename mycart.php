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

    .cart-content{
      min-height:61vh;
    }

    .cart {
      background: rgb(226, 225, 225);
      height:auto;
    }

    .cart-items {
      background: rgb(255, 255, 255);
      width: 70%;
      border-radius: 10px;
      height:auto;
    }
    .product{
      position: relative;
    }

    .product-info{
      width: 600px;
    }

    .product-price{
      position:absolute;
      right:40px;
      top:0px;
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

    .form-col .placeorder {
      width: 80%;
      text-align: center;
    }

    .form-col .placeorder {
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
    .quantitybtn{
      width: 30px;
      height: 30px;
      outline: none;
      border: 1px solid gray;
      border-radius:50%;
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
     $ptotalprice = 0;

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

<div class="cart-content overflow-hidden">
  <div class="cart overflow-hidden d-flex">
  
            <?php

               
                if($num > 0){

                  echo '<div class="cart-items ms-3 my-2 overflow-hidden">
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

                    $sql3 = "SELECT * FROM `cart` WHERE `Product_id` = $pid AND `user_id` = $user_id";
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);

                    $ptotalprice = $ptotalprice + $row3['total_price'];

                    echo '<div class="product d-flex my-3 overflow-hidden">
                              <div class="product-photo border-0" >
                                  <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                                      <img src="./admin/'. $pimage .'" style="width: 90px; object-fit: fill;"
                                          class="mx-auto " alt="...">
                                  </div>
                              </div>
                              <div class="product-info p-3">
                                  <h5 onclick="location.href=' . $link .';" style="cursor: pointer;">' . $pname .'</h5>
                                  <p>Seller : ' . $pseller .'</p>
                                  <div class="m-0">
                                  <form action="cartoperation.php" method="post">
                                    <input type="hidden" name="pid" value="' . $pid .  '">
                                    <input type="hidden" name="product_price" value="' . $price .  '">
                                    <input type="submit" class="quantitybtn" onclick="decrementValue(' . $pid .  ')" value="-" />
                                    <input type="text" class="text-center mx-1" name="quantity" value="' . $row3['product_quantity'] . '" maxlength="2" max="10" size="1" id="number-' . $pid .  '" />
                                    <input type="submit" class="quantitybtn" onclick="incrementValue(' . $pid .  ')" value="+" />
                                    </form>
                                    <form action="cartoperation.php" method="post">
                                        <input type="hidden" name="pid" value="' . $pid .  '">
                                        <button name="deleteproduct" class="btn btn-sm mt-2 remove">REMOVE</button>
                                    </form>
                                  </div>
                              </div>';

                             echo '<div class="product-price">
                                <h2 class="my-3 text-center"> ???' . $row3['total_price'] . '</h2>
                             </div>
                              
                          </div> <hr>';   
      
                  }
                  echo ' </div><div class="price ms-3 my-2 px-3">
                            <div class="title d-flex align-items-center py-2 px-3">
                              <h4>Price Detail</h4>
                            </div>
                            <div class="d-flex justify-content-between px-3 py-2">
                              <h5>Price</h5>
                              <h5> ???'. $ptotalprice .'</h5>
                            </div>
                            <div class="d-flex justify-content-between px-3 py-2">
                              <h5>Delivery Charges</h5>
                              <h5> ???80</h5>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between px-3">
                              <h5>Total Amount</h5>
                              <h5> ???' . $ptotalprice + 80 . '</h5>
                            </div>
                            <div class="form-col my-2 d-flex justify-content-center">
                              <form action="buynowoperation.php" method="post">';

                              $sql4 = "SELECT * FROM `cart` WHERE `user_id` = $user_id";
                              $result4 = mysqli_query($conn, $sql4);
                              while($row4 = mysqli_fetch_assoc($result4)){
                                echo '<input type="hidden" name="pid[]" value="'.$row4['product_id'].'">';
                                echo '<input type="hidden" name="quantity[]" value="'.$row4['product_quantity'].'">';
                                echo '<input type="hidden" name="price[]" value="'.$row4['product_price'].'">';
                            }
                                  echo '
                                  <button type="submit" name="placeorder" class="placeorder btn btn-primary btn-lg my-1 mx-2 border-0 px-4" style="background: #ffe500; color: black;">Place Order</button>
                              </form>
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

    <script type="text/javascript">
function incrementValue(n)
{
    var value = parseInt(document.getElementById("number-"+n).value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<10){
        value++;
            document.getElementById("number-"+n).value = value;
    }
}
function decrementValue(n)
{
    var value = parseInt(document.getElementById("number-"+n).value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>1){
        value--;
            document.getElementById("number-"+n).value = value;
    }

}
</script>

</body>

</html>