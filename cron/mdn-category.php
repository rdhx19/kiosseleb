<?php
require ('../config/config.php');
$sql = mysqli_query($tur, "DELETE FROM `service_cat`");
if ($sql == TRUE){
    $p_link = "https://medanpedia.co.id/api/services";
    $api_postdata = array(
        'api_id' => 5291,
        'api_key' => '44a147-747ccb-88d5e6-bec116-635c5f'
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
            $data_category = strtr($category, array(
                ' ORDER WEBISITE/JASA FIX/DAN OPER IRVANKEDE' => 'test',
                ' Medanpedia' => 'Kiosseleb',
                ' MP' => ' R',
                ' Medan' => ' Kiosseleb',
                ' anggap free' => ' murah',
                ' IRVANKEDE' => ' Kiosseleb',
                ' GRATIS' => ' Termurah',
            ));

            $id = $data['id'];  // Assuming 'id' is the key in your data array
            $service_name = $data['service'];  // Assuming 'service' is the key in your data array
            $note = $data['note'];  // Assuming 'note' is the key in your data array
            $min = $data['min'];  // Assuming 'min' is the key in your data array
            $max = $data['max'];  // Assuming 'max' is the key in your data array
            $price = $data['price'];  // Assuming 'price' is the key in your data array

            $input_post = array(
                'id' => $id,
                'sid' => $id,
                'category' => $id,
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
                echo "$category gagal ditambahkan karena " . mysqli_error($tur) . " <br/>";
            }
        }
    }
} else {
    die('Error');
}
?>
