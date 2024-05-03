<?php 
session_start();

	include("connection.php");
	include("vol-functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $dob = $_POST['dob'];

		if(!empty($email) && !empty($password) && !is_numeric($email))
		{

			//save to database
			$vid = random_volnum(20);
			$query = "insert into volunteer (vid,email,password,name,phone,location,dob) values ('$vid','$email','$password','$name','$phone','$location','$dob')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<html>
    <head>

        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/login.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
                    <h3>Volunteer Sign Up</h3>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Your Email *" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name *" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Your Phone *" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="location" placeholder="Your Location *" required>
                        </div>

                        <div class="form-group">
                            <input type="date" class="form-control" name="dob" placeholder="Your Date of Birth *" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Register">
                        </div>

                        <div class="form-group">
                            <a href="login.php"> Go Back</a>
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