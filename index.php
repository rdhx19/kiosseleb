<?php
session_start();
//error_reporting(0);
require_once("config/config.php");
require_once("config/setting.php"); 
require_once("lib/function.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = $tur->query("SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	$check_order = $tur->query("SELECT SUM(price) AS total FROM orders WHERE user = '$sess_username'");
	

include("config/grafik.php");
include("config/grafik_admin.php");
} else {
	if (isset($_POST['login'])) {

	$post_username = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['username'],ENT_QUOTES)))));
	$post_password = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['password'],ENT_QUOTES)))));
	$ip = $_SERVER['REMOTE_ADDR'];

		if (empty($post_username) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal</b><br>Silakan Isi Semua Input.";
		} else {
			$check_user = $tur->query("SELECT * FROM users WHERE username = '$post_username'");
			if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal</b><br>Akun Tidak Terdaftar.";
			} else {
				$data_user = mysqli_fetch_assoc($check_user);
				if ($data_user['status'] == "Suspended") {
					$msg_type = "error";
					$msg_content = "<b>Gagal</b><br>Akun dinonaktifkan.";
				} else {
					if(password_verify($post_password, $data_user['password'])) {
						$tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$post_username', 'Anda telah masuk dengan Ip $ip', '$date $time')");
						$_SESSION['user'] = $data_user;
						header("Location: ".$config['url_web']."?");
					} else {
						$msg_type = "error";
						$msg_content = "<b>Gagal</b><br>Username/Password Salah.";
					}
				}
			}
		}
	}
}
$ua = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$ua) || preg_match('/Java1.1.4/si',$ua) || preg_match('/MS FrontPage Express/si',$ua) || preg_match('/HTTrack/si',$ua) || preg_match('/IDentity/si',$ua) || preg_match('/HyperBrowser/si',$ua) || preg_match('/Lynx/si',$ua)) 
{
header('Location:http://shafou.com');
die();
}
if($config['mt'] == 1) {
	require_once("func/page/mt.php");
} else {
if (isset($_SESSION['user'])) {
?>
<?php require_once("config/web/dalam.php"); ?>
<?php } else { ?>
<?php require_once("config/web/luar.php"); ?>
<?php } } ?>