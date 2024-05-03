<?php 
session_start();

	include("connection.php");
	include("org-functions.php");
    include("checkstatus.php");

    $user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$name = $user_data['name'];
		$password = $_POST['password'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $description = $_POST['description'];
        $website = $_POST['website'];
        $causelist = $_POST['causelist'];

        if (count($causelist) == 0){
            $cause_one = Null;
            $cause_two = Null;
            $cause_three = Null;
        }
        else if (count($causelist) == 1){
            $cause_one = $causelist[0];
            $cause_two = Null;
            $cause_three = Null;
        }
        else if (count($causelist) == 2){
            $cause_one = $causelist[0];
            $cause_two = $causelist[1];
            $cause_three = Null;
        }
        else {
            $cause_one = $causelist[0];
            $cause_two = $causelist[1];
            $cause_three = $causelist[2];
        }

        $sql3 = "UPDATE organization SET password = '$password', email = '$email' , address = '$address' , description = '$description',
                website = '$website', cause_one = '$cause_one', cause_two = '$cause_two', cause_three = '$cause_three' where name = '$name'";
        $res3 = mysqli_query($con, $sql3);
        header("Location: org-info.php");
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
                            <label for="form-group-input">Name:</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $user_data['name']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Password:</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user_data['password']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Email:</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $user_data['email']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Address:</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $user_data['address']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Description:</label>
                            <input type="text" class="form-control" name="description" value="<?php echo $user_data['description']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Website:</label>
                            <input type="text" class="form-control" name="website" value="<?php echo $user_data['website']; ?>">
                        </div>

                        <div class="form-group">
                        <p>Causes: (Pick any three)<br></p>
                        <?php 
                            $query ="SELECT causename FROM cause";
                            $result = $con->query($query);
                            if($result->num_rows> 0){
                            $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                            } 
                            ?>
                            <?php 
                            foreach ($options as $option) {
                                if ($option['causename'] == $user_data['cause_one'] or $option['causename'] == $user_data['cause_two'] or $option['causename'] == $user_data['cause_three']){
                             ?>
                                <input type="checkbox" class="check" name="causelist[]" value="<?php echo $option['causename']; ?>" checked>
                                <label for="<?php echo $option['causename']; ?>"><?php echo $option['causename']; ?> </label>
                            <?php 
                                }
                            else {
                                ?>
                                <input type="checkbox" class="check" name="causelist[]" value="<?php echo $option['causename']; ?>">
                                <label for="<?php echo $option['causename']; ?>"><?php echo $option['causename']; ?> </label>
                                <?php
                            }
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Confirm">
                        </div>

                        <div class="form-group">
                            <a href="org-info.php"> Go Back </a>
                        </div>

                    </form>

                </div>   
            </div>
        </div> 
        
        <script>
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }

            var checks = document.querySelectorAll(".check");
            var max = 3;
            for (var i = 0; i < checks.length; i++)
                checks[i].onclick = selectiveCheck;

            function selectiveCheck (event) {
                var checkedChecks = document.querySelectorAll(".check:checked");
                if (checkedChecks.length >= max + 1)
                    return false;
            }

        </script> 
    </body>
</html>