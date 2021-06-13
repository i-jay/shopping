<?php
session_start();

if(isset($_GET['search'])){
  $search = $_GET['search'];}

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
<div class="container-fluid">
  <a class="navbar-brand" href="/shopping" style="color: #ffe500; font-size: 25px; font-weight: 400;">Shopping</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">';
   
  if(isset($_GET['search'])){
    $search = $_GET['search'];

    echo '<form class="d-flex mx-5" action="/shopping/search.php" method="get">
    <input class="form-control me-4 col-sm-10 navbarsearch" name="search" type="search" placeholder="Search" aria-label="Search" required value="' . $search .  '">
    <button class="btn btn-warning" type="submit" style="background: #ffe500">Search</button>
  </form>';
  
  }
  else{
    echo '<form class="d-flex mx-5" action="/shopping/search.php" method="get">
    <input class="form-control me-4 col-sm-10 navbarsearch" name="search" type="search" placeholder="Search" aria-label="Search" required>
    <button class="btn btn-warning" type="submit" style="background: #ffe500">Search</button>
  </form>';
  }


  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    $user_id = $_SESSION['userid'];
  
    $sql2 = "SELECT * FROM `cart` WHERE `user_id` = $user_id";
    $result2 = mysqli_query($conn, $sql2);
    $num = mysqli_num_rows($result2);
    $link2 = "'./mycart.php'";

    echo  '</div>
            <div class="icons">
            <span class="icons cartnumber m-0 me-4" data-count="' . $num . '" onclick="location.href=' . $link2 . ';" style="cursor: pointer;">
            <a><i class="fa fa-shopping-cart mx-2" style="line-height: 25px; font-size: 25px; color: white;"></i></a></div>
            </span>';
  }

  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    echo '<div class="icons d-flex align-items-center">
    <a href="/shopping/myaccount.php" style="color: white; text-decoration: none; font-size: 20px; margin-right: 20px;"><i  class="fa fa-user mx-2" style="line-height: 25px; font-size: 25px; color: white;"> </i>'.$_SESSION['firstname'].' </a>
    <a type="button" class="btn btn-warning my-2 my-sm-0 mx-2" href="logout.php" style="background: #ffe500">Logout</a> 
    </>';
  }
  else{
    echo '<div class="d-flex">
    <a type="button" class="btn btn-warning my-2 my-sm-0 mx-2" href="login.php" style="background: #ffe500">Login</a>
    <a type="button" class="btn btn-warning my-2 my-sm-0" href="./signup.php" style="background: #ffe500">SignUp</a>
</div>';
  }
 
echo '
</div>
</nav>
';
