<?php
require_once("../config/config.php");
require_once("../config/setting.php"); 

$check_depo = $tur->query("SELECT * FROM deposits WHERE status = 'Pending'");

if (mysqli_num_rows($check_depo) == 0) {
	die("not found.");
} else {
	while($data_depo = mysqli_fetch_assoc($check_depo)) {
		$user = $data_depo['username'];
		$update_depo = $tur->query("UPDATE deposits SET status = 'Error' WHERE username = '$user' AND status = 'Pending'");
		if ($update_depo == TRUE) {
			echo "UPDATE $user<br />";
    	} else {
			echo "Error database.";
		}
	}
}
?>