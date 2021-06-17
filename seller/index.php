<?php
include '../assets/dbconnect.php';
session_start();
$seller_id = $_SESSION['seller_id'];
$seller_name = $_SESSION['seller_name'];
if(!isset($_SESSION['sellerloggedin'])){
    header('location:sellerlogin.php');
}

$sql1 = "SELECT * FROM `products` WHERE `seller_id` = '$seller_id'";
$result1 = mysqli_query($conn, $sql1);
$products = mysqli_num_rows($result1);

$sql2 = "SELECT * FROM `orders`";
$result2 = mysqli_query($conn, $sql2);
$orders = mysqli_num_rows($result2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller - Shopping </title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        crossorigin="anonymous"></script>

    <style>
        .sidebarlink{
            border-radius: 10px;
        }
        .sidebarlink:hover{
            background: rgb(75, 75, 247);
        }
        .form-control:focus,
        .btn:focus,
        .searchbtn:focus, .logoutbtn:focus {
        border-color: rgba(0, 0, 0, 0.8);
        box-shadow: none;
        /* outline: 0 none; */
    }
    </style>    
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Shopping</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 bg-primary px-2" id="sidebarToggle" href="#!"><i
                class="fas fa-bars" style="font-size: 25px; color: white;"></i></button>
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
        <li class="d-flex align-items-center me-5"><a href="../index.php" class="btn btn-primary btn-sm logoutbtn">Go to Website</a></li>
            <li class="d-flex align-items-center ms-2">
            <a class="nav-link me-2" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                      aria-expanded="false"><i class="fas fa-user me-2"></i> <?php echo  $seller_name; ?></a>
            <a href="./sellerlogout.php" class="btn btn-primary btn-sm logoutbtn">Logout</a>';  
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
                    <h3 class="mt-4">Dashboard</h3>
                    <div class="row my-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body fs-4"><?php echo $products ;?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link text-decoration-none fs-5" href="./products.php">Total Products</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body fs-4"><?php echo $orders ;?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link text-decoration-none fs-5" href="./orders.php">Total Orders</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    
                        
                    </div>
                </div>
            </main>
            <footer class="py-3 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class=" small">
                        <div class="text-center fs-6">Copyright &copy; shopping 2021</div>
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

</body>

</html>