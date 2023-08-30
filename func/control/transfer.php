<?php
//************************************************
//* Developer : Muhammad Fahturrozi (S1L3NT)
//* Release Date : 01 Agustus 2018
//* © Dilarang Keras Mengedit/Menghapus Semuanya ©
//* © Hargai Orang Jika Anda Ingin Dihargai ©
//* UU Nomor 28 Tahun 2014
//************************************************
if (empty($data_user['level'])){
	header("Location: ".$config['url_web']."?");
} else if ($data_user['level'] == "Member"){
	header("Location: ".$config['url_web']."?");
} else {
if (isset($_POST['tambah'])) {
	$post_username = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['username'],ENT_QUOTES)))));
	$post_balance = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['balance'],ENT_QUOTES)))));

	$checkdb_user = $tur->query("SELECT * FROM users WHERE username = '$post_username'");
	$datadb_user = mysqli_fetch_assoc($checkdb_user);
	if (empty($post_username) || empty($post_balance)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Mohon Mengisi Semua Input.";
	} else if (mysqli_num_rows($checkdb_user) == 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Username Tidak Terdaftar.";
	} else if($post_quantity < 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Deposit Minimum adalah 15000.";
	} else if ($data_user['balance'] < $post_balance) {
		$msg_type = "error";
		$msg_content = "<b>Error</b><br>Your Balance Is Not Enough.";
	} else {
		$update_user = $tur->query("UPDATE users SET balance = balance-$post_balance WHERE username = '$sess_username'"); // cut sender
		$update_user = $tur->query("UPDATE users SET balance = balance+$post_balance WHERE username = '$post_username'"); // send receiver
		$insert_tf = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$sess_username', 'You have performed Balance Transfer activities', '$date $time')");
		$insert_tf = $tur->query("INSERT INTO transfer_balance (sender, receiver, quantity, date) VALUES ('$sess_username', '$post_username', '$post_balance', '$date')");
		if ($insert_tf == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Success:</b> Successful balance transfer.<br /><b>Sender:</b> $sess_username<br /><b>Receiver:</b> $post_username<br /><b>Total Transfer:</b> Rp. ".number_format($post_balance,0,',','.')." Balance<br /><b>Date:</b> $date";
		} else {
			$msg_type = "error";
			$msg_content = "<b>Error</b><br>Error System.";
		}
	}
}
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Transfer Balance</h4>
										<?php 
										if (isset($msg_type) == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if (isset($msg_type) == "error") {
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
											<div class="alert alert-info">
												- Your balance will be deducted according to the balance transfer amount.<br />
												- Minimum transfer Rp. 0.
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Recipient's username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Amount of Transfer</label>
												<div class="col-md-10">
													<input type="number" name="balance" class="form-control" placeholder="Amount of Transfer">
												</div>
											</div>
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Reset</button>
												<button type="submit" class="pull-right btn btn-success btn-bordered waves-effect w-md waves-light" name="tambah">Submit</button>
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
<?php } ?>