<?php
include '../assets/dbconnect.php';

 $addproduct = false;
 $deleteproduct = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['deleteId'])) {
        $deleteId = $_POST['deleteId'];
        $sql = "DELETE FROM `products` WHERE `products`.`product_id` = $deleteId";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $deleteproduct = true;
        }

    } else {

        $pname = $_POST['pname'];
        $pinfo = $_POST['info'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $keyword = $_POST['keyword'];
        $price = $_POST['price'];

        $image = $_FILES['pimage'];

        $filename = $image['name'];
        $tempname = $_FILES['pimage']['tmp_name'];
        $folder = "images/products/" . $filename;

        if (move_uploaded_file($tempname, $folder)) {
            echo "Image uploaded successfully";
        } else {
            echo "Failed to upload image";
        }

        // $sql2 = "SELECT * FROM `categories` WHERE `cat_name` = '$category'";
        // $result2 = mysqli_query($conn, $sql2);

        // $row2 = mysqli_fetch_assoc($result2)
        // $product_cat_id = $row2['cat_id'];
        // `product_cat_id`
        // '$product_cat_id'


        $sql = "INSERT INTO `products` (`product_image` , `product_name`, `product_info`, `product_quantity`, `product_cat_name`, `seller_id`, `product_seller`, `product_price`,`product_keywords`, `created_at` ) VALUES ('$folder' ,'$pname', '$pinfo', '$quantity', '$category', '1', 'shopping', '$price', '$keyword', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $addproduct = true;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

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
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="../admin/products.php" method="POST">
                        <input type="hidden" name="deleteId" id="deleteId">
                        <div class="mb-2 ">
                            <p>Product Name: <strong><span id="deleteProduct"></span></strong></p>
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


    <!-- edit Modal code end -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Shopping</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 bg-primary px-2" id="sidebarToggle" href="#!"><i class="fas fa-bars" style="font-size: 25px; color: white;"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-4 me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary searchbtn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-auto me-3 me-lg-4">
            <li class="d-flex align-items-center">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user me-2"></i> Shyam</a>
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
                <?php
                    if(isset($editproduct) && $editproduct == true){
                        echo '<div class="mt-0 alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Product has been Edit successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }

                    if(isset($deleteproduct) && $deleteproduct == true){
                        echo '<div class="mt-0 alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Product has been delete successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }

                    if(isset($addproduct) && $addproduct == true){
                        echo '<div class="mt-0 alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Product has been added successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }
                ?>
                <div class="container-fluid px-4">
                    <!-- content code here -->
                    <h3 class="mt-4">Products</h3>
                    <ul class="nav nav-pills my-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#list" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Product List</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#addproduct" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Add Product</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card my-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Product List
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Sr no.</th>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Info</th>
                                                <th>Seller</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th colspan=2 class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql2 = "SELECT * FROM `products`";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $srno2 = 0;
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                $pname = $row2['product_name'];
                                                $pimage = $row2['product_image'];
                                                $pinfo = $row2['product_info'];
                                                $seller = $row2['product_seller'];
                                                $pcatname = $row2['product_cat_name'];
                                                $price = $row2['product_price'];
                                                $srno2 = $srno2 + 1;
                                                $pid = $row2['product_id'];

                                                echo
                                                '<tr id = "row-' . $pid . '">
                                                        <td class="text-center align-middle">' . $srno2 . '</td>
                                                        <td class="d-flex align-items-center justify-content-center"> <img src="' . $pimage . '" alt="" style="width: 50px; height: 100px; object-fit: cover;"> </td>
                                                        <td class="text-center align-middle">' . $pname . '</td>
                                                        <td class="text-center align-middle">' . $pinfo . '</td>
                                                        <td class="text-center align-middle">' . $seller . '</td>
                                                        <td class="text-center align-middle">' . $pcatname . '</td>
                                                        <td class="text-center align-middle">' . $price . '</td>
                                                        <td class="text-center align-middle"><a href="./editproduct.php?pid=' . $pid . '" class="btn btn-primary btn-sm">Edit</a></td>
                                                        <td class="text-center align-middle"><button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="del(' . $pid . ')">Delete</button></td>
                                                </tr>
                                                        ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="addproduct" role="tabpanel" aria-labelledby="contact-tab">
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
                                        <select class="form-select form-control" aria-label="Default select example" name="category" required>
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
                    </div>




                </div>
            </main>
            <footer class="py-3 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class=" small">
                        <div class="text-muted text-center fs-6">Copyright &copy; shopping 2021</div>
                    </div>
                </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
            function del(id) {
                let row = document.getElementById("row-" + id);
                let deleteProduct = document.getElementById("deleteProduct");
                deleteProduct.innerHTML = row.getElementsByTagName("td")[2].innerText;

                let deleteId = document.getElementById("deleteId");
                deleteId.value = id;
            }
        </script>
</body>

</html>