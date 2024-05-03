<?php
session_start();

include("connection.php");
include("vol-functions.php");
include("checkstatus.php");


$user_data = check_vollogin($con);   
$email = $user_data['email']                   
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>VolunteerNow!</title>

        <!-- CSS FILES -->   
             
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        

    </head>
    
    <body id="section_1">

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

        <nav class="navbar navbar-expand-lg bg-light shadow-lg">
            <div class="container">
                    <a class="navbar-brand" href="index.html"> 
                  <!--  <a href="#" class="bi-heart-half"></a> -->
                    <img src="images/stickerlogo_volunteernow.png" class="logo img-fluid" alt="Volunteer Now!">
                    <span>
                        Volunteer Now!
                        <small>Non-profit Organization</small>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="vol-index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="vol-orginfo.php">Organizations</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="vol-opp.php">Opportunities</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link custom-btn custom-border-btn btn" href="" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user_data['name']; ?></a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="vol-info.php">Information</a></li>
                                <li><a class="dropdown-item active" href="vol-projects.php">Projects</a></li>
                                <li><a class="dropdown-item" href="vol-logout.php">Logout</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main>

        <section class="p-5">
            <div class="border-bottom p-2 bg-light mb-3">
                <div class="row list" style="text-align:center">
                    <form class="filterform" method="post" action="vol-projects.php">
                        <input type="text" id="filter" name="filter" placeholder="filter" tabindex="0"/>
                        <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
                        <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filter"/>
                    </form>
                </div>
            </div>
            <div class="row list">
                <div class="col-md-12">

                    <?php
                        
                        $sql2 = "SELECT opportunity.name, opportunity.location, opportunity.skill, opportunity.description, opportunity.vol_num, opportunity.vol_found,
                                 opportunity.startdate, opportunity.enddate, opportunity.oppid, opportunity.org_name, application.status FROM application, opportunity";
                        if(isset($_POST["Clearbutton"])){
                            unset($_SESSION["filter"]);
                        }

                        if(isset($_POST['filter'])){
                            $filter = $_POST['filter'];
                            $sql2 .= " WHERE opportunity.oppid = application.oppid  AND application.vol_email = '$email' AND (name LIKE '%{$filter}%' OR location LIKE '%{$filter}%' OR skill LIKE '%{$filter}%' OR description LIKE '%{$filter}%'
                                    OR startdate LIKE '%{$filter}%' OR enddate LIKE '%{$filter}%' OR vol_num LIKE '%{$filter}%' or vol_found LIKE '%{$filter}%' or opportunity.org_name LIKE '%{$filter}%' or application.status LIKE '%{$filter}%')";
                            $_SESSION['filter'] = $filter;
                        }else{
                            $sql2 .= " WHERE application.oppid = opportunity.oppid AND application.vol_email = '$email'";
                        }

                        $result2 = mysqli_query($con, $sql2);
                        while ($row = $result2->fetch_assoc()) {
                            $name = $row['name'];
                            $location = $row['location'];
                            $skill = $row['skill'];
                            $description = $row['description'];
                            $vol_num = $row['vol_num'];
                            $start_date = $row['startdate'];
                            $end_date = $row['enddate'];
                            $status = $row['status'];
                            $vol_found = $row['vol_found'];
                            $oppid = $row['oppid'];   
                            $org_name = $row['org_name'];
                            $today = date('Y-m-d');

                            if ($status == 'accepted' && $end_date < $today){ 
                                $sql3 = "UPDATE application SET status = 'completed' WHERE oppid = '$oppid' AND vol_email = '$email'";
                                $result3 = mysqli_query($con, $sql3); 
                                $status = 'completed';
                            } else if ($status == 'pending' && $end_date < $today){ 
                                $sql3 = "UPDATE application SET status = 'date_passed' WHERE oppid = '$oppid' AND vol_email = '$email'";
                                $result3 = mysqli_query($con, $sql3); 
                                $status = 'date passed';
                            }
                    ?>

                    <!-- Opp list -->
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="ms-3 ms-md-4">
                        
                        <!-- accept and date passes-completed-blue, accept and upcoming: green, pending and date passed-date_passed-red, pending and upcoming: gray, rejected: red -->


                        <?php if ($status == 'completed'){ ?>
                            <input  type="submit" name="apply" class="custom-btn btn" style="float:right; color:green;" disabled value="<?php echo $status ?>"></input>
                            <h3 style="color:green;"><?php echo $name; ?></h3>
                        <?php
                        } else if ($status == 'accepted' && $end_date > $today){ ?>
                            <input  type="submit" name="apply" class="custom-btn btn" style="float:right; color:blue;" disabled value="<?php echo $status ?>"></input>
                            <h3 style="color:blue;"><?php echo $name; ?></h3>
                        <?php                       
                        } else if ($status == 'pending' && $end_date > $today){ ?>
                            <input  type="submit" name="apply" class="custom-btn btn" style="float:right;" disabled value="<?php echo $status ?>"></input>
                            <h3 style=""><?php echo $name; ?></h3>
                        <?php                       
                        } else if ($status == 'date_passed'){ ?>
                            <input  type="submit" name="apply" class="custom-btn btn" style="float:right;" disabled value="date passed"></input>
                            <h3 style=""><?php echo $name; ?></h3>
                        <?php                       
                        } else if ($status == 'rejected'){ ?>
                            <input  type="submit" name="apply" class="custom-btn btn" style="float:right; color:red;" disabled value="<?php echo $status ?>"></input>
                            <h3 style="color:red;"><?php echo $name; ?></h3>
                        <?php                       
                        } else if ($status == 'accepted(event_closed)' OR $status == 'pending(event_closed)' ){ ?>
                            <input  type="submit" name="apply" class="custom-btn btn" style="float:right; color:red;" disabled value="event closed"></input>
                            <h3 style="color:red;"><?php echo $name; ?></h3>
                        <?php                       
                        } ?>
                            <p class="mb-2 text-dark text-opacity-75" >Location: <?php echo $location; ?></p>
                            <p class="mb-2 text-dark text-opacity-75">Organization: <?php echo $org_name; ?></p>
                            <p class="mb-2 text-dark text-opacity-75">Skills needed: <?php echo $skill; ?></p>
                            <p class="mb-2 text-dark text-opacity-75" style="float:left">Total Number of volunteers needed:<b> <?php echo $vol_num; ?> </b></p>
                            <p class="mb-2 text-dark text-opacity-75"> &nbsp;&nbsp; Number of volunteers found:<b> <?php echo $vol_found; ?> </b></p>
                            <p class="mb-2 text-dark text-opacity-75" style="float:left"> Start Date: <?php echo $start_date; ?></p>
                            <p class="mb-2 text-dark text-opacity-75"> &nbsp;&nbsp; End Date: <?php echo $end_date; ?></p>
                            <p class="mb-2 text-dark text-opacity-75">Description: <?php echo $description; ?></p>
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </section>



        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 mb-4">
                        <img src="images/logo.png" class="logo img-fluid" alt="">
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <h5 class="site-footer-title mb-3">Quick Links</h5>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Our Story</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Causes</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Become a volunteer</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Partner with us</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mx-auto">
                        <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                        <p class="text-white d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            <a href="tel: 120-240-9600" class="site-footer-link">
                                01928374681
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                donate@volunteernow.org
                            </a>
                        </p>

                        <p class="text-white d-flex mt-3">
                            <i class="bi-geo-alt me-2"></i>
                            Banani, Dhaka, Bangladesh
                        </p>

                        <a href="#" class="custom-btn btn mt-3">Get Direction</a>
                    </div>
                </div>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-7 col-12">
                            <p class="copyright-text mb-0">Volunteer Now!</p>
                        </div>
                        
                        <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto">
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
                                    <a href="#" class="social-icon-link bi-linkedin"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="https://youtube.com/templatemo" class="social-icon-link bi-youtube"></a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script>

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        </script> 

    </body>
</html>