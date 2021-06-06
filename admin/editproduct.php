<?php

include '../assets/dbconnect.php';  

if( isset($_GET['pid']) ){
    $product_id = $_GET["pid"];
}

if(isset(($_POST['editcatname']))){
    $editcat_name = $_POST['editcatname'];
   
    $sql = "UPDATE categories SET `cat_name` = '$editcat_name' WHERE `cat_id`= $category_id ";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location:categories.php");
    }
    else{
        $msg = "Locho Thai gayo.";
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
            <li class="d-flex align-items-center">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user me-2"></i> Shyam</a>
                <a href="./logout.php" class="btn btn-primary btn-sm logoutbtn">Logout</a>
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
                        <a class="nav-link sidebarlink mx-2" href="vendors.php">
                            <i class="fas fa-store me-2"></i>
                          Vendors
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
                    <h3 class="mt-4">Edit Products</h3>
                    <form class="m-3 row d-flex" action="products.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-2 col-6">
                                    <div class="mb-2 col-10">
                                        <label for="pimage" class="form-label">Choose Image</label>
                                        <input class="form-control col-md-4" type="file" id="pimage" name="pimage" required>
                                    </div>
                                    <div class="mb-2 col-10">
                                        <label for="pname" class="form-label">Product Name</label>
                                        <input type="text" class="form-control col-md-6" id="pname" name="pname" required>
                                    </div>
                                    <div class="mb-2 col-10">
                                        <label for="info" class="form-label">Product Info</label>
                                        <input type="text" class="form-control col-md-6" id="info" name="info" required>
                                    </div>
                                    <div class="mb-2 col-10">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control col-md-6" id="quantity" name="quantity" required>
                                    </div>
                                    <div class="mb-2 col-10">
                                        <label for="keyword" class="form-label">Product Keyword</label>
                                        <input type="text" class="form-control col-md-6" id="keyword" name="keyword" required>
                                    </div>
                                </div>
                                <div class="mb-2 col-6">
                                    <div class="mb-2 col-10">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select" aria-label="Default select example" name="category" required>
                                            <?php

                                            $sql2 = "SELECT * FROM `categories`";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $srno = 0;
                                            while ($row = mysqli_fetch_assoc($result2)) {
                                                $cat_name = $row['cat_name'];
                                                $cat_id = $row['cat_id'];
                                                $srno = $srno + 1;

                                                echo
                                                '
                                            <option value="' . $cat_name . '">' . $cat_name . '</option> 
                                        ';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-2 col-10">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control col-md-6" id="price" name="price" required>
                                    </div>
                                    <div class="mt-4 col-10">
                                        <button type="submit" class="btn btn-primary col-4">Add Product</button>
                                    </div>
                                </div>
                    </form>
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

</body>

</html>