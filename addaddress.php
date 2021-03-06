<?php
include './assets/dbconnect.php';  

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_address'])){

  $fullname = $_POST['address_fullname'];
  $phoneno = $_POST['address_phoneno'];
  $address = $_POST['address_address'];
  $city = $_POST['address_city'];
  $state = $_POST['address_state'];
  $pincode = $_POST['address_pincode'];
  $address_id = $_POST['address_id'];
  
  $sql = "UPDATE `address` SET `fullname` = '$fullname ', `phone_number` = '$phoneno', `area` = '$address', `city` = '$city ', `state` = '$state ', `pincode` = '$pincode ' WHERE `address`.`address_id` = $address_id";
  $result = mysqli_query($conn, $sql);
  if($result){
    header('location:myaccount.php');
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
    .navbarsearch{
      width: 450px;
    }
    .title a {
      position: absolute;
      right: 50px;
      top: 10px;
    }

    .account {
      background: rgb(226, 225, 225);
      min-height: 405px;
    }
    .account-info {
      background: rgb(255, 255, 255);
      border-radius: 10px;
      position: relative;
    }
</style>
  </head>
  <body>
    <?php include './assets/navbar.php'; 
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
      $userid =  $_SESSION['userid'];

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_address'])){

        $fullname = $_POST['fullname'];
        $phoneno = $_POST['phoneno'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        
        $sql = "INSERT INTO `address` (`user_id`, `fullname`, `phone_number`, `area`, `city`, `state`, `pincode`) VALUES ('$userid', '$fullname', '$phoneno', '$address', '$city', '$state', '$pincode')";
        $result = mysqli_query($conn, $sql);
        if($result){
          session_start();
          $_SESSION['addaddress'] = true;
          header('location:myaccount.php');
        }
      }
    
    }  
    ?>

    <div class="account overflow-hidden">
        <div class="account-info container pt-3 my-3">
        <div class="title d-flex">
            <h4 class="px-2">Your Account</h4>
            <a href="./myorder.php" class="btn btn-primary ">My Order</a>
        </div>
        <hr class="my-2">
        <div class="addaddress">
            <h5 class="m-3">Add a New Address</h5>
                <!-- action  -   ?aid=<?php echo $product_id; ?> -->
            <form class="m-3 row d-flex" action="addaddress.php" method="POST">
                    <div class="mb-2 col-6">
                        <div class="mb-2 col-10">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control col-md-6" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-2 col-10">
                            <label for="phoneno" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control col-md-6" id="phoneno" name="phoneno" required>
                        </div>
                        <div class="mb-2 col-10">
                            <label for="address" class="form-label">Address (Area/Street/Villege)</label>
                            <input type="text" class="form-control col-md-6" id="address" name="address" required>
                        </div>
                        <div class="mb-2 col-10">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control col-md-6" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="mb-2 col-6">
                        <div class="mb-2 col-10">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control col-md-6" id="state" name="state" required>
                        </div>
                
                        <div class="mb-2 col-10">
                            <label for="pincode" class="form-label">Pin Code</label>
                            <input type="number" class="form-control col-md-6" id="pincode" name="pincode" required>
                        </div>
                        <div class="mt-4 col-10">
                            <button name="add_address" type="submit" class="btn btn-primary col-4" name="submit">Add Address</button>
                        </div>
                    </div>
            </form>
        </div>

        </div>
    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
  </body>
</html>