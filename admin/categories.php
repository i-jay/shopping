

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
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Shopping</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 bg-primary px-2" id="sidebarToggle" href="#!"><i class="fas fa-bars" style="font-size: 25px; color: white;"></i></button>
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
                    <?php
                        include '../assets/dbconnect.php';

                        if($_SERVER['REQUEST_METHOD'] == 'POST'){

                            $cat_name = $_POST['catname'];

                            $sql = "INSERT INTO `categories` (`cat_name`) VALUES ('$cat_name')";
                            $result = mysqli_query($conn, $sql);

                            if(!$result){
                                echo "locho thai gayo";
                            }

                        }

                    ?>

                    <!-- content code here -->
                    <h3 class="mt-4">Categories</h3>
                    <ul class="nav nav-pills my-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#list" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Category List</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#addproduct" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Add Category</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card my-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Categories
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Sr no.</th>
                                                <th>Category Name</th>
                                                <th colspan=2 class="text-center">Actions</th>
                                            </tr>
                                        </thead>

                                        <?php

                                            $sql2 = "SELECT * FROM `categories`";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $srno = 0;
                                            while($row = mysqli_fetch_assoc($result2)){
                                                $cat_name = $row['cat_name'];
                                                $cat_id = $row['cat_id'];
                                                $srno = $srno + 1;

                                                echo 
                                                '<tbody>
                                                    <tr>
                                                        <td>' . $srno . '</td>
                                                        <td>' . $cat_name . '</td>
                                                        <td class="text-center"><a href="editcategory.php?cat_id=' . $cat_id . ' " class="btn btn-sm btn-primary px-3"">Edit</a></td>
                                                        <td class="text-center"><a href="#" class="btn btn-sm btn-danger px-3">Delete</a></td>
                                                    </tr>
                                            </tbody>';
                                            
                                            }
                                        ?>
                                        <!-- <td class="d-flex align-items-center justify-content-center"></td> -->
                                    </table>
                                </div>
                            </div>
                        </div>

                       
                        <div class="tab-pane fade" id="addproduct" role="tabpanel" aria-labelledby="contact-tab">
                            <form class="m-3 row d-flex flex-column" action="categories.php" method="POST">
                                <div class="mb-2 col-6">
                                    <label for="catname" class="form-label">Category Name </label>
                                    <input type="text" class="form-control col-md-6" id="catname" name="catname"
                                        required>
                                </div>
                                <div class="mt-2 col-6 ">
                                    <button type="submit" class="btn btn-primary col-4">Add Category</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- Edit Modal Code  -->   
                    <!-- Button trigger modal -->


                    <!-- edit Modal -->
                    <!-- <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editmodalLabel">Edit Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="m-3 row d-flex flex-column" action="categories.php" method="POST">
                                        <div class="mb-2 col-12">
                                            <label for="editcatname" class="form-label">Category Name</label>
                                            <input type="text" class="form-control col-md-6" id="editcatname" name="editcatname"
                                                required>
                                        </div>
                                        <div class="mt-2 col-10 ">
                                            <button type="submit" class="btn btn-primary col-7">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> -->


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