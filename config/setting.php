<?php
//Pengaturan Website
$kontak = array(
	"wa" => "+6281291420705", // WhatsApp Kamu
	"fb" => "NO", // URL Facebook Kamu
	"namafb" => "NO", // Nama Facebook Kamu
	"line" => "No" // Line Kamu (Username)
    );
$config = array(
	"mt" => 0, // Maintenance? 1 = ya , 0 = tidak
	"url_web" => "https://localhost/kiosseleb/", // URL/Link Website
	"nama_web" => "Kiosseleb", // Nama Website
	"tentang_web" => "kiosseleb adalah Panel SMM Termurah dan Kualitas Tinggi 100% untuk semua jejaring sosial. Dapatkan panel sosial media terbaik hari ini!" // Tentang/Deskripsi Website
    );
$min_transfer = 15000; //Jumlah Minimal Transfer Saldo

function random($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_number($length) {
	$str = "";
	$characters = array_merge(range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
?>