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
    button:focus ,
    .btns a:focus,
    .title a:focus{
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

    .info {
      position: relative;
    }

    .profile-photo {
      position: absolute;
      right: 300px;
      top: 10px;
    }

    .profile-photo img {
      width: 250px;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
    }

    .address{
      border: 1px solid rgb(221, 212, 212);
      border-radius: 5px;
      position: relative;
    }

    .address i{
      font-size:17px;
    }
    .btns{
      position: absolute;
      right: 40px;
      top: 20%;
    }

  </style>
</head>

<body>
      <?php include './assets/navbar.php'; 

          if(isset($_SESSION['addaddress']) && $_SESSION['addaddress'] == true){
            echo '<div class="m-0 alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> New address has been added Successfully.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            $_SESSION['addaddress'] = null;
          }

      
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

          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
            $userid =  $_SESSION['userid'];

            $sql2 = "SELECT * FROM `address` WHERE `user_id` = $userid";
            $result2 = mysqli_query($conn, $sql2);
          }
      ?>

  <div class="account overflow-hidden">
    <div class="account-info container pt-3 my-3">
      <div class="title d-flex">
        <h4 class="px-2">Your Account</h4>
        <a href="./myorder.php" class="btn btn-primary ">My Order</a>
      </div>
      <hr class="my-2">
      <ul class="nav nav-pills m-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#information"
            type="button" role="tab" aria-controls="pills-home" aria-selected="true">Personal Information</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#address" type="button"
            role="tab" aria-controls="pills-profile" aria-selected="false">Manage Addresses</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="profile-tab">
          <!-- information code here -->
          <div class="info p-3 pt-2">
            <h5>Full Name</h5>
            <div>
              <div class="name my-3">
                <div class="col g-2">
                  <div class="col-md-4 mb-3">
                    <div class="form-floating">
                      <input type="email" class="form-control col-md-3" id="fname" placeholder=""
                        value="<?php echo $fname; ?>" disabled>
                      <label for="fname">First Name</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-floating">
                      <input type="email" class="form-control" id="lname" placeholder="" value="<?php echo $lname; ?>"
                        disabled>
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
                  <input type="email" class="form-control col-md-3" id="email" placeholder=""
                    value="<?php echo $email; ?>" disabled>
                </div>
              </div>
            </div>
            <h5>Phone Number</h5>
            <div class="name my-3">
              <div class="row g-2">
                <div class="col-md-4">
                  <input type="email" class="form-control col-md-3" id="phonenumber" placeholder=""
                    value="<?php echo $phoneno; ?>" disabled>
                </div>
              </div>
            </div>
            <a href="#" class="btn btn-primary mt-2">Edit Profile</a>
          </div>
        </div>

        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="contact-tab">
          <!-- address code here -->

          <div class="info p-3 pt-2">

          <?php
              while ( $row2 = mysqli_fetch_assoc($result2)) {
                $fullname = $row2['fullname'];
                $phoneno = $row2['phone_number'];
                $address = $row2['area'];
                $city = $row2['city'];
                $state = $row2['state'];
                $pincode = $row2['pincode'];
                
                echo '<div class="address p-3 mb-3">
                <div class="d-flex align-items-center">
                  <h6 class="me-3">' . $fullname . ' </h6>
                  <h6> ' . $phoneno . ' </h6>
                </div>
                <p class="m-0 mt-1">' . $address . ' </p>
                <p class="m-0">' . $city . ' , ' . $state . '  - <b>' . $pincode . ' </b></p>
                <div class="btns">
                  <a href="#" class="btn btn-primary btn-sm">Edit</a>
                  <a href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>
              </div>';

              }
          ?>

              <!-- <div class="address p-3 mb-3">
                <div class="d-flex align-items-center">
                  <h6 class="me-3"> Shyam Odedra</h6>
                  <h6> 6355182051</h6>
                </div>
                <p class="m-0 mt-1">Gec Boys Hostel Gandhinagar</p>
                <p class="m-0">Gandhinagar, Gujarat - <b>382028</b></p>
                <div class="btns">
                  <a href="#" class="btn btn-primary btn-sm">Edit</a>
                  <a href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>
              </div>
              <div class="address p-3 mb-3">
                <div class="d-flex align-items-center">
                  <h6 class="me-3"> Shyam Odedra</h6>
                  <h6> 6355182051</h6>
                </div>
                <p class="m-0 mt-1">Gec Boys Hostel Gandhinagar</p>
                <p class="m-0">Gandhinagar, Gujarat - <b>382028</b></p>
                <div class="btns">
                  <a href="#" class="btn btn-primary btn-sm">Edit</a>
                  <a href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>
              </div> -->
             
              <div class="address px-3 py-2 mb-3" onclick="location.href='/shopping/addaddress.php';" style="cursor: pointer;">
                <div class="addaddress d-flex align-items-center">
                  <i class="fa fa-plus me-3 text-primary"></i>
                  <h5 class="m-0 text-primary">Add a New Address</h5>
                </div>
              </div>
              
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php include './assets/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>

</body>

</html>