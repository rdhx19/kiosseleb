<?php
require("../../config/config.php");

if (isset($_POST['method'])) {
	$post_sid = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['method'],ENT_QUOTES)))));
	$check_depo = $tur->query("SELECT * FROM deposit_method WHERE name = '$post_sid'");
	if (mysqli_num_rows($check_depo) == 1) {
		$data_depo = mysqli_fetch_assoc($check_depo);
		$result = $data_depo['rate'];
		echo $result;
	} else {
		die("0");
	}
} else {
	die("0");
}