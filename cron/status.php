<?php
require_once("../config/config.php");
require_once("../config/setting.php");

$check_order = $tur->query("SELECT * FROM orders WHERE status IN ('Checking','Pending','Processing')");

if (!$check_order) {
    die("Error executing query: " . mysqli_error($tur));
}

while ($data_order = mysqli_fetch_assoc($check_order)) {
    $o_oid = $data_order['oid']; // Memindahkan penentuan $o_oid ke dalam loop

    if (preg_match('/^[a-zA-Z0-9]+$/', $o_oid)) {
        // Pengambilan data order seperti sebelumnya
        
        $check_provider = $tur->query("SELECT * FROM provider WHERE code = 'MEDANPEDIA'");
        
        if (!$check_provider) {
            echo "Error fetching provider data: " . mysqli_error($tur);
            exit();
        }
        
        $data_provider = mysqli_fetch_assoc($check_provider);

        // Setup cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $p_link);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute cURL
        $chresult = curl_exec($ch);
        
        // Handle cURL errors
        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
            curl_close($ch);
            exit();
        }
        
        curl_close($ch);

        // Decode JSON response
        $json_result = json_decode($chresult, true);

        // Handle JSON decoding errors
        if ($json_result === null) {
            echo "Error decoding JSON response: " . json_last_error_msg();
            exit();
        }

        // Pengolahan hasil JSON seperti sebelumnya

        if ($u_status == "Success") {
            $tur->query("INSERT INTO hof (type, user, price) VALUES ('Sosmed', '$username', '$price')");
        }

        $update_order = $tur->query("UPDATE orders SET status = '$u_status', start_count = '$u_start', remains = '$u_remains' WHERE oid = '$o_oid'");
        if ($update_order == TRUE) {
            echo "Data berhasil diperbarui: ID Web: $o_oid<br />ID Pusat: $o_poid<br />Status: $u_status<br />Remains: $u_remains<br />";
        } else {
            echo "Gagal memperbarui data: " . mysqli_error($tur);
        }
    } else {
        $response = array(
            "status" => false,
            "message" => "Order Id tidak boleh menggunakan spesial karakter"
        );
        echo json_encode($response);
        exit();
    }
}
?>
