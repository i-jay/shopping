<?php
include './assets/dbconnect.php';

    $sql = "SELECT * FROM `products`";
    $result = mysqli_query($conn, $sql);
   
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

  <title>Shopping</title>

  <style>
    html{
      scroll-behavior: smooth;
    }
    .form-control:focus,
    button:focus {
        border-color: rgba(0, 0, 0, 0.8);
        box-shadow: none;
        outline: 0 none;
    }
    button{
      background: #ffe500; 
      color: black;
    }
    .navbarsearch{
      width: 450px;
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


      <div id="carouselExampleIndicators" class="carousel slide mx-2 my-2 rounded-2" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/banner13.jpg" style="heixght: 300px; width: 1500px; object-fit: cover;" class="d-block w-100 rounded-2" alt="...">
          </div>
          <div class="carousel-item">
            <img src="images/banner12.jpg"  style="height: 300px; width: 1500px; object-fit: cover;" class="d-block w-100 rounded-2" alt="...">
          </div>
          <div class="carousel-item">
            <img src="images/banner13.jpg"  style="height: 300px; width: 1500px; object-fit: cover;" class="d-block w-100 rounded-2" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div class="d-flex container my-3 flex-wrap justify-content-between">
        <div class="card text-white mx-2 overflow-hidden" onclick="location.href='search.php?pcatid=1';" style="cursor: pointer;">
          <img src="images/mobiles.jpg" style="height: 100px; width: 200px; object-fit: fill;" class="card-img" alt="...">
          <div class="card-img-overlay d-flex align-items-center justify-content-center">
            <h4 class="card-title .fs-6 text-center mt-3 bg-light text-dark p-1 d-inline-block rounded-2 px-2">Mobiles</h4>
          </div>
        </div>
        <div class="card text-white mx-2 overflow-hidden" onclick="location.href='search.php?pcatid=4';" style="cursor: pointer;">
          <img src="images/fashion.jpg" style="height: 100px; width: 200px; object-fit: fill;" class="card-img" alt="...">
          <div class="card-img-overlay d-flex align-items-center justify-content-center">
            <h4 class="card-title .fs-6 text-center mt-3 bg-light text-dark p-1 d-inline-block rounded-2 px-2">Fashion</h4>
          </div>
        </div>
        <div class="card text-white mx-2 overflow-hidden" onclick="location.href='search.php?pcatid=3';" style="cursor: pointer;">
          <img src="images/gaming.jpg" style="height: 100px; width: 200px; object-fit: fill;" class="card-img" alt="...">
          <div class="card-img-overlay d-flex align-items-center justify-content-center">
            <h4 class="card-title .fs-6 text-center mt-3 bg-light text-dark p-1 d-inline-block rounded-2 px-2">Gaming</h4>
          </div>
        </div>
        <div class="card text-white mx-2 overflow-hidden" onclick="location.href='search.php?pcatid=5';" style="cursor: pointer;">
          <img src="images/sports.jpg" style="height: 100px; width: 200px; object-fit: fill;" class="card-img" alt="...">
          <div class="card-img-overlay d-flex align-items-center justify-content-center">
            <h4 class="card-title .fs-6 text-center mt-3 bg-light text-dark p-1 d-inline-block rounded-2 px-2">Sports</h4>
          </div>
        </div>
        <div class="card text-white mx-2 overflow-hidden" onclick="location.href='search.php?pcatid=2';" style="cursor: pointer;">
          <img src="images/laptop.jpg" style="height: 100px; width: 200px; object-fit: fill;" class="card-img" alt="...">
          <div class="card-img-overlay d-flex align-items-center justify-content-center">
            <h4 class="card-title .fs-6 text-center mt-3 bg-light text-dark p-1 d-inline-block rounded-2 px-2">Laptops</h4>
          </div>
        </div>
       
      </div>

      <div class=" overflow-hidden mx-5">
        <h2 class="text-center my-4">Products</h2>
        <div class="d-flex m-2 flex-wrap justify-content-center">

        <?php

            while ($row = mysqli_fetch_assoc($result)) {
              $pname = $row['product_name'];
              $pimage = $row['product_image'];
              $price = $row['product_price'];
              $pid = $row['product_id'];
              $link = "'/shopping/product.php?pid=$pid'";

              echo '<div class="card overflow-hidden m-2 mx-3" style="width:240px" >
              <div onclick="location.href='. $link .'" style="cursor: pointer" class="d-flex align-items-center justify-content-center flex-column">
                <img src="./admin/'. $pimage .'" style="width: 220px;height:200px;  object-fit: fill;" class="card-img-top px-5 pt-3 mx-auto" alt="...">
                <div class="card-body d-flex align-items-center justify-content-center flex-column p-3">
                  <h6 class="card-title text-center"><b>' . $pname .'</b></h6>
                  <h6>Price : ' . $price . '/-</h6>
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-center mb-2">
              <form action="cartoperation.php" method="post">
              <input type="hidden" name="pid" value="' . $pid .  '">
              <input type="hidden" name="price" value="' . $price .  '">
              <button type="submit" name="addproduct" class="btn btn-primary my-1 border-0" style="background: #ffe500; color: black;">Add to Cart</button>
                </form>
              </div>
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