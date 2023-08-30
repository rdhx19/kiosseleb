<?php
require ('../config/config.php');
$sql = mysqli_query($tur, "DELETE FROM `service_cat`");
if ($sql == TRUE){
    $p_link = "https://medanpedia.co.id/api/services";
    $api_postdata = array(
        'api_id' => 5291,
        'api_key' => '51f27d-c9cd4e-2ec33f-1c86ca-88b774'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $p_link);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $chresult = curl_exec($ch);
    curl_close($ch);
    $json_result = json_decode($chresult, true); 
    foreach($json_result['data'] as $data){
        $category = $data['category'];
        $check_category = mysqli_query($tur, "SELECT * FROM service_cat WHERE name = '$category' or code = '$category' ");
        if (mysqli_num_rows($check_category) > 0) {
            echo 'category sudah ada <br/>';
        } else {
            $data_category = strtr($data['code'], array(
                ' ORDER WEBISITE/JASA FIX/DAN OPER IRVANKEDE' => 'test',
                ' Medanpedia' => 'RKIOS',
                ' MP' => ' R',
                ' Medan' => ' Rkios',
                ' anggap free' => ' murah',
                ' IRVANKEDE' => ' Kiosseleb',
                ' GRATIS' => ' Termurah',
            ));
            $input_post = array(
                'id' => $id,
                'sid' => $id,
                'category' => $data_category['id'],
                'service' => $service_name,
                'note' => $note,
                'min' => $min,
                'max' => $max,
                'price' => $price,
                'status' => 'Active',
                'pid' => $id,
                'provider' => 'MEDANPEDIA'
            );
            $insert = mysqli_query($tur, "INSERT INTO `service_cat`(`name`, `code`) VALUES ('$category', '$category')");
            if ($insert == TRUE){
                echo "$category sudah ditambahkan <br/>";

            } else {
                echo "$category gagal ditambahkan karena".mysqli_error($tur)." <br/>";
            }
        }
    }
} else {
    die('Error');
}