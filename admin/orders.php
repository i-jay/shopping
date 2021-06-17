<?php
include '../assets/dbconnect.php';

session_start();
$username = $_SESSION['username'];

if(!isset($_SESSION['adminloggedin'])){
    header('location:adminlogin.php');
}

$sql = "SELECT * FROM `orders`";
$result = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['deleteId'])){
        $deleteId = $_POST['deleteId'];
        $sql2 = "DELETE FROM `orders` WHERE `orders`.`order_id` = $deleteId";
        $result2 = mysqli_query($conn, $sql2);
    
        if ($result2) {
            header('location:orders.php');
            
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Shopping </title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        crossorigin="anonymous"></script>

    <style>
        .sidebarlink {
            border-radius: 10px;
        }

        .sidebarlink:hover {
            background: rgb(75, 75, 247);
        }

        .form-control:focus,
        .btn:focus,
        .searchbtn:focus,
        .logoutbtn:focus {
            border-color: rgba(0, 0, 0, 0.8);
            box-shadow: none;
            /* outline: 0 none; */
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

<body class="sb-nav-fixed">

    <!-- delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this Order?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="../admin/orders.php" method="POST">
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

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Shopping</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 bg-primary px-2" id="sidebarToggle" href="#!"
            style="background: ; "><i class="fas fa-bars" style="font-size: 25px; color: white;"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-4 me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary searchbtn" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-auto me-3 me-lg-4">
            <li class="d-flex align-items-center me-5"><a href="../index.php"
                    class="btn btn-primary btn-sm logoutbtn">Go to Website</a></li>
            <li class="d-flex align-items-center ms-2">
                <a class="nav-link me-2" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user me-2"></i> <?php echo $username; ?></a>
                <a href="./adminlogout.php" class="btn btn-primary btn-sm logoutbtn">Logout</a>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link sidebarlink mx-2 mt-4" href="index.php">
                            <i class="fas fa-home me-2"></i>
                            Dashboard
                        </a>
                        <a class="nav-link sidebarlink mx-2" href="products.php">
                            <i class="fas fa-box me-2"></i>
                            Products
                        </a>
                        <a class="nav-link sidebarlink mx-2" href="categories.php">
                            <i class="fas fa-clipboard-list me-2"></i>
                            Categories
                        </a>
                        <a class="nav-link sidebarlink mx-2" href="users.php">
                            <i class="fas fa-user me-2"></i>
                            Users
                        </a>
                        <a class="nav-link sidebarlink mx-2" href="sellers.php">
                            <i class="fas fa-store me-2"></i>
                            Sellers
                        </a>
                        <a class="nav-link sidebarlink mx-2" href="orders.php">
                            <i class="fas fa-shopping-bag me-2"></i>
                            Orders
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!-- content code here -->
                    <h3 class="mt-4"> Orders </h3>

                    <div class="card my-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Orders
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Order id</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $srno = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $order_id = $row['order_id'];
                                            $product_id = $row['product_id'];
                                            $quantity = $row['quantity'];
                                            $total_price = $row['order_total_price'];
                                            $status = $row['status'];
                                            $srno = $srno + 1;

                                            $sql3 = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
                                            $result3 = mysqli_query($conn, $sql3);
                                            $row3 = mysqli_fetch_assoc($result3);
                                            $productname = $row3['product_name'];

                                            echo '  <tr id= "row-' . $order_id . '">
                                                        <td>' . $srno .'</td>
                                                        <td>' . $order_id .'</td>
                                                        <td>' . $productname .'</td>
                                                        <td>' . $quantity .'</td>
                                                        <td>' . $total_price .'</td>
                                                        <td>';  
                                                        if($status == '1'){
                                                           echo '<span class="badge bg-success">Delivered</span>';
                                                        }
                                                        else{
                                                            echo '<span class="badge bg-danger">Not Delivered</span>';
                                                        } 
                                                        echo '</td>
                                                        <td class="text-center"><button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="del(' . $order_id .')">Delete</button></td>
                                                    </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </main>
            <footer class="py-3 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class=" small">
                        <div class="text-muted text-center fs-6">Copyright &copy; shopping 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

    <script>

        function del(id) {
            let row = document.getElementById("row-" + id);
            let deleteorder = document.getElementById("deleteorder");
            deleteorder.innerHTML = row.getElementsByTagName("td")[1].innerText;

            let deleteId = document.getElementById("deleteId");
            deleteId.value = id;
        }

    </script>

</body>

</html>