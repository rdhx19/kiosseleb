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
} else if ($data_user['level'] != "Agen" AND $data_user['level'] != "Admin"){
	header("Location: ".$config['url_web']."?");
} else {
if (isset($_POST['tambah'])) {
	$post_balance = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['balance'],ENT_QUOTES)))));

	$kode = random(5);

	if (empty($post_balance)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Please fill in the input.";
	} else {
		$update_user = $tur->query("UPDATE users SET balance = balance-$post_balance WHERE username = '$sess_username'");
		$insert_voc = $tur->query("INSERT INTO voucher (code, balance, status) VALUES ('$kode', '$post_balance', 'On')");
		if ($insert_voc == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>success:</b> Add a successful balance voucher.<br /><b>Code:</b> $kode<br /><b>Total Balance:</b> Rp. ".number_format($post_balance,0,',','.')." Balance<br /><b>Date:</b> $date";
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
                            <h4 class="header-title mb-4">Create a Balance Voucher</h4>
										<?php 
										if (isset($msg_type) == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if(isset($msg_type) == "error") {
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
												- Minimun Rp. <?php echo number_format($min_transfer,0,',','.'); ?>.
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Total Balance</label>
												<div class="col-md-10">
													<input type="number" name="balance" class="form-control" placeholder="Jumlah Saldo">
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
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Currency Change Voucher Change</h4>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th>Code</th>
														<th>User</th>
														<th>Total</th>
														<th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM voucher ORDER BY id DESC"; // edit
$new_query = $tur->query($query_list);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
													if($data_show['status'] == "On") {
														$label = "success";
														$kata = "Belum Digunakan";
													} else if($data_show['status'] == "Off") {
														$label = "danger";
														$kata = "Sudah Digunakan";
													}
												?>
													<tr>
														<td><?php echo $data_show['code']; ?></td>
														<td><?php echo $data_show['username']; ?></td>
														<td>Rp. <?php echo number_format($data_show['balance'],0,',','.'); ?></td>
														<td><span class="badge badge-<?php echo $label; ?>"><?php echo $kata; ?></span></td>
													</tr>
												<?php
												$no++;
												}
												?>
                                        </tbody>
                                    </table>
                                    </div>
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