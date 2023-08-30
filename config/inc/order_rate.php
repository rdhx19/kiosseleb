<?php
require("../../config/config.php");

if (isset($_POST['service'])) {
	$post_sid = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['service'],ENT_QUOTES)))));
	$check_service = $tur->query("SELECT * FROM services WHERE sid = '$post_sid' AND status = 'Active'");
	if (mysqli_num_rows($check_service) == 1) {
		$data_service = mysqli_fetch_assoc($check_service);
		$result = $data_service['price'] / 1000;
		echo $result;
	} else {
		die("0");
	}
} else {
	die("0");
}