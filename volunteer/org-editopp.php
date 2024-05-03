<?php 
session_start();

	include("connection.php");
	include("org-functions.php");
    include("checkstatus.php");

    $user_data = check_login($con);

    if(isset($_GET['edit'])){
        $oppid = $_GET['edit'];
        $sql = "SELECT * FROM opportunity WHERE oppid='$oppid'";
        $result = $con->query($sql);
      
        if ($result->num_rows > 0){
      
            $row = $result->fetch_assoc();

            $name = $row["name"];
            $location = $row["location"];
            $description = $row["description"];
            $skill = $row["skill"];
            $org_name = $row["org_name"];
            $vol_num = $row["vol_num"];
            $vol_found = $row["vol_found"];
            $startdate = $row["startdate"];
            $enddate = $row["enddate"];
            $status = $row["status"];
        } else {
          echo "Not Found";
        }
    } 

    if(isset($_POST['submit']))
    {
        $name = $_POST["name"];
        $location = $_POST["location"];
        $description = $_POST["description"];
        $skill = $_POST["skill"];
        //$org_name = $_POST["org_name"];
        $vol_num = $_POST["vol_num"];
        //$vol_found = $_POST["vol_found"];
        $startdate = $_POST["startdate"];
        $enddate = $_POST["enddate"];
        $status = $_POST["status"];

        $sql = "UPDATE opportunity SET name='$name', location='$location', description='$description', 
                skill='$skill', vol_num='$vol_num', status='$status', startdate='$startdate', enddate='$enddate'
                WHERE oppid='$oppid'";

        $rs = mysqli_query($con, $sql);

        if ($rs && $status == 'open'){
            header("Location: org-index.php");
            die;
        }
        else if ($rs && $status == 'closed'){
            header("Location: org-index.php");
            die;
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
                    <h3>Edit Info</h3>
                    <form method="post">

                        <div class="form-group">
                            <label for="form-group-input">Name:</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Lcation:</label>
                            <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Description:</label>
                            <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                            
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Skill:</label>
                            <input type="text" class="form-control" name="skill" value="<?php echo $skill; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Number of Volunteers Needed:</label>
                            <input type="number" class="form-control" name="vol_num" value="<?php echo $vol_num; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Start Date:</label>
                            <input type="date" class="form-control" name="startdate" value="<?php echo $startdate; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">End Date:</label>
                            <input type="date" class="form-control" name="enddate" value="<?php echo $enddate; ?>">
                        </div>

                        <div class="form-group">
                            <label for="form-group-input">Status:</label>
                            <select class="form-control" name="status">
                                <option selected><?php echo $status ?></option>
                                <option>open</option>
                                <option>closed</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" name="submit" value="Confirm">
                        </div>

                        <div class="form-group">
                            <a href="org-index.php"> Go Back </a>
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