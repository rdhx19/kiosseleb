<?php
require ('../config/config.php');
function db_insert($tur, $table, $data) {
    if (!is_array($data)) {
        return false;
    } else {
        $query = mysqli_query($tur, "INSERT INTO $table (".implode(', ', array_keys($data)).") VALUES ('".implode('\', \'', $data)."')");
        if (mysqli_error($tur)) {
            return false;
        } else {
            return mysqli_insert_id($tur);
        }
    }
}
$sql = mysqli_query($tur, "DELETE FROM `services`");
if ($sql == TRUE){
    $p_link = "https://api.medanpedia.co.id/services";
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
        $id = $data['id'];
        $category = $data['category'];
        $harga = $data['price'];
        $min = $data['min'];
        $max = $data['max'];
        $note = $data['description'];
        $price = $harga*1.5;
        $check_services = mysqli_query($tur, "SELECT * FROM services1 WHERE pid = '$id'");
        $check_category = mysqli_query($tur, "SELECT * FROM service_cat WHERE name = '$category' OR code ='$category'");
        $data_category = mysqli_fetch_assoc($check_category);
        if (mysqli_num_rows($check_services) > 0) {
            echo 'layanan sudah ada <br/>';
        } else {
            $service_name = strtr($data['name'], array(
                ' DB MEDANPEDIA' => 'DB RKIOS',
                ' Medanpedia' => 'RKIOS',
                ' MP' => ' R',
                ' Medan' => ' Rkios',
                ' anggap free' => ' murah',
                ' MEDANPEDIA' => ' Rkios',
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
            $insert = db_insert($tur, 'services', $input_post);
            if ($insert == TRUE){
                echo "Data Layanan Berhasil ditambahkan <br/>";
            } else {
                echo "Data Layanan Gagal ditambahkan <br/>";
            }
        }
    }
} else {
    die('Error');
}