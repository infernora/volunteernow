<?php
session_start();

    include("connection.php");
    include("org-functions.php");
    include("checkstatus.php");

    $user_data = check_login($con);  
    
    if(isset($_GET['details'])){
        $oppid  = $_GET['details'];}
    
    $sql2 = "SELECT appid, opportunity.name AS oppname, application.status, volunteer.name AS volname, 
        email, phone, volunteer.location, dob FROM application, opportunity, volunteer WHERE application.oppid = '$oppid' 
        AND application.vol_email = volunteer.email AND opportunity.oppid = '$oppid' AND (application.status = 'accepted' OR application.status = 'completed' OR application.status = 'accepted(event_closed)')";

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
                            <a class="nav-link" href="org-index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="org-index.php">About</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="" id="navbarLightDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Events</a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="org-eventhis-past.php">Past Events</a></li>
                                <li><a class="dropdown-item active" href="org-eventhis-present.php">Ongoing/<br>Upcoming Events</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="org-postopp.php">Post Opportunities</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link custom-btn custom-border-btn btn" href="" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user_data['name']; ?></a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="org-info.php">Information</a></li>
                                <li><a class="dropdown-item" href="org-pendingreq.php">Pending Requests</a></li>
                                <li><a class="dropdown-item" href="org-logout.php">Logout</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main>

        <section class="pending-req-list">
          
        <div class = "table-container">
        <a href="org-eventhis-present.php">Go Back</a>      
        <table class="styled-table">
            <thead>
                <tr>
                    <th><a href="">Opportunity</a></th>
                    <th><a href="">Name</a></th>
                    <th><a href="">Email</a></th>
                    <th><a href="">Location</a></th>
                    <th><a href="">Phone</a></th>
                    <th><a href="">Date of Birth</a></th>
                    <th><a href="">Status</a></th>

                </tr>
            </thead>
            <tbody>
                <?php

                $result1 = mysqli_query($con, $sql2);
                while ($row = $result1->fetch_assoc()) {
                    $oppname = $row['oppname'];
                    $volname = $row['volname'];
                    $email = $row['email'];
                    $location = $row['location'];
                    $phone = $row['phone'];
                    $dob = $row['dob'];
                    $status = $row['status'];
                    $appid = $row['appid']

                ?>
                <tr>
                    <td><?php echo $oppname; ?></td>
                    <td><?php echo $volname; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $location; ?></td>
                    <td><?php echo $phone; ?></td>
                    <td><?php echo $dob; ?></td>
                    <td><?php echo $status; ?></td>
                    
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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

        <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        </script> 

    </body>
</html>