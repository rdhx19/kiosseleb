<?php
session_start();
error_reporting(0);
require_once("config/config.php");
require_once("config/setting.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	}
session_destroy();
$insert = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$sess_username', 'Kamu telah melakukan aktifitas Logout', '$date $time')");
	if ($insert) {
		header("Location: ".$config['url_web']."?");
	}