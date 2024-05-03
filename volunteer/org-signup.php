<?php 
session_start();

	include("connection.php");
	include("org-functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$name = $_POST['name'];
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

		if(!empty($name) && !empty($password) && !is_numeric($name))
		{

			//save to database
			$org_id = random_num(20);
			$query = "insert into organization (org_id,name,password,email,address,description,website,cause_one,cause_two,cause_three) values 
            ('$org_id','$name','$password','$email','$address','$description','$website','$cause_one','$cause_two','$cause_three')";

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
                    <h3>Organization Sign Up</h3>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Organization name *" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" required>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email *" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Address *" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="description" placeholder="Description *" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="website" placeholder="Website">
                        </div>

                        <div class="form-group">
                        <p>Causes: (Pick any three)<br></p>
                        <?php 
                            $query ="SELECT causename FROM cause";
                            $result = $con->query($query);
                            if($result->num_rows> 0){
                            $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                            } 
                            $i = 0;
                            ?>
                             
                                <?php 
                                foreach ($options as $option) {
                                    $i = $i + 1; ?>
                                    <input  type="checkbox" class="check" id="<?php echo $option['causename']; ?>" name="causelist[]" value="<?php echo $option['causename']; ?>" >
                                    <label for="<?php echo $option['causename']; ?>"><?php echo $option['causename']; ?> </label>
                                    <?php 
                                }
                                ?>
                            
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