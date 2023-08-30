<?php
if (isset($_POST['tambah'])) {
	$post_voc = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['voc'],ENT_QUOTES)))));

	$check_voc = $tur->query("SELECT * FROM voucher WHERE code = '$post_voc' AND status = 'Off'");
	$checkdb_voc = $tur->query("SELECT * FROM voucher WHERE code = '$post_voc'");
	$datadb_voc = mysqli_fetch_assoc($checkdb_voc);
	$get = $datadb_voc['balance'];

	if (empty($post_voc)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Please fill in the input.";
	} else if (mysqli_num_rows($checkdb_voc) == 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Voucher Not Registered.";
	} else if (mysqli_num_rows($check_voc) == 1) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Voucher Used.";
	} else {
		$update_user = $tur->query("UPDATE users SET balance = balance+$get WHERE username = '$sess_username'");
		$update_voc = $tur->query("UPDATE voucher SET status = 'Off' WHERE code = '$post_voc'");
		$update_voc = $tur->query("UPDATE voucher SET username = '$sess_username' WHERE code = '$post_voc'");
		$insert_voc = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$sess_username', 'You have exchanged your Balance Voucher activity', '$date $time')");
		if ($insert_voc == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Success:</b> Exchange successful balance vouchers.<br /><b>Code:</b> $post_voc<br /><b>Total Balance:</b> Rp. ".number_format($get,0,',','.')." Balance<br /><b>Date:</b> $date";
		} else {
			$msg_type = "error";
			$msg_content = "<b>Gagal</b><br>Error System.";
		}
	}
}
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Tukar Voucher Saldo</h4>
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
											<div class="form-group row">
												<label class="col-md-2 control-label">Code Voucher</label>
												<div class="col-md-10">
													<input type="text" name="voc" class="form-control" placeholder="Code Voucher">
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