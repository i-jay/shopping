<?php
include './assets/dbconnect.php';
$ptotalprice = 0;
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

        .confirm-button {
            width: 80%;
        }
        

        .form-col .button{
            background: #ffe500;
            color: black;
            width: 100%;
            font-size: 22px;
        }
        .quantitybtn{
            width: 30px;
            height: 30px;
            outline: none;
            border: 1px solid gray;
            border-radius:50%;
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
    </style>
</head>

<body>
    <?php include './assets/navbar.php';
   
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userid =  $_SESSION['userid'];

        $sql = "SELECT * FROM `users` WHERE `user_id` = $userid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $email = $row['email'];
        $phoneno = $row['phone_number'];

    } else {
        header('location:login.php');
    }

    ?>
    <div class="buynow overflow-hidden">
        <div class="left ms-3 my-2 d-inline-block float-start">
            <div class="login d-flex justify-content-between py-2 px-3 my-2">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Login</h4><i class="fa fa-check me-2" style=""></i>
                    <h5 class="mx-2"> <?php echo $row['firstname'] . " " . $row['lastname']; ?>, <?php echo $row['phone_number']; ?></h5>
                </div>
                <div class="d-flex align-items-center">
                    <a href="./login.php" style="font-size: 18px;">Change</a>
                </div>
            </div>

            <div class="order py-2 px-3 my-2">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Order Summary</h4>
                </div>
                <hr class="m-2">

                <?php
                 $sql3 = "SELECT * FROM `buynow` WHERE `user_id` = $user_id";
                 $result3 = mysqli_query($conn, $sql3);
                while($row3 = mysqli_fetch_assoc($result3)){
                    $pid = $row3['product_id'];
                    $product_quantity = $row3['product_quantity'] ;
                    $price = $row3['product_price']; 
                    $total_price = $row3['total_price'];

                    $ptotalprice = $ptotalprice + $total_price;


                    $sql4 = "SELECT * FROM `products` WHERE `product_id` = $pid";
                    $result4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($result4);
            
                    $pname = $row4['product_name'];
                    $pimage = $row4['product_image'];
                    $pseller = $row4['product_seller'];
                    $link = "'/shopping/product.php?pid=$pid'";
                   
                    echo '
                <div class="product d-flex my-3 overflow-hidden">
                    <div class="product-photo border-0">
                        <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                            <img src="./admin/'.$pimage.'" style="width: 90px; object-fit: fill;" class="mx-auto " alt="...">
                        </div>
                    </div>
                    <div class="product-info p-3">
                        <h5 onclick="location.href='.$link.'" style="cursor: pointer;">'.$pname.'</h5>
                        <p>Seller : '.$pseller.'</p>
                        <div class="m-0">
                            <form action="buynowoperation.php" method="post">
                                <input type="hidden" name="pid" value="'.$pid.'">
                                <input type="hidden" name="product_price" value="'.$price.'">
                                <input type="submit" class="quantitybtn" onclick="decrementValue('.$pid.')" value="-" />
                                <input type="text" class="text-center mx-1" name="quantity" value="'.$product_quantity.'" maxlength="2" max="10" size="1" id="number-'.$pid.'" />
                                <input type="submit" class="quantitybtn" onclick="incrementValue('.$pid.')" value="+" />
                            </form>
                        </div>
                    </div>
                    <div class="product-price">
                        <h2 class="my-3 text-center"> ₹'.$total_price.'</h2>
                    </div>

                </div>
                <hr>';
                }
                ?>
                </div>
                <form action="successorder.php" method="post" >
            <div class="address py-2 px-3">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Address</h4>
                </div>
                <hr class="m-2">
                <div class="d-flex flex-column my-2 ps-3">

                    <?php
                    $sql2 = "SELECT * FROM `address` WHERE `user_id` = $userid";
                    $result2 = mysqli_query($conn, $sql2);

                    while ($row2 = mysqli_fetch_assoc($result2)) {

                        echo '<div class="form-check ">
                        <input class="form-check-input" type="radio" name="addresses" id="flexRadioDefault1" value="'.$row2['address_id'].'" required>
                        <label class="form-check-label" for="flexRadioDefault1">
                            <h6 class="m-0">' . $row2['fullname'] . ' , ' . $row2['phone_number'] . '</h6>
                            <p class="m-0">' . $row2['area'] . ', </p>
                            <p class="m-0">' . $row2['city'] . ', ' . $row2['state'] . ' ,' . $row2['pincode'] . ' </p>
                        </label>
                    </div>
                    <hr class="m-2">';
                    }

                    ?>

                    <div class="ms-3">
                        <a href="#">Add new address</a>
                    </div>
                </div>
            </div>
           
               

           
            <div class="payment py-2 px-3 my-2">
                <div class="d-flex align-items-center">
                    <h4 class="mx-2">Payment Options</h4>
                </div>
                <hr class="m-2">
                <div class="d-flex flex-column my-2 ps-3">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault3" value="UPI">
                        <label class="form-check-label active" for="flexRadioDefault3">
                            UPI
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault4" value="Credit / Debit / ATM Card">
                        <label class="form-check-label" for="flexRadioDefault4">
                            Credit / Debit / ATM Card
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault5" value="Net Banking">
                        <label class="form-check-label" for="flexRadioDefault5">
                            Net Banking
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payments" id="flexRadioDefault6" checked value="Cash on Delivery">
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
                <h5>Price</h5>
                <h5> ₹<?php echo $ptotalprice;?></h5>
            </div>
            <div class="d-flex justify-content-between px-3 py-2">
                <h5>Delivery Charges</h5>
                <h5> ₹80</h5>
            </div>
            <hr>
            <div class="d-flex justify-content-between px-3">
                <h5>Total Amount</h5>
                <h5> ₹<?php echo $ptotalprice+80;?></h5>
            </div>
            <div class="form-col my-2 mx-auto confirm-button ">
                <?php
                    $sql4 = "SELECT * FROM `buynow` WHERE `user_id` = $user_id";
                    $result4 = mysqli_query($conn, $sql4);
                    while($row4 = mysqli_fetch_assoc($result4)){
                    echo '<input type="hidden" name="pid[]" value="'.$row4['product_id'].'">';
                    echo '<input type="hidden" name="quantity[]" value="'.$row4['product_quantity'].'">';
                    }
                ?>               
                    <input type="hidden" name="total_price" value="<?php echo $ptotalprice+80;?>">
                <button type="submit" class="btn my-2 button" name="confirm_order" >Confirm Order</button>
            </div>
        </div>
        </form>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
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