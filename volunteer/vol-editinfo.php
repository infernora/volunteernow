<?php 
session_start();

	include("connection.php");
	include("vol-functions.php");
    include("checkstatus.php");

    $user_data = check_vollogin($con);

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = $user_data['email'];
        $name = stripslashes($_POST['name']);
        $phone = stripslashes($_POST['phone']);
        $location = stripslashes($_POST['location']);
        $dob = $_POST['dob'];
        $password = $_POST['password'];

        $sql3 = "UPDATE volunteer SET name = '$name', phone = '$phone' , location = '$location' , dob = '$dob', password = '$password' where email = '$email'";
        $res3 = mysqli_query($con, $sql3);
        header("Location: vol-info.php");
	    die;             
        }
                   
?>

<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/login.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body>
    <header class="site-header">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-8 col-12 d-flex flex-wrap">
                        <p class="d-flex me-4 mb-0">
                            <i class="bi-geo-alt me-2"></i>
                            Banani, Dhaka, Bangladesh
                        </p>

                        <p class="d-flex mb-0">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:volunteernow@mail.com">
                                volunteernow@mail.com
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-youtube"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Edit Info</h3>
                    <form method="post">

                        <div class="form-group">
                            <label for="form-group-input">Email:</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $user_data['email']; ?>"disabled>
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Password:</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user_data['password']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Name:</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $user_data['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Phone:</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $user_data['phone']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Location:</label>
                            <input type="text" class="form-control" name="location" value="<?php echo $user_data['location']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Date of Birth:</label>
                            <input type="date" class="form-control" name="dob" value="<?php echo $user_data['dob']; ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Confirm">
                        </div>

                        <div class="form-group">
                            <a href="vol-info.php"> Go Back </a>
                        </div>

                    </form>

                </div>   
            </div>
        </div> 
        
        <script>
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
        </script> 
    </body>
</html>