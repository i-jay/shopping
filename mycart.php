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
    button:focus {
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
    }

    .cart-items {
      background: rgb(255, 255, 255);
      width: 70%;
      border-radius: 10px;
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
    }

    .remove:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <?php include './assets/navbar.php'; ?>


  <div class="cart overflow-hidden d-flex">
    <div class="cart-items ms-3 my-2">
      <div class="title d-flex align-items-center py-2 px-3">
        <h4>My Cart</h4>
      </div>
      <div class="product d-flex my-3 overflow-hidden">
        <div class="product-photo border-0">
          <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
            <img src="images/mobile1.jpeg" style="width: 60px; object-fit: fill;" class="mx-auto " alt="...">
          </div>
        </div>
        <div class="product-info px-3 py-2">
          <h5 onclick="location.href='/shopping/product.php';" style="cursor: pointer;">Redmi Note 10 Pro (Vintage
            Bronze, 128 GB) (8 GB RAM)</h5>
          <p>Seller : Amazon</p>
          <h3 class="my-3"> ₹21,690</h3>
          <a class="mt-2 remove">Remove</a>
        </div>

      </div>
      <hr>
      <div class="product d-flex my-3 overflow-hidden">
        <div class="product-photo border-0">
          <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
            <img src="images/mobile1.jpeg" style="width: 60px; object-fit: fill;" class="mx-auto " alt="...">
          </div>
        </div>
        <div class="product-info px-3 py-2">
          <h5 onclick="location.href='/shopping/product.php';" style="cursor: pointer;">Redmi Note 10 Pro (Vintage
            Bronze, 128 GB) (8 GB RAM)</h5>
          <p>Seller : Amazon</p>
          <h3 class="my-3"> ₹21,690</h3>
          <a class="mt-2 remove">Remove</a>
        </div>

      </div>
      <hr>
      <div class="product d-flex my-3 overflow-hidden">
        <div class="product-photo border-0">
          <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
            <img src="images/mobile1.jpeg" style="width: 60px; object-fit: fill;" class="mx-auto " alt="...">
          </div>
        </div>
        <div class="product-info px-3 py-2">
          <h5 onclick="location.href='/shopping/product.php';" style="cursor: pointer;">Redmi Note 10 Pro (Vintage
            Bronze, 128 GB) (8 GB RAM)</h5>
          <p>Seller : Amazon</p>
          <h3 class="my-3"> ₹21,690</h3>
          <a class="mt-2 remove">Remove</a>
        </div>

      </div>
    </div>
    <div class="price ms-3 my-2 px-3">
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
    </div>
  </div>

  <?php include './assets/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>

</body>

</html>