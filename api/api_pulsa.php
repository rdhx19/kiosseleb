<?php
require_once("../config/config.php");
require_once("../config/setting.php"); 
header("Content-Type: application/json");

if (isset($_POST['key']) AND isset($_POST['action'])) {
	$post_key = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['key'],ENT_QUOTES)))));
	$post_action = $_POST['action'];
	if (empty($post_key) || empty($post_action)) {
		$array = array("status" => false, "data" => array("msg" => "Incorrect Request"));
	} else {
		$check_user = $tur->query("SELECT * FROM users WHERE api_key = '$post_key'");
		$data_user = mysqli_fetch_assoc($check_user);
		if (mysqli_num_rows($check_user) == 1) {
			$username = $data_user['username'];
			if ($post_action == "add") {
				if (isset($_POST['service']) AND isset($_POST['phone'])) {
					$post_service = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['service'],ENT_QUOTES)))));
					$post_link = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['phone'],ENT_QUOTES)))));
					if (empty($post_service) || empty($post_link)) {
						$array = array("status" => false, "data" => array("msg" => "Incorrect Request"));
					} else {
						$check_service = $tur->query("SELECT * FROM services_pulsa WHERE sid = '$post_service' AND status = 'Active'");
						$data_service = mysqli_fetch_assoc($check_service);
						if (mysqli_num_rows($check_service) == 0) {
							$array = array("status" => false, "data" => array("msg" => "Service Not Found"));
						} else {
							$oid = rand(10000,99999);
							$price = $data_service['price'];
							$service = $data_service['service'];
							$provider = $data_service['provider'];
							$pid = $data_service['pid'];
							if ($data_user['balance'] < $price) {
								$array = array("status" => false, "data" => array("msg" => "Low Balance"));
							} else {
								$check_provider = $tur->query("SELECT * FROM provider WHERE code = '$provider'");
								$data_provider = mysqli_fetch_assoc($check_provider);
								$provider_key = $data_provider['api_key'];
								$provider_link = $data_provider['link'];
	
								if ($provider == "MANUAL") {
									$api_postdata = "";
									$poid = $oid;
								} else if ($provider == "MEDANPULSA") {
									$api_postdata = "api_key=$provider_key&action=order&service=$pid&data=$post_link";
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, "$provider_link");
									curl_setopt($ch, CURLOPT_POST, 1);
									curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
									$chresult = curl_exec($ch);
									curl_close($ch);
									$json_result = json_decode($chresult, true);
								}
								
								if ($provider == "MEDANPULSA" AND $json_result['status'] == false) {
									$array = array("status" => false, "data" => array("msg" => "".$json_result['data']['msg'].""));
								} else {
									if ($provider == "MEDANPULSA") {
										$poid = $json_result['data']['id'];
									}
									$update_user = $tur->query("UPDATE users SET balance = balance-$price WHERE username = '$username'");
									$update_user = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$username', 'Kamu telah melakukan aktifitas Order $service', '$date $time')");
									if ($update_user == TRUE) {
										$insert_order = $tur->query("INSERT INTO hof (type, user, price) VALUES ('Pulsa', '$username', '$price')");
										$insert_order = $tur->query("INSERT INTO orders_pulsa (oid, poid, user, service, target, price, status, date, provider, place_from) VALUES ('$oid', '$poid', '$username', '$service', '$post_link', '$price', 'Pending', '$date', '$provider', 'API')");
										if ($insert_order == TRUE) {
											$array = array("status" => true, "data" => array("id" => $oid));
										} else {
											$array = array("status" => false, "data" => array("msg" => "System Error"));
										}
									} else {
										$array = array("status" => false, "data" => array("msg" => "System Error"));
									}
								}
							}
						}
					}
				} else {
					$array = array("status" => false, "data" => array("msg" => "System Error"));
				}
			} else if ($post_action == "status") {
				if (isset($_POST['id'])) {
					$post_oid = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['id'],ENT_QUOTES)))));
					$check_order = mysqli_query($db, "SELECT * FROM orders_pulsa WHERE oid = '$post_oid' AND user = '$username'");
					$data_order = mysqli_fetch_array($check_order);
					if (mysqli_num_rows($check_order) == 0) {
						$array = array("status" => false, "data" => array("msg" => "Order Not Found"));
					} else {
						$array = array("status" => true, "data" => array("id" => $data_order['oid'], "status" => $data_order['status']));
					}
				} else {
					$array = array("status" => false, "data" => array("msg" => "Incorrect Request"));
				}
			} else if ($post_action == "services") {
					$check_service = $tur->query("SELECT * FROM services_pulsa WHERE status = 'Active' ORDER BY sid ASC");
					while($row = mysqli_fetch_array($check_service)){
					$array = "-";
					$datas[] = array("sid" => $row['sid'], "category" => $row['operator'], "service" => $row['service'], "status" => $row['status'], "price" => $row['price']);
                }
						$array = array("status" => true, "data" => $datas);
			} else {
				$array = array("status" => false, "data" => array("msg" => "Wrong Action"));
			}
		} else {
			$array = array("status" => false, "data" => array("msg" => "Invalid Api Key"));
		}
	}
} else {
	$array = array("status" => false, "data" => array("msg" => "Incorrect Request"));
}

$print = json_encode($array);
print_r($print);