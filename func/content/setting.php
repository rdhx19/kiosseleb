<?php
//************************************************
//* Developer : Muhammad Fahturrozi (S1L3NT)
//* Release Date : 01 Agustus 2018
//* © Dilarang Keras Mengedit/Menghapus Semuanya ©
//* © Hargai Orang Jika Anda Ingin Dihargai ©
//* UU Nomor 28 Tahun 2014
//************************************************
if (isset($_POST['change_pswd'])) {

	$post_username = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['username'],ENT_QUOTES)))));
	$post_npassword = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['npassword'],ENT_QUOTES)))));
	$post_cnpassword = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['cnpassword'],ENT_QUOTES)))));
	$new_password = password_hash($post_npassword, PASSWORD_DEFAULT);

	if (empty($post_username) || empty($post_npassword) || empty($post_cnpassword)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Please Fill in All Inputs.";
	} else if ($post_username <> $data_user['username']) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Inappropriate Username.";
	} else if ($sess_username == "demo") {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Forbidden by Cuy.";
	} else if (strlen($post_npassword) < 5) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Password is too short, at least 5 Karakter.";
	} else if ($post_cnpassword <> $post_npassword) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Confirm New Password Not Correct.";
	} else {
		$update_user = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$sess_username', 'You have done a Change Password activity', '$date $time')");
		$update_user = $tur->query("UPDATE users SET password = '$new_password' WHERE username = '$sess_username'");
		if ($update_user == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Berhasil</b><br>Password Changed.";
		} else {
			$msg_type = "error";
			$msg_content = "<b>Gagal</b><br>Error System.";
		}
	}
} else if (isset($_POST['tambah'])) {

	$post_email = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['email'],ENT_QUOTES)))));

	if (empty($post_email)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Please Fill in All Inputs.";
	} else {
		$update_user = $tur->query("UPDATE users SET email = '$post_email' WHERE username = '$sess_username'");
		if ($update_user == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Berhasil</b><br>Email Telah Diubah.";
		} else {
			$msg_type = "error";
			$msg_content = "<b>Gagal</b><br>Error System.";
		}
	}
}
$sess_username = $_SESSION['user']['username'];	$check_user = $tur->query("SELECT * FROM users WHERE username = '$sess_username'");
$data_user = mysqli_fetch_assoc($check_user);
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Setting</h4>
										<?php 
										if (isset($msg_type) && ($msg_type) =="success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if (isset($msg_type) && ($msg_type) == "error") {
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
                                                <label class="col-md-2 col-form-label">Email</label>
                                                <div class="col-md-10">
                                                    <div class="input-group">
                                                        <input type="email" class="form-control" value="<?php echo $data_user['email']; ?>" name="email" aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="tambah">Change Email</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" value="<?php echo $data_user['username']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">New password</label>
												<div class="col-md-10">
													<input type="password" name="npassword" class="form-control" placeholder="New password">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Confirm New Password</label>
												<div class="col-md-10">
													<input type="password" name="cnpassword" class="form-control" placeholder="Confirm New Password">
												</div>
											</div>
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="change_pswd">Change Password</button>
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
                 <div class="pull-left">2018 © <a href="javascript:void(0);"><?php echo $config['nama_web']; ?></a></div>
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="http://facebook.com/adminfatur">S1L3NT</a></span></div>
            </div>
        </footer>
        <!-- End Footer -->