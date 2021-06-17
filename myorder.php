<?php
include './assets/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['deleteId'])){
        $deleteId = $_POST['deleteId'];
        $sql2 = "DELETE FROM `orders` WHERE `orders`.`order_id` = $deleteId";
        $result2 = mysqli_query($conn, $sql2);
    
        if ($result2) {
            header('location:myorder.php');
        }
    }

}
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
        .product{
            width:100%;
        }
        .product-item{
            width:70%;
        }
        .orderdate{
            width:30%;
        }
    </style>
</head>

<body>
    <?php include './assets/navbar.php'; 
        $user_id = $_SESSION['userid'];
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){

            $sql = "SELECT * FROM `orders` WHERE `user_id` = '$user_id'" ;
            $sql = "SELECT DISTINCT `order_id` FROM `orders` ORDER BY `order_date` DESC" ;
            $result = mysqli_query($conn, $sql);

        }
        else{
            header('location:login.php');
            }

    ?>

    <!-- delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to cancel this Order?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="myorder.php" method="POST">
                        <input type="hidden" name="deleteId" id="deleteId">
                        <div class="mb-2 ">
                            <p> Order id : <strong><span id="deleteorder"></span></strong></p>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <div class="myorder overflow-hidden">
        <div class="order-list container py-2 px-4">
            <div class="d-flex flex-column">
                <h4>My Orders</h4>
            </div> 
        </div>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $order_id =  $row['order_id'];
                        $sql2 = "SELECT * FROM `orders` WHERE `order_id` = '$order_id'" ;
                        $result2 = mysqli_query($conn, $sql2);
                        
                        echo '<div class="order-list container py-2 px-4"> 
                                <div class="product  d-flex my-2 overflow-hidden flex-column">
                                    <div class="d-flex justify-content-between" >
                                        <h5>Order id: '.$order_id.'</h5>
                                        <h5>Order Date : 15 June 2021</h5>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="del(' . $order_id .')">Cancel Order</button>
                                    </div><hr class="my-1">';
                                    

                        while($row2 = mysqli_fetch_assoc($result2)){
                            $pid = $row2['product_id'];
                            $order_price = $row2['order_total_price'];
                            $link = "'/shopping/orderdetail.php?orderid=$order_id'";
     
                            $sql3 = "SELECT * FROM `products` WHERE `product_id` = $pid";
                            $result3 = mysqli_query($conn, $sql3);
                            
                            $row3 = mysqli_fetch_assoc($result3);
                            $seller = $row3['product_seller'];
                            $pname = $row3['product_name'];
                            $pimage = $row3['product_image'];

                            echo '  <div class="product-item d-flex my-2 overflow-hidden" >
                                        <div class="product-photo border-0">
                                            <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 150px;">
                                                <img src="./admin/'.$pimage.'" style="width: 100px; object-fit: fill;" class="mx-auto "alt="...">
                                            </div>
                                        </div>
                                        <div class="product-info px-3 py-2">
                                            <h5 onclick="location.href='.$link.';" style="cursor: pointer;">'.$pname.'</h5>
                                        </div>
                                    </div> ';         
                        }
                        echo '<hr class="my-1"> <h5 class="px-2 pt-2">Total Price : ' . $order_price . ' </h5></div></div>';
                    }
                ?>          
    </div>
    
    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

        <script>

            function del(id) {
                let row = document.getElementById("row-" + id);
                let deleteorder = document.getElementById("deleteorder");
                deleteorder.innerHTML = id;

                let deleteId = document.getElementById("deleteId");
                deleteId.value = id;
            }

</script>


</body>

</html>