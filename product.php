<?php
include './assets/dbconnect.php';

    $pid = $_GET['pid'];

    $sql = "SELECT * FROM `products` WHERE `product_id` = $pid";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    $pname = $row['product_name'];
    $pimage = $row['product_image'];
    $price = $row['product_price'];
    $pinfo = $row['product_info'];
   
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    

    <title>Hello, world!</title>
    <style>
      .navbarsearch{
        width: 450px;
      }
      .info{
        width:300px;
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
    <?php include './assets/navbar.php'; ?>

    <div class="product d-flex my-3">

        <div class="product-photo ms-5">
            <div class="card overflow-hidden m-2 " style="width: 400px;">
                <img src="./admin/<?php echo $pimage;  ?>" style="width: 400px; object-fit: fill;"
                    class="card-img-top px-5 py-3 mx-auto" alt="...">
            </div>
            <div class="buttons d-flex justify-content-center" style="width: 400px;">
                <form action="cartoperation.php" method="post">
                  <input type="hidden" name="pid" value="<?php echo $pid;  ?>">
                  <input type="hidden" name="price" value="<?php echo $price;  ?>">
                  <button type="submit" name="addproduct" class="btn btn-primary btn-lg my-1 border-0" style="background: #ffe500; color: black;">Add to Cart</button>
                </form>
                <!-- <a href="./mycart.php" class="btn btn-lg my-1 mx-2 border-0 px-4" style="background: #ffe500; color: black;">Add to
                    Cart</a> -->
                <form action="buynowoperation.php" method="post">
                  <input type="hidden" name="pid" value="<?php echo $pid;  ?>">
                  <input type="hidden" name="price" value="<?php echo $price;  ?>">
                  <button type="submit" name="buynow" class="btn btn-primary btn-lg my-1 mx-2 border-0 px-4" style="background: #ffe500; color: black;">Buy Now</button>
                </form>
        
            </div>
        </div>
        <div class="product-info p-4">
            <h3><?php echo $pname;  ?></h3>
            <h4 class="my-3"> Price : ₹<?php echo $price;  ?></h4>
            <h5 class="my-3">Specification</h5>
            <ul>
                <li class="info"><?php echo $pinfo;  ?></li>
            </ul>
            <h5 class="my-3">Available offers</h5>
            <ul>
                <li>Bank Offer10% off on HDFC Bank Debit and Credit Cards EMI transactions, up to ₹1000. On Orders of
                    ₹5000 T&C</li>
                <li>Bank Offer5% Unlimited Cashback on Flipkart Axis Bank Credit CardT&C</li>
                <li>Bank Offer10% Off on Bank of Baroda Mastercard debit card first time transaction, Terms and
                    Condition applyT&C</li>
            </ul>
            <h5 class="my-2">Easy Payment Options</h5>
            <ul>
                <li>No cost EMI</li>
                <li>Cash on Delivery</li>
                <li>Net banking & Credit/ Debit/ ATM card</li>
            </ul>
        </div>

    </div>

    <div class=" overflow-hidden mx-5">
        <h2 class="text-center my-4">Similar Products</h2>
        <div class="d-flex m-2 flex-wrap justify-content-around">

          <div class="card overflow-hidden m-2 " style="width: 190px;">
            <img src="images/mi2.jpeg" style="width: 180px; object-fit: fill;" class="card-img-top px-5 pt-3 mx-auto" alt="...">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
              <h6 class="card-title text-center"><b>Redmi Note 9 Pro</b></h6>
              <h6>Price : 15999/-</h6>
              <a href="./product.php" class="btn btn-primary my-1 border-0" style="background: #ffe500; color: black;">Buy Now</a>
            </div>
          </div>
          <div class="card overflow-hidden m-2 " style="width: 190px;">
            <img src="images/s1.jpeg" style="width: 180px; object-fit: fill;" class="card-img-top px-5 pt-3 mx-auto" alt="...">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
              <h6 class="card-title text-center"><b>Samsung Galaxy M31</b></h6>
              <h6>Price : 15999/-</h6>
              <a href="./product.php" class="btn btn-primary my-1 border-0" style="background: #ffe500; color: black;">Buy Now</a>
            </div>
          </div>
          <div class="card overflow-hidden m-2 " style="width: 190px;">
            <img src="images/a1.jpeg" style="width: 180px; object-fit: fill;" class="card-img-top px-5 pt-3 mx-auto" alt="...">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
              <h6 class="card-title text-center"><b>Apple iPhone 12</b></h6>
              <h6>Price : 15999/-</h6>
              <a href="./product.php" class="btn btn-primary my-1 border-0" style="background: #ffe500; color: black;">Buy Now</a>
            </div>
          </div>
          <div class="card overflow-hidden m-2 " style="width: 190px;">
            <img src="images/o1.jpeg" style="width: 180px; object-fit: fill;" class="card-img-top px-5 pt-3 mx-auto" alt="...">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
              <h6 class="card-title text-center"><b>Oppo A12</b></h6>
              <h6>Price : 15999/-</h6>
              <a href="./product.php" class="btn btn-primary my-1 border-0" style="background: #ffe500; color: black;">Buy Now</a>
            </div>
          </div>
          <div class="card overflow-hidden m-2 " style="width: 190px;">
            <img src="images/r1.jpeg" style="width: 180px; object-fit: fill;" class="card-img-top px-5 pt-3 mx-auto" alt="...">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
              <h6 class="card-title text-center"><b>Realme Narzo 30A</b></h6>
              <h6>Price : 15999/-</h6>
              <a href="./product.php" class="btn btn-primary my-1 border-0" style="background: #ffe500; color: black;">Buy Now</a>
            </div>
          </div>
        </div>
    </div>    
        
    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>