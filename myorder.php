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

    <title>My Orders</title>
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

        .myorder {
            background: rgb(226, 225, 225);
        }

        .order-list {
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

            $sql = "SELECT * FROM `orders` WHERE `user_id` = '$user_id'" ;
            $result = mysqli_query($conn, $sql);

        }
        else{
            header('location:login.php');
            }

    ?>

    <div class="myorder overflow-hidden">
        <div class="order-list container py-2 px-4">
            <div class="d-flex flex-column">
                <h4>My Orders</h4> <hr class="my-1">

                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $pid = $row['product_id'];
                        $order_id = $row['order_id'];
                        $link = "'/shopping/orderdetail.php?orderid=$order_id'";
                        $total_price = $row['total_price'];
                        $seller = $row['seller'];

                        $sql2 = "SELECT * FROM `products` WHERE `product_id` = $pid";
                        $result2 = mysqli_query($conn, $sql2);
                    
                        $row2 = mysqli_fetch_assoc($result2);
                    
                        $pname = $row2['product_name'];
                        $pimage = $row2['product_image'];
                       
                        echo '<div class="product d-flex my-2 overflow-hidden flex-column">
                        <h5>Order id: '.$order_id.'</h5>
                        <div class="product d-flex my-2 overflow-hidden" >
                            <div class="product-photo border-0">
                                <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                                    <img src="./admin/'.$pimage.'" style="width: 100px; object-fit: fill;" class="mx-auto "
                                        alt="...">
                                </div>
                            </div>
                            <div class="product-info px-3 py-2">
                                <h5 onclick="location.href='.$link.';" style="cursor: pointer;">'.$pname.'</h5>
                                <p>Seller : '.$seller.'</p>
                                <h3 class="my-3"> ₹'.$total_price.'</h3>
                            </div>
                            <div class="px-3 py-2 ps-5">
                                <h5>Order Date : 15 June 2021</h5>
                                <h6 class="text-primary my-3" style="cursor: pointer;"><i class="fa fa-times"></i> Cancle</h6>
                            </div>
                        </div>
                    </div> <hr class="my-1">
                        ';

                    }
                ?>
                
                
                
            </div>
        </div>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>