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
if (isset($_POST['reset'])) {

	$post_username = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['username'],ENT_QUOTES)))));
	$post_email = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['email'],ENT_QUOTES)))));

	$check_user = $tur->query("SELECT * FROM users WHERE username = '$post_username'");

	$secret_key = '6LchOKYUAAAAAHBoXGi_wCr0TICC_iq2E9MTQMb4'; //masukkan secret key-nya berdasarkan secret key masig-masing saat create api key nya
	$captcha=$_POST['g-recaptcha-response'];
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
	$recaptcha = dapetin($url);
        
	$data_user = mysqli_fetch_assoc($check_user);
	$check_email = $tur->query("SELECT * FROM users WHERE email = '$post_email'");
	$data_email = mysqli_fetch_assoc($check_email);	    
			
	if (empty($post_username) || empty($post_email)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Silakan Isi Semua Input.";
	} else if (mysqli_num_rows($check_user) == 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Akun Tidak Terdaftar..";
	} else if (mysqli_num_rows($check_email) == 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Email Tidak Terdaftar.";
	} else if ($recaptcha['success'] == false) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Silahkan Isi Captcha.";
	} else {			
			$to = $data_user['email'];
			$newpassword = random(7);
			$new_password = password_hash($newpassword, PASSWORD_DEFAULT);
			$msg = "Password Mu Telah Di Ubah <b>$newpassword</b>";
			$subject = "Reset Password";
			$header = "From:".$config['nama_web']."@kiosseleb.site \r\n";
			$header .= "Cc:".$config['nama_web']."@kiosseleb_smm.site \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			$send = mail ($to, $subject, $msg, $header);
			$send = $tur->query("UPDATE users SET password = '$new_password' WHERE username = '$post_username'");
			if ($send == true) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil</b><br />Berhasil!! ,Password baru anda dikirim lewat email anda :) .";
			} else {
				$msg_type = "error";
				$msg_content = "<b>Gagal</b><br>Error System.";
			}	
		}
	}
}
?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Lupa password</h4>
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
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group row">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Email</label>
												<div class="col-md-10">
													<input type="text" name="email" class="form-control" placeholder="Email">
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
													<button type="submit" class="btn btn-info waves-effect w-md waves-light" name="reset">Submit</button>
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