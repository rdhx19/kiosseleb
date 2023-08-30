<?php
require_once("../config/config.php");
require_once("../config/setting.php"); 

$check_order = $tur->query("SELECT * FROM orders WHERE status IN ('Checking','Pending','Processing')");

if (mysqli_num_rows($check_order) == 0) {
  die("Order Pending not found.");
} else {
  while($data_order = mysqli_fetch_assoc($check_order)) {
    $o_oid = $data_order['oid'];
    $o_poid = $data_order['poid'];
    $o_provider = $data_order['provider'];
    $username = $data_order['user'];
    $price = $data_order['price'];
  if ($o_provider == "MANUAL") {
    echo "Order manual<br />";
  } else {
    
    $check_provider = $tur->query("SELECT * FROM provider WHERE code = '$o_provider'");
    $data_provider = mysqli_fetch_assoc($check_provider);
    
    $p_apikey = $data_provider['api_key'];
    $p_link = "https://api.medanpedia.co.id/status";
    
    if ($o_provider == "MEDANPEDIA") {
      $api_postdata = "api_token=$p_apikey&action=status&order=$o_poid";
    } else {
      die("System error!");
    }
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $p_link);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $chresult = curl_exec($ch);
    echo $chresult;
    curl_close($ch);
    $json_result = json_decode($chresult, true);

			if ($o_provider == "MEDANPEDIA") {
				$u_start = $json_result['start_counter'];
				$u_remains = $json_result['remains'];
				if ($json_result['status'] == "Pending") {
					$u_status = "Pending";
				} else if ($json_result['status'] == "Inprogress") {
					$u_status = "Processing";
				} else if ($json_result['status'] == "Processing") {
					$u_status = "Processing";
				} else if ($json_result['status'] == "Refunded") {
					$u_status = "Error";
				} else if ($json_result['status'] == "Cancelled") {
					$u_status = "Error";
				} else if ($json_result['status'] == "Partial") {
					$u_status = "Partial";
				} else if ($json_result['status'] == "Completed") {
					$u_status = "Success";
				} else {
					$u_status = "Pending";
				}
			}

		if ($u_status == "Success") {
			$tur->query("INSERT INTO hof (type, user, price) VALUES ('Sosmed', '$username', '$price')");
			}

    $update_order = $tur->query("UPDATE orders SET status = '$u_status', start_count = '$u_start', remains = '$u_remains' WHERE oid = '$o_oid'");
    if ($update_order == TRUE) {
      echo "ID Web: $o_oid<br />ID Pusat: $o_poid<br />Status: $u_status<br />Remains: $u_remains<br />";
    } else {
      echo "Error database.";
    }
  }
  }
}