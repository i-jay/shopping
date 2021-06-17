<?php
include './assets/dbconnect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteId'])){
  $deleteId = $_POST['deleteId'];
  $sql = "DELETE FROM `address` WHERE `address`.`address_id` = $deleteId";
  $result = mysqli_query($conn, $sql);

  if ($result) {
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Hello, world!</title>
  <style>
    .form-control:focus,
    button:focus,
    .btns a:focus,
    .title a:focus {
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

    .address {
      border: 1px solid rgb(221, 212, 212);
      border-radius: 5px;
      position: relative;
    }

    .address i {
      font-size: 17px;
    }

    .btns {
      position: absolute;
      right: 40px;
      top: 20%;
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
          
          if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editProfile'])){
            $edit_fname = $_POST['firstname'];
            $edit_lname = $_POST['lastname'];
            $edit_email = $_POST['email'];
            $edit_phoneno = $_POST['phone_number'];
          
            $update = "UPDATE `users` SET `firstname` = '$edit_fname', `lastname` = '$edit_lname', `email` = '$edit_email', `phone_number` = '$edit_phoneno' WHERE `users`.`user_id` = $userid";
            $result = mysqli_query($conn, $update);
            if($result){
              header('location:myaccount.php');
            }
            
          }
     ?>

  <!--edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="myaccount.php" method="post">
            <div class="info p-3 pt-2">
              <h5>Full Name</h5>
              <div>
                <div class="name my-3">
                  <div class=" g-2">
                    <div class="mb-3">
                      <div class="form-floating">
                        <input type="text" class="form-control " id="firstname" placeholder=""
                          value="<?php echo $fname; ?>" name="firstname">
                        <label for="firstname">First Name</label>
                      </div>
                    </div>
                    <div>
                      <div class="form-floating">
                        <input type="text" class="form-control" id="lastname" placeholder=""
                          value="<?php echo $lname; ?>" name="lastname">
                        <label for="lastname">Last Name</label>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <h5>Email Address</h5>
              <div class="name my-3">
                <div class="row g-2">
                  <div>
                    <input type="email" class="form-control col-md-3" id="editemail" placeholder=""
                      value="<?php echo $email; ?>" name="email">
                  </div>
                </div>
              </div>
              <h5>Phone Number</h5>
              <div class="name my-3">
                <div class="row g-2">
                  <div>
                    <input type="tel" class="form-control" id="phone_number" placeholder=""
                      value="<?php echo $phoneno; ?>" name="phone_number">
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-end m-0">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                <button name="editProfile" type="submit" class="btn btn-primary me-2 ">Edit Profile</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal ends -->




  <!-- delete modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this Address ?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="myaccount.php" method="POST">
            <input type="hidden" name="deleteId" id="deleteId">

            <div class="mt-3">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>

      </div>

    </div>
  </div>

  <!--  Modal code ends -->


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
            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profile</a>
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
                $address_id = $row2['address_id'];
                
                echo '<div class="address p-3 mb-3" id="address-'.$address_id.'" >
                <div class="d-flex align-items-center">
                  <h6 class="me-3">' . $fullname . ' </h6>
                  <h6> ' . $phoneno . ' </h6>
                </div>
                <p class="m-0 mt-1">' . $address . ' </p>
                <span>' . $city . '</span>,<span>' . $state . '</span>-<span>' . $pincode . '</span>
                <div class="btns">
                  <a href="#" class="btn btn-primary btn-sm" onclick="edit('.$address_id.')" data-bs-toggle="modal" data-bs-target="#addressModal">Edit</a>
                  <a href="#" class="btn btn-danger btn-sm" onclick="del('.$address_id.')" data-bs-toggle="modal"  data-bs-target="#deleteModal">Delete</a>
                </div>
              </div>';

              }
          ?>

            <!-- address Modal -->
            <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="m-3 row d-flex" action="addaddress.php" method="POST">
                      <div class="mb-2 col-6">
                        <div class="mb-2 col-10">
                          <label for="address_fullname" class="form-label">Full Name</label>
                          <input type="text" class="form-control col-md-6" id="address_fullname"
                            name="address_fullname">
                        </div>
                        <div class="mb-2 col-10">
                          <label for="address_phoneno" class="form-label">Phone Number</label>
                          <input type="tel" class="form-control col-md-6" id="address_phoneno" name="address_phoneno">
                        </div>
                        <div class="mb-2 col-10">
                          <label for="address_address" class="form-label">Address (Area/Street/Villege)</label>
                          <input type="text" class="form-control col-md-6" id="address_address" name="address_address">
                        </div>

                      </div>
                      <div class="mb-2 col-6">
                        <div class="mb-2 col-10">
                          <label for="address_city" class="form-label">City</label>
                          <input type="text" class="form-control col-md-6" id="address_city" name="address_city">
                        </div>
                        <div class="mb-2 col-10">
                          <label for="address_state" class="form-label">State</label>
                          <input type="text" class="form-control col-md-6" id="address_state" name="address_state">
                        </div>

                        <div class="mb-2 col-10">
                          <label for="address_pincode" class="form-label">Pin Code</label>
                          <input type="number" class="form-control col-md-6" id="address_pincode"
                            name="address_pincode">
                        </div>
                        <input type="hidden" name="address_id" id="address_id">
                        <div class="mt-4 col-10">
                          <button type="submit" class="btn btn-primary col-4" name="edit_address">Edit Address</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- address modal ends  -->





            <div class="address px-3 py-2 mb-3" onclick="location.href='/shopping/addaddress.php';"
              style="cursor: pointer;">
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
  <script>
    function del(id) {
      let input = document.getElementById('deleteId');
      input.value = id;
    }

    function edit(id) {
      let address_id = document.getElementById('address_id');
      address_id.value = id;

      let address = document.getElementById('address-' + id);
      let name = address.getElementsByTagName('h6')[0].innerText;
      let number = address.getElementsByTagName('h6')[1].innerText;
      let area = address.getElementsByTagName('p')[0].innerText;
      let city = address.getElementsByTagName('span')[0].innerText;
      let state = address.getElementsByTagName('span')[1].innerText;
      let pincode = address.getElementsByTagName('span')[2].innerText;

      document.getElementById('address_fullname').value = name;
      document.getElementById('address_phoneno').value = number;
      document.getElementById('address_address').value = area;
      document.getElementById('address_city').value = city;
      document.getElementById('address_state').value = state;
      document.getElementById('address_pincode').value = pincode;

      return true;
    }


  </script>

</body>

</html>