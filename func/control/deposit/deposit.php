<?php

if (empty($data_user['level'])){
	header("Location: ".$config['url_web']."?");
} else if ($data_user['level'] != "Admin"){
	header("Location: ".$config['url_web']."?");
} else {
	$check_worder = $tur->query("SELECT SUM(quantity 
) AS total FROM deposits");
	$data_worder = mysqli_fetch_assoc($check_worder);
	$check_worder = $tur->query("SELECT * FROM deposits");
	$count_worder = mysqli_num_rows($check_worder);
if (isset($_GET['code'])) {
	$post_code = base64_decode($tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_GET['code'],ENT_QUOTES))))));
	$checkdb_depo = $tur->query("SELECT * FROM deposits WHERE code = '$post_code'");
	$datadb_depo = mysqli_fetch_assoc($checkdb_depo);
	$get_balance = $datadb_depo['balance'];
	$balance_user = $datadb_depo['username'];
	if (mysqli_num_rows($checkdb_depo) == 0) {
		header("Location: ".$config['url_web']."?");
	} else {
if (isset($_POST['edit'])) {
	$post_status = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['status'],ENT_QUOTES)))));

	if ($post_status != "Pending" AND $post_status != "Error" AND $post_status != "Success") {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Input Tidak Sesuai.";
	} else {
		if($_POST['status'] == "Success") {
			$update = $tur->query("INSERT INTO hof (type, user, price) VALUES ('Deposit', '$balance_user', '$get_balance')");
			$update = $tur->query("UPDATE deposits set status = '$post_status' WHERE code = '$post_code'");
			$update = $tur->query("UPDATE users set balance = balance+$get_balance WHERE username = '$balance_user'");
			if($update == TRUE) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil:</b> Saldo sudah di tambahkan ke <b>$balance_user</b> dengan jumlah $get_balance dan status sudah di update.";
			} else {
				$msg_type = "error";
				$msg_content = "<b>Gagal</b><br>Error System 1.";
			}
		} else {
			$update_depo = $tur->query("UPDATE deposits set status = '$post_status' WHERE code = '$post_code'");
			if ($update_depo == TRUE) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil:</b> Update berhasil.";
			} else {
				$msg_type = "error";
				$msg_content = "<b>Gagal</b><br>Error System.";
			}
		}
	}
}
?><script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "39513d30-9395-4215-a589-313c1aff7fd7",
    });
  });
</script>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Ubah Deposit</h4>
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
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
												<label class="col-md-2 control-label">Topup ID</label>
												<div class="col-md-10">
													<input type="text" class="form-control" placeholder="Topup ID" value="<?php echo $datadb_depo['code']; ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Saldo Topup</label>
												<div class="col-md-10">
													<input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php echo $datadb_depo['quantity']; ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Saldo Diterima</label>
												<div class="col-md-10">
													<input type="number" name="balance" class="form-control" placeholder="Balance" value="<?php echo $datadb_depo['balance']; ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Status</label>
												<div class="col-md-10">
													<select class="form-control" name="status">
														<option value="<?php echo $datadb_depo['status']; ?>"><?php echo $datadb_depo['status']; ?> (Selected)</option>
														<option value="Pending">Pending</option>
														<option value="Error">Error</option>
														<option value="Success">Success</option>
													</select>
												</div>
											</div>
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
											<div class="pull-right">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Ulangi</button>
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="edit">Ubah</button>
											</div>
												</div>
											</div>
										</form>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
				<?php } } else { ?>
<?php } ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-info pull-left">
                                        <i class="mdi mdi-cart text-info"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark m-t-10">Rp. <?php echo number_format($data_worder['total'],0,',','.'); ?> (Dari <?php echo number_format($count_worder,0,',','.'); ?> deposit)</h3>
                                        <p class="text-muted mb-0">Total Deposit Seluruh Pengguna</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Kelola Deposit</h4>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th>Kode</th>
														<th>Pengguna</th>
														<th>Metode</th>
														<th>Saldo Topup</th>
														<th>Saldo Diterima</th>
														<th>Tanggal</th>
														<th>Status</th>
														<th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM deposits ORDER BY id DESC"; // edit
$new_query = $tur->query($query_list);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
													if($data_show['status'] == "Pending") {
														$label = "warning";
													} else if($data_show['status'] == "Error") {
														$label = "danger";
													} else if($data_show['status'] == "Success") {
														$label = "success";
													}
												?>
													<tr>
														<td><?php echo $data_show['code']; ?></td>
														<td><?php echo $data_show['username']; ?></td>
														<td><?php echo $data_show['method']; ?></td>
														<td><?php echo number_format($data_show['quantity'],0,',','.'); ?></td>
													<td><?php echo number_format($data_show['balance'],0,',','.'); ?></td>
														<td><?php echo $data_show['date']; ?></td>
														<td><span class="badge badge-<?php echo $label; ?>"><?php echo $data_show['status']; ?></span></td>
														<td align="center">
														<a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("deposithis"); ?>&code=<?php echo base64_encode($data_show['code']); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
														</td>
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
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="">S1L3NT</a></span></div>
            </div>
        </footer>
        <!-- End Footer -->
<?php } ?>