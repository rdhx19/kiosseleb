<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8" />
        <title><?php echo $config['nama_web']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="<?php echo $config['tentang_web']; ?>" name="description" />
        <meta content="Muhammad ridho hakim" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/rkioss.ico">

        <!-- DataTables -->
        <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

       <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/morris/morris.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>        
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript" src="http://code.highcharts.com/modules/exporting.js"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        <script src="https://code.highcharts.com/highcharts.src.js"></script> 

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
    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="javascript:void(0);" role="button"
           aria-haspopup="false" aria-expanded="false">
            <i class="mdi mdi-account"></i> <span><?php echo $sess_username; ?> <i class="mdi mdi-chevron-down"></i></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!-- item-->
            <a href="?<?php echo paramEncrypt('content=pengaturan')?>" class="dropdown-item notify-item">
                <i class="fi-cog"></i> <span>Settings</span>
            </a>

            <!-- item-->
            <a href="<?php echo $config['url_web']; ?>logout.php" class="dropdown-item notify-item">
                <i class="fi-power"></i> <span>Logout</span>
            </a>

        </div>
    </li>
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
<?php require_once("config/web/menu-dalam.php"); ?>
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
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
    <h4 class="page-title">Dashboard</h4>
</div>
</div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
<div class="col-md-6">
<div class="card-box tilebox-one">
    <i class="fa fa-user float-right"></i>
    <h6 class="text-muted text-uppercase mb-3">Total Seluruh Pengguna</h6>
    <h4 class="mb-3">1.639</h4>
</div>
</div>
<div class="col-md-6">
<div class="card-box tilebox-one">
    <i class="fa fa-money float-right"></i>
    <h6 class="text-muted text-uppercase mb-3">My Balance</h6>
    <h4 class="mb-3">Rp <?php echo number_format($data_user['balance'],0,',','.'); ?></h4>
</div>
</div>
</div>
<?php

$var=decode($_SERVER['REQUEST_URI']);

$content=$var['content'] ?? '';
$staff=$var['staff'] ?? '';
$control=$var['control'] ?? '';

$sit = md5('admin');
$getu = $_GET[$sit] ?? '';
$admin = base64_decode($getu);

$u = md5('topup');
$p = $_GET[$u] ?? '';
$topup = base64_decode($p);

	if($content == "pengaturan"){
		require_once("func/content/setting.php");
	} else if($content == "hof"){
		require_once("func/content/hof.php");
	} else if($content == "voucher"){
		require_once("func/content/voucher.php");
	} else if($content == "order"){
		require_once("func/content/order.php");
	} else if($content == "riwayat"){
		require_once("func/content/order_history.php");
	} else if($content == "harga"){
		require_once("func/content/price.php");
	} else if($content == "apidok"){
		require_once("func/content/api.php");
	} else if($content == "order-pulsa"){
		require_once("func/content/order_pulsa.php");
	} else if($content == "riwayat-pulsa"){
		require_once("func/content/order_history_pulsa.php");
	} else if($content == "harga-pulsa"){
		require_once("func/content/price_pulsa.php");
	} else if($content == "apidok-pulsa"){
		require_once("func/content/api_pulsa.php");
	} else if($content == "view"){
		require_once("func/content/view.php");
	} else if($topup == "deposit"){
		require_once("func/content/deposit.php");
	} else if($topup == "riwayat-deposit"){
		require_once("func/content/deposit_history.php");
	} else if($admin == "adduser"){
		require_once("func/content/add_user.php");
	} else if($admin == "grafik"){
		require_once("func/control/grafik.php");
	} else if($admin == "catatan"){
		require_once("func/control/catatan.php");
	} else if($admin == "voucher"){
		require_once("func/control/voucher.php");
	} else if($admin == "users"){
		require_once("func/control/users/users.php");
	} else if($admin == "services"){
		require_once("func/control/services/services.php");
	} else if($admin == "orders"){
		require_once("func/control/orders/orders.php");
	} else if($admin == "services-pulsa"){
		require_once("func/control/services_pulsa/services.php");
	} else if($admin == "orders-pulsa"){
		require_once("func/control/orders_pulsa/orders.php");
	} else if($admin == "news"){
		require_once("func/control/news/news.php");
	} else if($admin == "deposithis"){
		require_once("func/control/deposit/deposit.php");
	} else if($staff == "voucher"){
		require_once("func/control/voucher.php");
	} else if($staff == "transfers"){
		require_once("func/control/transfers.php");
	} else if($staff == "transfer"){
		require_once("func/control/transfer.php");
	} else if($control == "add-news"){
		require_once("func/control/news/add.php");
	} else if($control == "delete-news"){
		require_once("func/control/news/delete.php");
	} else if($control == "add-services"){
		require_once("func/control/services/add.php");
	} else if($control == "delete-services"){
		require_once("func/control/services/delete.php");
	} else if($control == "add-services-pulsa"){
		require_once("func/control/services_pulsa/add.php");
	} else if($control == "delete-services-pulsa"){
		require_once("func/control/services_pulsa/delete.php");
	} else if($control == "add-users"){
		require_once("func/control/users/add.php");
	} else if($control == "delete-users"){
		require_once("func/control/users/delete.php");
	} else if($control == "add-depo"){
		require_once("func/control/depo_method/add.php");
	} else if($control == "delete-depo"){
		require_once("func/control/depo_method/delete.php");
	} else {
		require_once("func/content/dashboard.php");
	}
