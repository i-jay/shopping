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
    .form {
        min-height: 310px;
    }

    p {
        margin-top: 0;
        margin-bottom: 20px;
    }
    .form-group button{
      background: #ffe500; 
      color: black;
      font-size: 18px;
    }

    @media (min-width: 768px) {

        .col-md-6,
        .col-md-2 {
            margin: auto;
        }

        .live {
            margin-bottom: 1.2rem !important;
           
        }

        .livebtn {
            margin-bottom: 1.2rem !important;
        }

        .loginbtn {
            width: 250px;
        }

        .lginput {
            width: 400px;
            margin-top: 7px;
        }
        /* .account{
            text-align: center;
            margin-left:-120px ;
         } */
    }
</style>
  </head>
  <body>
    <?php include './assets/navbar.php'; ?>

    <div class="container mt-4 pt-3 d-flex align-items-center justify-content-center flex-column">
        <h2 class="text-center my-4 mb-0 account">Login to Shopping</h2>
        <form class="align-items-center form my-2" method="post" action="login.php">
            <div class="form-col">
                <div class="col my-2 live">
                    <label for="username">Username</label>
                    <input type="text" class="form-control lginput" id="username" name="username" maxlength = "15" placeholder="Username"
                        required>
                </div>
                <div class="col my-2 live">
                    <label for="password">Password</label>
                    <input type="password" class="form-control lginput" id="password" name="password" maxlength = "20" placeholder="Password" required>
                </div>
                <div class="form-group my-2 livebtn d-flex justify-content-center">
                    <button type="submit" class="btn my-2 mx-3 loginbtn">Login</button>
                </div>
                <P class="account text-center">Don't have an account ? <a href="signup.php">SignUp Here</a></P>
            </div>

                
        </form>

    </div>


    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
  </body>
</html>