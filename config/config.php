<?php
//error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");
$time = date("H:i:s");

//database
$sqli = array(
	"host" => "localhost", // Host
	"user" => "rdhx", // Username Database
	"pass" => "R1dh0hakim#", // Password Database
	"name" => "kiosseleb" // Nama Database
    );
$tur = mysqli_connect($sqli['host'], $sqli['user'], $sqli['pass'], $sqli['name']);
if(!$tur) {
	die("Koneksi Gagal : ".mysqli_connect_error());
	}
?>