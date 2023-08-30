<?php
require_once("../config/config.php");
$api_key = "9fcf6b-ac30c3-a40f20-31b265-493fc9";
$api_id = "10157";
$postdata = "api_id=$api_id&api_key=$api_key";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://irvankede-smm.co.id/api/services');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, TRUE);
$markup = 10000;
foreach($json_result["data"] as $service){
    $check_cat = mysqli_query($tur, "SELECT * FROM `service_cat` WHERE name = '".$service['category']."'");
    if(mysqli_num_rows($check_cat) < 1){
        $insert_cat = mysqli_query($tur, "INSERT INTO `service_cat`(`name`, `code`) VALUES ('".$service['category']."',  '".$service['category']."',");
        if ($insert_cat == TRUE){
            echo "Category ".$service['category']." berhasil ditambahkan <br/>";
        } else {
            echo "Category ".$service['category']." gagal ditambahkan karena ".mysqli_error($tur)."<br/>";
        }
    } else {
        echo "Category ".$service['category']." sudah ada<br/>";
    }
}   


