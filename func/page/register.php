<?php

function dapetin($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $data = curl_exec($ch);
        curl_close($ch);
                return json_decode($data, true);
}
if (isset($_SESSION['user'])) {
	header("Location: ".$config['url_web']);
} else {
if (isset($_POST['daftar'])) {
	$post_email = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['email'],ENT_QUOTES)))));
	$post_username = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['username'],ENT_QUOTES)))));
	$post_password = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['password'],ENT_QUOTES)))));
	$post_repeat_password = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['repassword'],ENT_QUOTES)))));
	$new_password = password_hash($post_password, PASSWORD_DEFAULT);

	$secret_key = '6LchOKYUAAAAAHBoXGi_wCr0TICC_iq2E9MTQMb4'; //masukkan secret key-nya berdasarkan secret key masig-masing saat create api key nya
	$captcha=$_POST['g-recaptcha-response'];
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
	$recaptcha = dapetin($url);
		
	$check_user = $tur->query("SELECT * FROM users WHERE username = '$post_username'");
	$check_email = $tur->query("SELECT * FROM users WHERE email = '$post_email'");

	if (empty($post_username) || empty($post_password) || empty($post_repeat_password) || empty($post_email)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Silakan Isi Semua Input.";
	} else if ($recaptcha['success'] == false) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Silakan Isi Captcha.";
	} else if (mysqli_num_rows($check_user) > 0) {
		$msg_type = "error";
		$msg_content = "Gagal</b><br>Username telah terdaftar.";
	} else if (mysqli_num_rows($check_email) > 0) {
		$msg_type = "error";
		$msg_content = "Gagal</b><br>Email telah terdaftar.";
	} else if (strlen($post_username) > 15) {
		$msg_type = "error";
		$msg_content = "Gagal</b><br>Maksimal 15 nama pengguna.";
	} else if (strlen($post_password) > 15) {
		$msg_type = "error";
		$msg_content = "Gagal</b><br>Kata sandi maksimum 15 karakter.";
	} else if (strlen($post_username) < 5) {
		$msg_type = "error";
		$msg_content = "Gagal</b><br>Nama Pengguna Minimal 5 karakter.";
	} else if (strlen($post_password) < 5) {
		$msg_type = "error";
		$msg_content = "Gagal</b><br>Password Minimal 5 karakter.";
	} else if ($post_password <> $post_repeat_password) {
		$msg_type = "error";
		$msg_content = "Gagal</b><br>Konfirmasikan password Tidak Tepat.";
	} else {		    
		$insert_user = $tur->query("INSERT INTO users (username, password, balance, level, registered, status, api_key, email, uplink) VALUES ('$post_username', '$new_password', '0', 'Member', '$date', 'Active', '$post_api', '$post_email', 'Server')");
			if ($insert_user == TRUE) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil</b><br>Daftar Akun Berhasil. Anda Akan Diarahkan Ke Halaman Utama.<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=/\">";
			} else {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b><br>System Error.";
			}
		}
	}
}
?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Daftar</h4>
										<?php 
										if (isset($msg_type) && $msg_type == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if (isset($msg_type) && $msg_type == "error") {
										?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<div class="alert alert-info">
											<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
											Sebelum Daftar Baca Dulu <a href="?<?php echo md5("page"); ?>=<?php echo base64_encode("ketentuan"); ?>">Ketentuan Layanan</a>
										</div>
										
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group row">
												<label class="col-md-2 control-label">Email</label>
												<div class="col-md-10">
													<input type="text" name="email" class="form-control" placeholder="Email">
												</div>
											</div>											
											<div class="form-group row">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>			
											<div class="form-group row">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="password" name="password" class="form-control" placeholder="Password">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Confirm Password</label>
												<div class="col-md-10">
													<input type="password" name="repassword" class="form-control" placeholder="Konfirmasi Password">
												</div>
											</div>											
											<div class="form-group row">
												<label class="col-md-2 control-label"></label>
												<div class="col-md-10">
                                               <div class="g-recaptcha" data-sitekey="6LchOKYUAAAAALw2VFVjNKsRfOwEh_wdk5uEtCw4"></div>
												</div>
											</div>
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn btn-info waves-effect w-md waves-light" name="daftar">Daftar</button>
													<button type="reset" class="btn btn-default waves-effect w-md waves-light">Reset</button>
												</div>
											</div>
										</form>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div> <!-- end wrapper -->

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                 <div class="pull-left">2019 © <a href="javascript:void(0);"><?php echo $config['nama_web']; ?></a></div>
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="">M.Ridho Hakim</a></span></div>
            </div>
        </footer>
        <!-- End Footer -->