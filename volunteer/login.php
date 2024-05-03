<?php 
    session_start();

	include("connection.php");
	include("org-functions.php");
    include("vol-functions.php");

    if(isset($_SESSION['org_id']))
    {
	unset($_SESSION['org_id']);
    }
    if(isset($_SESSION['vid']))
    {
	unset($_SESSION['vid']);
    }


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        if ($_POST['type'] == 'org')
        {       
            $name = $_POST['name'];
            $password = $_POST['password'];

            if(!empty($name) && !empty($password) && !is_numeric($name))
            {

                $query = "select * from organization where name = '$name' limit 1";
                
                $result = mysqli_query($con, $query);
                
                if($result)
                {
                    if($result && mysqli_num_rows($result) > 0)
                    {
                        $user_data = mysqli_fetch_assoc($result);

                        if($user_data['password'] == $password)
                        {
                            
                            $_SESSION['org_id'] = $user_data['org_id'];
                            header("Location: org-index.php");
                            die;
                        }
                    }
                }
            }
            else 
            {
                echo "Wrong username or password!";
            }
        }
        else if ($_POST['type'] == 'vol')
        {
            //taking inputs for db tables data comparison
            //asking if something was posted
        
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!empty($email) && !empty($password) && !is_numeric($email))
            {
                $query = "select * from volunteer where email = '$email' limit 1";
                
                $result = mysqli_query($con, $query);
                
                if($result)
                {
                    if($result && mysqli_num_rows($result) > 0)
                    {
                        $user_data = mysqli_fetch_assoc($result);

                        if($user_data['password'] == $password)
                        {
                            
                            $_SESSION['vid'] = $user_data['vid'];
                            header("Location: vol-index.php");
                            die;
                        }
                    }
                }
            }
            else 
            {
                echo "Wrong username or password!";
            }
        } 
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
                    <h3>Organization Login</h3>
                    <form method="post">
                        <input type="text" name="type" value="org" hidden>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name *" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="orginfo" class="btnSubmit" value="Login">
                        </div>

                        <div class="form-group">
                            <p>Have not registered your organization?<a href="org-signup.php"> Register now</a>.</p>
                        </div>

                        <div class="form-group">
                            <p>Or<a href="index.php"> Go Back</a>.</p>
                        </div>
                    </form>
                </div>


                <div class="col-md-6 login-form-2">
                    <h3>Volunteer Login</h3>
                    <form method="post">
                        <input type="text" name="type" value="vol" hidden>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Your Email *" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password *" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login">
                        </div>

                        <div class="form-group">
                            <p>Have not registered as a volunteer?<a href="vol-signup.php"> Register now</a>.</p>
                        </div>
                        
                        <div class="form-group">
                            <p>Or<a href="index.php"> Go Back</a>.</p>
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