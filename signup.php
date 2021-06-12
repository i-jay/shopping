<?php
$exist_email = false ;
$invalidpass = false ;
include './assets/dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $phoneno = $_POST['phoneno'];
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];

$checkemail = "SELECT * FROM `users` WHERE `email` = '$email' ";
$result = mysqli_query($conn, $checkemail);
$row = mysqli_num_rows($result);
    if($row == 0){
        if($password == $cpassword ){
            $insert = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `phone_number`, `password`,`created_at`) VALUES ('$fname', '$lname','$email',$phoneno,'$password',current_timestamp())";
            $result = mysqli_query($conn, $insert);
            if($result){
                session_start();
                $sql2 = "SELECT * FROM `users` WHERE `email` = '$email' ";
                $result2 = mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($result2);
                $userid = $row['user_id'];
                $_SESSION['userid'] = $userid ;
                $_SESSION['loggedin'] = true ;
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

    <title>Hello, world!</title>
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
    <?php include './assets/navbar.php';
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
            <h2 class="text-center my-1 mb-4">SignUp</h2>
        </div>
        <form class="align-items-center form" method="post" action="signup.php">
            <div class="form-col">
                <div class="row">
                    <div class="col">
                        <label for="fname">First Name</label>
                        <input type="text" class="nameinput form-control" id="fname" name="fname" maxlength="15"
                            placeholder="First Name" required>
                    </div>
                    <div class="col d-flex flex-column">
                        <label for="lname">Last Name</label>
                        <input type="text" class="nameinput form-control" id="lname" name="lname" maxlength="15"
                            placeholder="Last Name" required>
                    </div>
                </div>
                <div class="form-group my-1 ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control lginput" id="email" name="email" maxlength="20"
                        placeholder="Email" required>
                </div>
                <div class="form-group my-1 ">
                    <label for="phoneno">Phone Number</label>
                    <input type="text" class="form-control lginput" id="phoneno" name="phoneno" maxlength="15"
                        placeholder="Phone Number" required>
                </div>
                <div class="col my-2 ">
                    <label for="password">Password</label>
                    <input type="password" class="form-control lginput" id="password" name="password" maxlength="20"
                        placeholder="Password" required>
                </div>
                <div class="col my-2 ">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" class="form-control lginput" id="cpassword" name="cpassword" maxlength="20"
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
                <P class="account text-center">Already have an account ? <a href="login.php">Login Here</a></P>
            </div>


        </form>

    </div>

    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>