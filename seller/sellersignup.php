<?php
$exist_email = false ;
$invalidpass = false ;
include '../assets/dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $phoneno = $_POST['phoneno'];
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];

$checkemail = "SELECT * FROM `sellers` WHERE `email` = '$email' ";
$result = mysqli_query($conn, $checkemail);
$row = mysqli_num_rows($result);
    if($row == 0){
        if($password == $cpassword ){
            $insert = "INSERT INTO `sellers` (`firstname`, `lastname`, `email`, `phone_number`, `password`,`created_at`) VALUES ('$fname', '$lname','$email',$phoneno,'$password',current_timestamp())";
            $result = mysqli_query($conn, $insert);
            if($result){
                session_start();
                $sql2 = "SELECT * FROM `sellers` WHERE `email` = '$email' ";
                $result2 = mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($result2);
                $userid = $row['user_id'];
                $_SESSION['userid'] = $userid ;
                $_SESSION['sellerloggedin'] = true ;
                $_SESSION['firstname'] = $fname ;
               header('location:index.php') ;
            }
        }
        else{
            $invalidpass = true ;
        }  
    }
    else{
        $exist_email = true ; 
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

    <title>Seller SignUp - Shopping</title>
    <style>
        .form-control:focus,
        button:focus {
            border-color: rgba(0, 0, 0, 0.8);
            box-shadow: none;
            outline: 0 none;
        }

        .form-col button {
            background: #ffe500;
            color: black;
        }

        .navbarsearch {
            width: 450px;
        }

        .form {
            min-height: 441px;
        }

        p {
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {

            .col-md-6,
            .col-md-2 {
                margin: auto;
            }

            .loginbtn {
                width: 250px;
            }

            .lginput {
                width: 400px;
                margin-top: 7px;
            }

            .nameinput {
                width: 190px;
                margin-top: 7px;
            }
        }
    </style>
</head>

<body>
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Shopping</a>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-auto me-3 me-lg-4">
        <li class="d-flex align-items-center me-5"><a href="../index.php" class="btn btn-primary btn-sm logoutbtn">Go to Website</a></li>
            <li class="d-flex align-items-center ms-2">
            <?php
            session_start();
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
                echo  '<a class="nav-link me-2" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                      aria-expanded="false"><i class="fas fa-user me-2"></i> Shyam</a>
                  <a href="./sellerlogout.php" class="btn btn-primary btn-sm logoutbtn">Logout</a>';
              }
              else{
                  echo '<a href="./sellerlogin.php" class="btn btn-primary btn-sm logoutbtn mx-3">Login</a> 
                        <a href="./sellersignup.php" class="btn btn-primary btn-sm logoutbtn">SignUp</a>';
              }

            ?>
            </li>
        </ul>
    </nav>

    <?php 
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
        header('location:index.php');
    }
    if( $exist_email == true){
        echo '<div class="mt-0 alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> Email already exist.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if( $invalidpass == true){
        echo '<div class="mt-0 alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> Password does not match
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>


    <div class="container mt-1 pt-3 d-flex align-items-center justify-content-center flex-column">
        <div class="title">
            <h2 class="text-center my-1 mb-4">SignUp For Seller</h2>
        </div>
        <form class="align-items-center form" method="post" action="sellersignup.php">
            <div class="form-col">
                <div class="row">
                    <div class="col">
                        <label for="fname">First Name</label>
                        <input type="text" class="nameinput form-control" id="fname" name="fname"
                            placeholder="First Name" required>
                    </div>
                    <div class="col d-flex flex-column">
                        <label for="lname">Last Name</label>
                        <input type="text" class="nameinput form-control" id="lname" name="lname"
                            placeholder="Last Name" required>
                    </div>
                </div>
                <div class="form-group my-1 ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control lginput" id="email" name="email"
                        placeholder="Email" required>
                </div>
                <div class="form-group my-1 ">
                    <label for="phoneno">Phone Number</label>
                    <input type="text" class="form-control lginput" id="phoneno" name="phoneno"
                        placeholder="Phone Number" required>
                </div>
                <div class="col my-2 ">
                    <label for="password">Password</label>
                    <input type="password" class="form-control lginput" id="password" name="password"
                        placeholder="Password" required>
                </div>
                <div class="col my-2 ">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" class="form-control lginput" id="cpassword" name="cpassword"
                        placeholder="Confirm Password" required>
                    <small id="emailHelp" class="form-text text-muted">
                        Make sure to type the same password
                    </small>
                </div>
            </div>
            <div class="form-col">
                <div class="form-group my-2 d-flex justify-content-center">
                    <button type="submit" class="btn my-2 mx-3 loginbtn">SignUp</button>
                </div>
                <P class="account text-center">Already have an account ? <a href="sellerlogin.php">Login Here</a></P>
            </div>


        </form>

    </div>
    <footer class="py-3 bg-dark text-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="small">
                        <div class="text-center fs-6">Copyright &copy; shopping 2021</div>
                    </div>
                </div>
            </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>