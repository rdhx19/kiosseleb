<?php
require ('../config/config.php');
$sql = mysqli_query($tur, "DELETE FROM `service_cat`");
if ($sql == TRUE){
    $p_link = "https://bospanel.com/api/v2";
    $api_postdata = array(
        'api_token' => '$2y$10$TREdggR/kR2pMMqdICzbvOOY7ZwuPSr6TPMKtaHam3oYJY9HvUKjW',
        'action' => 'packages'
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
    foreach($json_result as $data){
        $category = $data['category_name'];
        $check_category = mysqli_query($tur, "SELECT * FROM service_cat WHERE name = '$category' or code = '$category' ");
        if (mysqli_num_rows($check_category) > 0) {
            echo 'category sudah ada <br/>';
        } else {
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