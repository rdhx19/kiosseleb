<?php
require_once("../config/config.php");
require_once("../config/setting.php"); 

$check_hof = $tur->query("SELECT * FROM hof WHERE type IN ('Sosmed','Pulsa','Deposit')");

if (mysqli_num_rows($check_hof) == 0) {
	die("not found.");
} else {
	while($data_hof = mysqli_fetch_assoc($check_hof)) {
		$user = $data_hof['user'];
		$update_hof = $tur->query("DELETE FROM hof WHERE user = '$user' AND type IN ('Sosmed','Pulsa','Deposit')");
		if ($update_hof == TRUE) {
			echo "Reset HOF $user<br />";
    	} else {
			echo "Error database.";
		}
	}
}
?>