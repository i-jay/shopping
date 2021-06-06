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
</style>
  </head>
  <body>
    <?php include './assets/navbar.php'; ?>

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

        <h5 class="my-2 ps-4">Showing results for "Redmi Note 10 Pro"</h5>
            <hr>
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
                
        
            </div>
            
            

        </div>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
  </body>
</html>