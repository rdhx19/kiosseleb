<?php
    $check_order_today = $tur->query("SELECT * FROM orders WHERE date ='$date' and user = '$sess_username'");
    $check_order_today_pulsa = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$date' and user = '$sess_username'");
    $today = date("Y-m-d");
    
    $oneday_ago = date('Y-m-d', strtotime("-1 day"));
    $check_order_oneday_ago = $tur->query("SELECT * FROM orders WHERE date ='$oneday_ago' and user = '$sess_username'");
    $check_order_oneday_ago_pulsa = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$oneday_ago' and user = '$sess_username'");
    
    $twodays_ago = date('Y-m-d', strtotime("-2 day"));
    $check_order_twodays_ago = $tur->query("SELECT * FROM orders WHERE date ='$twodays_ago' and user = '$sess_username'");
    $check_order_twodays_ago_pulsa = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$twodays_ago' and user = '$sess_username'");
    
    $threedays_ago = date('Y-m-d', strtotime("-3 day"));
    $check_order_threedays_ago = $tur->query("SELECT * FROM orders WHERE date ='$threedays_ago' and user = '$sess_username'");
    $check_order_threedays_ago_pulsa = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$threedays_ago' and user = '$sess_username'");
    
    $fourdays_ago = date('Y-m-d', strtotime("-4 day"));
    $check_order_fourdays_ago = $tur->query("SELECT * FROM orders WHERE date ='$fourdays_ago' and user = '$sess_username'");
    $check_order_fourdays_ago_pulsa = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$fourdays_ago' and user = '$sess_username'");
    
    $fivedays_ago = date('Y-m-d', strtotime("-5 day"));
    $check_order_fivedays_ago = $tur->query("SELECT * FROM orders WHERE date ='$fivedays_ago' and user = '$sess_username'");
    $check_order_fivedays_ago_pulsa = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$fivedays_ago' and user = '$sess_username'");
    
    $sixdays_ago = date('Y-m-d', strtotime("-6 day"));
    $check_order_sixdays_ago = $tur->query("SELECT * FROM orders WHERE date ='$sixdays_ago' and user = '$sess_username'");
    $check_order_sixdays_ago_pulsa = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$sixdays_ago' and user = '$sess_username'");
?>