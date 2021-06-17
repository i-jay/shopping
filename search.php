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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Hello, world!</title>
      <style>
    .form-control:focus,button:focus {
        border-color: rgba(0, 0, 0, 0.8);
        box-shadow: none;
        outline: 0 none;
    }
    button{
      background: #ffe500; 
      color: black;
    }
    .search{
        background: rgb(226, 225, 225);
    }
    .results{
        width: 78%;
        background: rgb(255, 255, 255);
        border-radius: 10px;
        margin: 10px;
    }
    .navbarsearch{
      width: 450px;
    }
    .filter{
        width: 20%;
        height: 90vh;
        background: rgb(255, 255, 255);
        border-radius: 10px;
        margin: 10px;
    }
    .filter li{
        margin-top: 7px;
    }
    .filter a{
        color: black;
        text-decoration: none;
    }
    .filter a:hover{
        text-decoration: underline;
        color: #0d6efd;
    }
    .results .product .product-info{
        width: 450px;
        /* padding-right: 200px; */
        margin-right: 150px;
    }
    .results .product:hover .product-info h5{
        color: #0d6efd;
    }
    .category{
        height: 40px;
    }
    .links{
        list-style: none;
        justify-content: center;
    }
    .links li{
        margin-right: 50px;
        line-height: 40px;
    }
    .links li a{
        text-decoration: none;
        font-size: 18px;
        color: black;
    }
    .links li a:hover{
        color: blue;
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
  <body>
    <?php include './assets/navbar.php'; ?>
    <div class="category container">
    <ul class="links d-flex">
        <li><a href="search.php?pcatid=1"> Mobile </a></li>
        <li><a href="search.php?pcatid=2"> Laptop </a></li>
        <li><a href="search.php?pcatid=3"> Gaming </a></li>
        <li><a href="search.php?pcatid=4"> Fashion </a></li>
        <li><a href="search.php?pcatid=5"> Sports </a></li>
        <li><a href="search.php?pcatid=6"> Watches </a></li>
        <li><a href="search.php?pcatid=7"> Books </a></li>
        <li><a href="search.php?pcatid=8"> Shoes </a></li>
        <li><a href="search.php?pcatid=9"> Camera </a></li>
        <li><a href="search.php?pcatid=10"> Headphones </a></li>
    </ul>
    </div>

    <div class="search d-flex">
        <div class="filter p-2 ps-4">
            <h4 class="my-1">Filters</h4>
            <hr>
            <h5 class="my-1">Price</h5>
            <ul>
                <li><a href=""> Under ₹1000</a></li>
                <li><a href=""> ₹1000 - ₹5000</a></li>
                <li><a href=""> ₹5000 - ₹10000</a></li>
                <li><a href=""> ₹10000 - ₹20000</a></li>
            </ul>
            <h5 class="my-1">Sort By</h5>
            <ul>
                <li><a href=""> Newest</a></li>
                <li><a href=""> Popularity</a></li>
                <li><a href=""> Price - Low to High</a></li>
                <li><a href=""> Price - High to Low</a></li>
            </ul>
            <h5 class="my-1">Sort By</h5>
            <ul>
                <li><a href=""> Newest</a></li>
                <li><a href=""> Popularity</a></li>
                <li><a href=""> Price - Low to High</a></li>
                <li><a href=""> Price - High to Low</a></li>
            </ul>
        </div>
        <div class="results">

            <?php

                if(isset($_GET['pcatid'])){
                    $product_cat_id = $_GET['pcatid'];
                
                    $sql = "SELECT * FROM `products` WHERE `product_cat_id` = $product_cat_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $pcatname = $row['product_cat_name']; 
                    
                    echo '<h5 class="my-2 ps-4">Showing results for "'. $pcatname .'"</h5>
                    <hr>';
                    
                    $sql2 = "SELECT * FROM `products` WHERE `product_cat_id` = $product_cat_id";
                    $result2 = mysqli_query($conn, $sql2); 
                    $num = mysqli_num_rows($result2);

                    if($num ==0){
                        //     echo ' <div class="alert alert-warning m-4" role="alert">
                        //     <h4 class="alert-heading">No Results Found!</h4>
                        //     <p>Please type some general word.</p>
                        //   </div>';                   
                            echo ' <div class="m-4">
                            <h4>No Results Found!</h4>
                          </div>';                   
                    }
                    else{

                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $pname = $row2['product_name'];
                            // $pcatname2 = $row2['product_cat_name'];
                            $pimage = $row2['product_image'];
                            $price = $row2['product_price'];
                            $pinfo = $row2['product_info'];
                            $pid = $row2['product_id'];
                            $link = "'/shopping/product.php?pid=$pid'";
            
                            echo '<div class="product d-flex my-3 overflow-hidden" onclick="location.href='. $link .';" style="cursor: pointer;">
                            <div class="product-photo ms-5 border-0" >
                                <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 200px;">
                                    <img src="./admin/'. $pimage .'" style="width: 90px; object-fit: fill;"
                                        class="mx-auto " alt="...">
                                </div>
                            </div>
                            <div class="product-info p-3">
                                <h5>' . $pname .'</h5>
                                <ul>
                                    <li>' . $pinfo . '</li>
                                </ul>
                            </div>
                            <div class="price">
                                <h2 class="my-3 text-center"> ₹' . $price . '</h2>
                            </div>
                            </div> <hr>';   
                        }
                    }

                }

                if(isset($_GET['search'])){
                    $search = $_GET['search'];

                    
                    echo '<h5 class="my-2 ps-4">Showing results for "'. $search .'"</h5>
                    <hr>';
                    
                    $sql3 = "SELECT * FROM `products` WHERE MATCH ( `product_name`,`product_info`, `product_cat_name`, `product_keywords`) against ('$search')";
                    $result3 = mysqli_query($conn,$sql3);
                    $num = mysqli_num_rows($result3);

                    if($num ==0){
                        //     echo ' <div class="alert alert-warning m-4" role="alert">
                        //     <h4 class="alert-heading">No Results Found!</h4>
                        //     <p>Please type some general word.</p>
                        //   </div>';                   
                            echo ' <div class="m-4">
                            <h4>No Results Found!</h4>
                          </div>';                   
                    }
                    else{

                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $pname = $row3['product_name'];
                            $pimage = $row3['product_image'];
                            $price = $row3['product_price'];
                            $pinfo = $row3['product_info'];
                            $pid = $row3['product_id'];
                            $link = "'/shopping/product.php?pid=$pid'";
            
                            echo '<div class="product d-flex my-3 overflow-hidden" onclick="location.href='. $link .';" style="cursor: pointer;">
                            <div class="product-photo ms-5 border-0" >
                                <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 200px;">
                                    <img src="./admin/'. $pimage .'" style="width: 90px; object-fit: fill;"
                                        class="mx-auto " alt="...">
                                </div>
                            </div>
                            <div class="product-info p-3">
                                <h5>' . $pname .'</h5>
                                <ul>
                                    <li>' . $pinfo . '</li>
                                </ul>
                            </div>
                            <div class="price">
                                <h2 class="my-3 text-center"> ₹' . $price . '</h2>
                            </div>
                            </div> <hr>';   
                        }
                    }
                }
             ?>
            <!-- <div class="product d-flex my-3 overflow-hidden" onclick="location.href='/shopping/product.php';" style="cursor: pointer;">
                <div class="product-photo ms-5 border-0" >
                    <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 200px;">
                        <img src="images/mobile1.jpeg" style="width: 90px; object-fit: fill;"
                            class="mx-auto " alt="...">
                    </div>
                </div>
                <div class="product-info p-3">
                    <h5>Redmi Note 10 Pro (Vintage Bronze, 128 GB) (8 GB RAM)</h5>
                    <ul>
                        <li>8 GB RAM | 128 GB ROM</li>
                        <li>16.94 cm (6.67 inch) Display</li>
                        <li>5020 mAh Battery</li>
                        <li>5020 mAh Battery</li>
                    </ul>
                </div>
                <div class="price">
                    <h2 class="my-3 text-center"> ₹21,690</h2>
                </div>
            </div> <hr>
            <div class="product d-flex my-3 overflow-hidden" onclick="location.href='/shopping/product.php';" style="cursor: pointer;">
                <div class="product-photo ms-5 border-0" >
                    <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 200px;">
                        <img src="images/mobile1.jpeg" style="width: 90px; object-fit: fill;"
                            class="mx-auto " alt="...">
                    </div>
                </div>
                <div class="product-info p-3">
                    <h5>Redmi Note 10 Pro (Vintage Bronze, 128 GB) (8 GB RAM)</h5>
                    <ul>
                        <li>8 GB RAM | 128 GB ROM</li>
                        <li>16.94 cm (6.67 inch) Display</li>
                        <li>5020 mAh Battery</li>
                        <li>5020 mAh Battery</li>
                    </ul>
                </div>
                <div class="price">
                    <h2 class="my-3 text-center"> ₹21,690</h2>
                </div>
                
        
            </div> <hr>
            <div class="product d-flex my-3 overflow-hidden" onclick="location.href='/shopping/product.php';" style="cursor: pointer;">
                <div class="product-photo ms-5 border-0" >
                    <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 200px;">
                        <img src="images/mobile1.jpeg" style="width: 90px; object-fit: fill;"
                            class="mx-auto " alt="...">
                    </div>
                </div>
                <div class="product-info p-3">
                    <h5>Redmi Note 10 Pro (Vintage Bronze, 128 GB) (8 GB RAM)</h5>
                    <ul>
                        <li>8 GB RAM | 128 GB ROM</li>
                        <li>16.94 cm (6.67 inch) Display</li>
                        <li>5020 mAh Battery</li>
                        <li>5020 mAh Battery</li>
                    </ul>
                </div>
                <div class="price">
                    <h2 class="my-3 text-center"> ₹21,690</h2>
                </div>
                
        
            </div> <hr>
            <div class="product d-flex my-3 overflow-hidden" onclick="location.href='/shopping/product.php';" style="cursor: pointer;">
                <div class="product-photo ms-5 border-0" >
                    <div class="m-2 overflow-hidden d-flex justify-content-center" style="width: 200px;">
                        <img src="images/mobile1.jpeg" style="width: 90px; object-fit: fill;"
                            class="mx-auto " alt="...">
                    </div>
                </div>
                <div class="product-info p-3">
                    <h5>Redmi Note 10 Pro (Vintage Bronze, 128 GB) (8 GB RAM)</h5>
                    <ul>
                        <li>8 GB RAM | 128 GB ROM</li>
                        <li>16.94 cm (6.67 inch) Display</li>
                        <li>5020 mAh Battery</li>
                        <li>5020 mAh Battery</li>
                    </ul>
                </div>
                <div class="price">
                    <h2 class="my-3 text-center"> ₹21,690</h2>
                </div>
                
        
            </div> -->
            
            

        </div>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
  </body>
</html>