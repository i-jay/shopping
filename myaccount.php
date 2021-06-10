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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Hello, world!</title>
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

    .title a{
      position: absolute;
      right: 50px;
      top: 10px;
    }
    .account {
      background: rgb(226, 225, 225);
    }

    .account-info {
      background: rgb(255, 255, 255);
      border-radius: 10px;
      position: relative;
    }
    .info{
      position: relative;
    }
    .profile-photo{
      position: absolute;
      right: 300px;
      top: 10px;
    }
    .profile-photo img{
      width: 250px;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <?php include './assets/navbar.php'; 

  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    $userid =  $_SESSION['userid'];

    $sql = "SELECT * FROM `users` WHERE `user_id` = $userid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $email = $row['email'];
    $phoneno = $row['phone_number'];
  }
  else{
    header('location:login.php');
  }
  ?>

  <div class="account overflow-hidden">
    <div class="account-info container pt-3 my-3">
      <div class="title d-flex">
        <h4 class="px-2">Your Account</h4>
        <a href="./myorder.php" class="btn btn-primary ">My Order</a>
      </div>
      <hr class="my-2">
      
      <div class="info p-3">
        <h5>Personal Information</h5>
        <div>
            <div class="name my-3">
              <div class="col g-2">
                <div class="col-md-4 mb-3">
                  <div class="form-floating">
                    <input type="email" class="form-control col-md-3" id="fname" placeholder="" value="<?php echo $fname; ?>" disabled>
                    <label for="fname">First Name</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="lname" placeholder="" value="<?php echo $lname; ?>" disabled>
                    <label for="lname">Last Name</label>
                  </div>
                </div>

              </div>
            </div>
          </div>    
          <div class="profile-photo">
            <h5 class="mt-1 mb-2 text-center">Profile Picture</h5>
            <img class="my-1" src="images/profile.jpeg" alt="profile-image">
          </div>
        <h5>Email Address</h5>
        <div class="name my-3">
          <div class="row g-2">
            <div class="col-md-4">
              <input type="email" class="form-control col-md-3" id="email" placeholder="" value="<?php echo $email; ?>" disabled>
            </div>
          </div>
        </div>
        <h5>Phone Number</h5>
        <div class="name my-3">
          <div class="row g-2">
            <div class="col-md-4">
              <input type="email" class="form-control col-md-3" id="phonenumber" placeholder="" value="<?php echo $phoneno; ?>" disabled>
            </div>
          </div>
        </div>
        <a href="#" class="btn btn-primary mt-2">Edit Profile</a>
      </div>
    </div>
  </div>

  <?php include './assets/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>

</body>

</html>