?>
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/toggledoc.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <!-- Required datatable js -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="plugins/datatables/jszip.min.js"></script>
        <script src="plugins/datatables/pdfmake.min.js"></script>
        <script src="plugins/datatables/vfs_fonts.js"></script>
        <script src="plugins/datatables/buttons.html5.min.js"></script>
        <script src="plugins/datatables/buttons.print.min.js"></script>
        <!-- Responsive examples -->
        <script src="plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/responsive.bootstrap4.min.js"></script>

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

        <!--Morris Chart-->
    <script src="assets/morris/morris.js"></script>
        <script src="assets/morris/morris.min.js"></script>
        <script src="assets/morris/raphael-min.js"></script>
        <script src="assets/morris/morris.init.js"></script>

        <script>
//Muhammad Fahturrozi
!function($) {
    "use strict";

    var MorrisCharts = function() {};

    //creates line chart
    MorrisCharts.prototype.createLineChart = function(element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Line({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            fillOpacity: opacity,
            pointFillColors: Pfillcolor,
            pointStrokeColors: Pstockcolor,
            behaveLikeLine: true,
            gridLineColor: '#eef0f2',
            lineWidth: 1,
            hideHover: 'auto',
            resize: true, //defaulted to true
            lineColors: lineColors
        });
    },
        MorrisCharts.prototype.init = function() {

            //create line chart
            var $data  = [
        {y: '<?php echo $today; ?>', x: <?php echo mysqli_num_rows($check_order_today); ?>, z: <?php echo mysqli_num_rows($check_order_today_pulsa); ?>},
        {y: '<?php echo $oneday_ago; ?>', x: <?php echo mysqli_num_rows($check_order_oneday_ago); ?>, z: <?php echo mysqli_num_rows($check_order_oneday_ago_pulsa); ?>},
        {y: '<?php echo $twodays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_twodays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_twodays_ago_pulsa); ?>},
        {y: '<?php echo $threedays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_threedays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_threedays_ago_pulsa); ?>},
        {y: '<?php echo $fourdays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_fourdays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_fourdays_ago_pulsa); ?>},
        {y: '<?php echo $fivedays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_fivedays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_fivedays_ago_pulsa); ?>},
        {y: '<?php echo $sixdays_ago; ?>', x: <?php echo mysqli_num_rows($check_order_sixdays_ago); ?>, z: <?php echo mysqli_num_rows($check_order_sixdays_ago_pulsa); ?>}
            ];
            this.createLineChart('fatur', $data, 'y', ['x', 'z'], ['Total Pesanan', 'Total Pesanan'],['0.1'],['#ffffff'],['#999999'], ["#008000", "#FF0000"]);
        },
        //init
        $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

//initializing 
    function($) {
        "use strict";
        $.MorrisCharts.init();
    }(window.jQuery);
</script>

        <script>
//Muhammad Fahturrozi
!function($) {
    "use strict";

    var MorrisCharts = function() {};

    //creates line chart
    MorrisCharts.prototype.createLineChart = function(element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Line({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            fillOpacity: opacity,
            pointFillColors: Pfillcolor,
            pointStrokeColors: Pstockcolor,
            behaveLikeLine: true,
            gridLineColor: '#eef0f2',
            lineWidth: 1,
            hideHover: 'auto',
            resize: true, //defaulted to true
            lineColors: lineColors
        });
    },
        MorrisCharts.prototype.init = function() {

            //create line chart
            var $data  = [
        {y: '<?php echo $today; ?>', a: <?php echo mysqli_num_rows($check_order_today_admin); ?>},
        {y: '<?php echo $oneday_ago; ?>', a: <?php echo mysqli_num_rows($check_order_oneday_ago_admin); ?>},
        {y: '<?php echo $twodays_ago; ?>', a: <?php echo mysqli_num_rows($check_order_twodays_ago_admin); ?>},
        {y: '<?php echo $threedays_ago; ?>', a: <?php echo mysqli_num_rows($check_order_threedays_ago_admin); ?>},
        {y: '<?php echo $fourdays_ago; ?>', a: <?php echo mysqli_num_rows($check_order_fourdays_ago_admin); ?>},
        {y: '<?php echo $fivedays_ago; ?>', a: <?php echo mysqli_num_rows($check_order_fivedays_ago_admin); ?>},
        {y: '<?php echo $sixdays_ago; ?>', a: <?php echo mysqli_num_rows($check_order_sixdays_ago_admin); ?>}
            ];
            this.createLineChart('tampan', $data, 'y', ['a'], ['Total Pesanan', 'Total Pesanan'],['0.1'],['#ffffff'],['#999999'], ["#008000", "#FF0000"]);
        },
        //init
        $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

//initializing 
    function($) {
        "use strict";
        $.MorrisCharts.init();
    }(window.jQuery);
</script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

    </body>


</html>