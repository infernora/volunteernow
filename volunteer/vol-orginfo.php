<?php
session_start();


    include("connection.php");
    include("vol-functions.php");
    include("checkstatus.php");

    $user_data = check_vollogin($con);
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
                            <a class="nav-link active" href="vol-orginfo.php">Organizations</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="vol-opp.php">Opportunities</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link custom-btn custom-border-btn btn" href="" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user_data['name']; ?></a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="vol-info.php">Information</a></li>
                                <li><a class="dropdown-item" href="vol-projects.php">Projects</a></li>
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
            <div class="row">
                <div class="col-md-8">
                <h3 class="fs-5 my-1">Our Partner Organizations:</h3>
                </div>
                <div class="row list" style="text-align:center; padding-bottom: 25px;">
                    <form class="filterform" method="post" action="vol-orginfo.php">
                        <input type="text" id="filter" name="filter" placeholder="filter" tabindex="0"/>
                        <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
                        <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filter"/>
                    </form>
                </div>
            </div>
            </div>
            <div class="row list">
                <div class="col-md-12">

                    <?php

                    $sql1 = "SELECT * FROM organization";
                    if(isset($_POST["Clearbutton"])){
                        unset($_SESSION["filter"]);
                    }

                    if(isset($_POST['filter'])){
                        $filter = $_POST['filter'];
                        $sql1 .= " WHERE (name LIKE '%{$filter}%' OR email LIKE '%{$filter}%' OR address LIKE '%{$filter}%' OR description LIKE '%{$filter}%'
                                OR website LIKE '%{$filter}%' OR cause_one LIKE '%{$filter}%' OR cause_two LIKE '%{$filter}%' or cause_three LIKE '%{$filter}%')";
                        $_SESSION['filter'] = $filter;
                    }
                        //$sql1 = "SELECT * FROM organization";
                        $result1 = mysqli_query($con, $sql1);
                        //$count = 1;
                        while ($row = $result1->fetch_assoc()) {
                            $name = $row['name'];
                            $email = $row['email'];
                            $address = $row['address'];
                            $description = $row['description'];
                            $website = $row['website'];
                            $cause_one = $row['cause_one'];
                            $cause_two = $row['cause_two'];
                            $cause_three = $row['cause_three'];
                        ?>

                    <!-- Org list -->
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <h2 class="display-4 fa-fw fw-bolder text-end text-light-stroke"><?php echo $name; ?></h2>

                        <div class="ms-3 ms-md-4">

                            <a class="mb-2 text-dark text-opacity-75" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                            <br>

                                <?php if ($website != Null) {
                                ?>
                                <a class="mb-2 text-dark text-opacity-75" href="<?php echo $website; ?>"><?php echo $website; ?></a>
                                <br>
                                <?php   
                            }?>

                            <p class="mb-2 text-dark text-opacity-75"><?php echo $address; ?></p>

                            <p class="mb-2 text-dark text-opacity-75"><?php echo $description; ?></p>

                            <?php if ($cause_one != Null) {
                                ?>
                                <p class="nav-link d-inline-block me-4 p-0 text-black-50 fs-xs"><i class="bi-heart-half me-2"></i><?php echo $cause_one; ?></p>
                                <?php
                            }?>

                            <?php if ($cause_two != Null) {
                                ?>
                                <p class="nav-link d-inline-block me-4 p-0 text-black-50 fs-xs"><i class="bi-heart-half me-2"></i><?php echo $cause_two; ?></p>
                                <?php
                            }?>

                            <?php if ($cause_three != Null) {
                                ?>
                                <p class="nav-link d-inline-block me-4 p-0 text-black-50 fs-xs"><i class="bi-heart-half me-2"></i><?php echo $cause_three; ?></p>
                                <?php
                            }?>
                            
                        </div>
                    </div>
                    <?php
                            //$count += 1;
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

        <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        </script>

    </body>
</html>