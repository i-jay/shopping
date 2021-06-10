<?php

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

        .buynow {
            background: rgb(226, 225, 225);
        }

        .left {
            width: 70%;
        }

        .login,
        .address,
        .order,
        .payment {
            background: rgb(255, 255, 255);
            width: 100%;
            border-radius: 10px;
        }

        .right {
            background: rgb(255, 255, 255);
            width: 25%;
            height: 300px;
            border-radius: 10px;
        }

        .title {
            border-bottom: 1px solid gray;
        }
        .form-col a{
            width: 80%;
            text-align: center;
        }

        .form-col a button {
            background: #ffe500;
            color: black;
            width: 100%;
            font-size: 22px;
        }
    </style>
</head>

<body>
    <?php include './assets/navbar.php';
    if(!isset($_SESSION['loggedin'])){
        header('location:login.php'); 
      }
    ?>

    <div class="buynow overflow-hidden">
        <div class="left ms-3 my-2 d-inline-block float-start">
            <div class="login d-flex justify-content-between py-2 px-3 my-2">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Login</h4><i class="fa fa-check me-2" style=""></i>
                    <h6 class="mx-2">Shyam Odedra, 1234567890</h6>
                </div>
                <div class="d-flex align-items-center">
                    <a href="./login.php" style="font-size: 18px;">Change</a>
                </div>
            </div>
            <div class="address py-2 px-3">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Address</h4>
                </div><hr class="m-2">
                <div class="d-flex flex-column my-2 ps-3">
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="addresses" id="flexRadioDefault1" checked="">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <h6 class="m-0">Shyam Odedra , 123456789</h6>
                            <p class="m-0">Porbandar, Gujarat ,360579 </p>
                        </label>
                    </div>
                    <hr class="m-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="addresses" id="flexRadioDefault2"
                            checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            <h6 class="m-0">Jay Parmar, 12346790</h6>
                            <p class="m-0">Gec sector 28 gandhinagar,382028</p>
                        </label>
                    </div>
                    <hr class="m-2">
                    <div class="ms-3">
                        <a href="#">Add new address</a>
                    </div>
                </div>
            </div>
            <div class="order py-2 px-3 my-2">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Order Summary</h4>
                </div><hr class="m-2">
                <div class="product d-flex my-3 overflow-hidden">
                    <div class="product-photo border-0">
                        <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                            <img src="images/mobile1.jpeg" style="width: 60px; object-fit: fill;" class="mx-auto "
                                alt="...">
                        </div>
                    </div>
                    <div class="product-info px-3 py-2">
                        <h5 onclick="location.href='/shopping/product.php';" style="cursor: pointer;">Redmi Note 10 Pro
                            (Vintage
                            Bronze, 128 GB) (8 GB RAM)</h5>
                        <p>Seller : Amazon</p>
                        <h3 class="my-3"> ₹21,690</h3>
                        <a class="mt-2 remove" href="#">Remove</a>
                    </div>

                </div>
            </div>
            <div class="payment py-2 px-3 my-2">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Payment Options</h4>
                </div><hr class="m-2">
                <div class="d-flex flex-column my-2 ps-3">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault3" checked="">
                        <label class="form-check-label active" for="flexRadioDefault3">
                            UPI
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault4"
                            checked>
                        <label class="form-check-label" for="flexRadioDefault4">
                            Credit / Debit / ATM Card
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault5"
                            checked>
                        <label class="form-check-label" for="flexRadioDefault5">
                            Net Banking
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault6"
                            checked>
                        <label class="form-check-label" for="flexRadioDefault6">
                            Cash on Delivery
                        </label>
                    </div>
                </div>
               
            </div>

        </div>
        <div class="right ms-3 my-2 my-3 d-inline-block">
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
               <a href="./successorder.php"> <button type="submit" class="btn my-2">Confirm Order</button></a>
            </div>
        </div>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>