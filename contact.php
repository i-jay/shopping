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

    <title>Contact Us</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .form {
            min-height: 490px;
        }
        .form-group button{
            background: #ffe500; 
            color: black;
        }
        .form-control:focus
         {
            border-color: rgba(0, 0, 0, 0.8);
            box-shadow: none;
            outline: 0 none;
        }
        .form-group button:focus{
            border-color: transparent;
            box-shadow: none;
            outline: 0 none;
        }
        .form-control{
            width: 450px;
        }
        .contactinput{
            margin-top: 7px;
        }   
         </style>
</head>

<body>
    <?php include './assets/navbar.php'; ?>

    <div class="d-flex align-items-center justify-content-center mt-3 flex-column">
        <h2 class="text-center my-1 ">Contact Us</h2>
        <form class="align-items-center form" method="post" action="contact.php">
            <div class="form-col">
                <div class="col col-md-6 my-2">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control contactinput" id="fname" name="fname" placeholder="First name" required>
                </div>
                <div class="col col-md-6 my-2">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control contactinput" id="lname" name="lname" placeholder="Last name" required>
                </div>
            </div>
            <div class="form-col">
                <div class="form-group col-md-6 my-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control contactinput" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="col col-md-6 my-2 d-block">
                    <label for="subjcet">Subject</label>
                    <input type="text" class="form-control contactinput" id="subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group col-md-6 my-10">
                    <label for="message">Message</label>
                    <textarea class="form-control contactinput" id="message" name="message" rows="3" placeholder="Write your query"
                        required></textarea>
                </div>

                <div class="form-group col-md-6 my-2">
                    <button type="submit" class="btn my-2 mx-3">Send Message</button>
                </div>
            </div>    
        </form>

    </div>

    <?php include './assets/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>