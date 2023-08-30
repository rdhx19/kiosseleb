<?php
    $check_order_today_admin = $tur->query("SELECT * FROM orders WHERE date ='$date'");
    $check_order_today_pulsa_admin = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$date'");
    $today = date("Y-m-d");
    
    $oneday_ago = date('Y-m-d', strtotime("-1 day"));
    $check_order_oneday_ago_admin = $tur->query("SELECT * FROM orders WHERE date ='$oneday_ago'");
    $check_order_oneday_ago_pulsa_admin = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$oneday_ago'");
    
    $twodays_ago = date('Y-m-d', strtotime("-2 day"));
    $check_order_twodays_ago_admin = $tur->query("SELECT * FROM orders WHERE date ='$twodays_ago'");
    $check_order_twodays_ago_pulsa_admin = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$twodays_ago'");
    
    $threedays_ago = date('Y-m-d', strtotime("-3 day"));
    $check_order_threedays_ago_admin = $tur->query("SELECT * FROM orders WHERE date ='$threedays_ago'");
    $check_order_threedays_ago_pulsa_admin = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$threedays_ago'");
    
    $fourdays_ago = date('Y-m-d', strtotime("-4 day"));
    $check_order_fourdays_ago_admin = $tur->query("SELECT * FROM orders WHERE date ='$fourdays_ago'");
    $check_order_fourdays_ago_pulsa_admin = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$fourdays_ago'");
    
    $fivedays_ago = date('Y-m-d', strtotime("-5 day"));
    $check_order_fivedays_ago_admin = $tur->query("SELECT * FROM orders WHERE date ='$fivedays_ago'");
    $check_order_fivedays_ago_pulsa_admin = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$fivedays_ago'");
    
    $sixdays_ago = date('Y-m-d', strtotime("-6 day"));
    $check_order_sixdays_ago_admin = $tur->query("SELECT * FROM orders WHERE date ='$sixdays_ago'");
    $check_order_sixdays_ago_pulsa_admin = $tur->query("SELECT * FROM orders_pulsa WHERE date ='$sixdays_ago'");
?>