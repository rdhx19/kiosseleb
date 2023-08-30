<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8" />
        <title><?php echo $config['nama_web']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="<?php echo $config['tentang_web']; ?>" name="description" />
        <meta content="Muhammad Ridho Hakim" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/rkioss.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <a href="javascript:void(0);" class="logo">
                           <span class="logo-small"><img src="assets/images/rkioss.ico" height="45px" width="45px;"></imgsrc></span>
                            <span class="logo-large"><img src="assets/images/rkioss.ico" height="45px" width="45px;"></imgsrc> <?php echo $config['nama_web']; ?></span>
                        </a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li class="menu-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>
                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
<?php require_once("config/web/menu-luar.php"); ?>
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo $config['nama_web']; ?></a></li>
                                    <li class="breadcrumb-item active">Halaman Utama</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Halaman Utama</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
<?php
$pageu = md5('page');
$getid = $_GET[$pageu] ?? ''; 
$page = base64_decode($getid);

	if($page == "harga"){
		require_once("func/page/price.php");
	}  else if($page == "masuk"){
		require_once("func/page/login.php");
	} else if($page == "lupa-password"){
		require_once("func/page/forgot.php");
	} else if($page == "daftar"){
		require_once("func/page/register.php");
	} else if($page == "ketentuan"){
		require_once("func/page/terms.php");
	} else if($page == "kontak"){
		require_once("func/page/contact.php");
	} else {
		require_once("func/page/dashboard.php");
	}
?>
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/toggledoc.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <!-- Counter number -->
        <script src="plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Chart JS -->
        <script src="plugins/chart.js/chart.bundle.js"></script>

        <!-- init dashboard -->
        <script src="assets/pages/jquery.dashboard.init.js"></script>


        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </body>

<!-- Dilarang Keras Merubah Semuanya, © S1L3NT -->
</html>