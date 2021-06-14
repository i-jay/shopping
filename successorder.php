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
            $pname = $_POST['pname'];
            $pimage = $_POST['pimage'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $total_price = $_POST['total_price'];
            $seller = $_POST['seller'];
            $link = "'/shopping/product.php?pid=$pid'";

            $insert = "INSERT INTO `orders` (`status`, `user_id`, `product_id`, `quantity`, `total_price`, `seller`, `address_id`, `payment_method`, `order_date`, `payment_status`) VALUES ('0', '$user_id', '$pid', '$quantity', '$total_price', '$seller', '$address_id', '$payment_method', current_timestamp(), '1')";
            $insert_result = mysqli_query($conn, $insert);
            
            $del = "DELETE FROM `buynow` WHERE `user_id` = $user_id";
            $del_result = mysqli_query($conn, $del);

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
                <div class="product d-flex my-2 overflow-hidden">
                    <div class="product-photo border-0">
                        <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                            <img src="./admin/<?php echo $pimage;?>" style="width: 100px; object-fit: fill;" class="mx-auto "
                                alt="...">
                        </div>
                    </div>
                    <div class="product-info px-3 py-2">
                        <h5 onclick="location.href=<?php echo $link;?>" style="cursor: pointer;"><?php echo $pname;?> X <?php echo $quantity;?></h5>
                        <p>Seller : <?php echo $seller;?>
                        <h5 class="my-3"> ₹<?php echo $price;?> X <?php echo $quantity;?> = ₹<?php echo $price*$quantity;?></h5>
                    </div>
                </div>
                <hr class="m-1">
                <h4 class="p-2">Total Price : ₹<?php echo $total_price ;?></h4>
            </div> 
        </div>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
  </body>
</html>