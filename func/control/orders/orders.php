<?php
if (empty($data_user['level'])){
	header("Location: ".$config['url_web']."?");
} else if ($data_user['level'] != "Admin"){
	header("Location: ".$config['url_web']."?");
} else {
	$check_worder = $tur->query("SELECT SUM(price) AS total FROM orders");
	$data_worder = mysqli_fetch_assoc($check_worder);
	$check_worder = $tur->query("SELECT * FROM orders");
	$count_worder = mysqli_num_rows($check_worder);
if (isset($_GET['oid'])) {
	$post_oid = base64_decode($tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_GET['oid'],ENT_QUOTES))))));
	$checkdb_order = $tur->query("SELECT * FROM orders WHERE oid = '$post_oid'");
	$datadb_order = mysqli_fetch_assoc($checkdb_order);
	if (mysqli_num_rows($checkdb_order) == 0) {
		header("Location: ".$config['url_web']."?");
	} else {
if (isset($_POST['edit'])) {
	$post_status = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['status'],ENT_QUOTES)))));
	$post_start = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['start_count'],ENT_QUOTES)))));
	$post_remains = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['remains'],ENT_QUOTES)))));

	if ($post_status != "Pending" AND $post_status != "Processing" AND $post_status != "Error" AND $post_status != "Partial" AND $post_status != "Success") {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Input Tidak Sesuai.";
	} else {
		$update_order = $tur->query("UPDATE orders SET start_count = '$post_start', remains = '$post_remains', status = '$post_status' WHERE oid = '$post_oid'");
		if ($update_order == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Berhasil:</b> Pesanan berhasil diubah.<br /><b>Order ID:</b> $post_oid<br /><b>Status:</b> $post_status<br /><b>Start Count:</b> ".number_format($post_start,0,',','.')."<br /><b>Remains:</b> ".number_format($post_remains,0,',','.');
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
                            <h4 class="header-title mb-4">Ubah Pesanan</h4>
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
												<label class="col-md-2 control-label">Order ID</label>
												<div class="col-md-10">
													<input type="text" class="form-control" placeholder="Order ID" value="<?php echo $datadb_order['oid']; ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Start Count</label>
												<div class="col-md-10">
													<input type="number" name="start_count" class="form-control" placeholder="Start Count" value="<?php echo $datadb_order['start_count']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Remains</label>
												<div class="col-md-10">
													<input type="number" name="remains" class="form-control" placeholder="Remains" value="<?php echo $datadb_order['remains']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Status</label>
												<div class="col-md-10">
													<select class="form-control" name="status">
														<option value="<?php echo $datadb_order['status']; ?>"><?php echo $datadb_order['status']; ?> (Selected)</option>
														<option value="Pending">Pending</option>
														<option value="Processing">Processing</option>
														<option value="Error">Error</option>
														<option value="Partial">Partial</option>
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
                                        <h3 class="text-dark m-t-10">Rp. <?php echo number_format($data_worder['total'],0,',','.'); ?> (Dari <?php echo number_format($count_worder,0,',','.'); ?> pesanan)</h3>
                                        <p class="text-muted mb-0">Total Pembelian Seluruh Pengguna</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Kelola Pesanan</h4>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th></th>
														<th>OID</th>
														<th>Pengguna</th>
														<th>Layanan</th>
														<th>Target</th>
														<th>Jumlah</th>
														<th>Harga</th>
														<th>OID Provider</th>
														<th>Provider</th>
														<th>Status</th>
														<th>Refund</th>
														<th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM orders ORDER BY id DESC"; // edit
$new_query = $tur->query($query_list);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
													if($data_show['status'] == "Pending") {
														$label = "warning";
													} else if($data_show['status'] == "Processing") {
														$label = "info";
													} else if($data_show['status'] == "Error") {
														$label = "danger";
													} else if($data_show['status'] == "Partial") {
														$label = "danger";
													} else if($data_show['status'] == "Success") {
														$label = "success";
													}
												?>
													<tr>
														<td align="center"><?php if($data_show['place_from'] == "API") { ?><i class="fa fa-random"></i><?php } else { ?><i class="fa fa-globe"></i><?php } ?></td>
														<td><?php echo $data_show['oid']; ?></td>
														<td><?php echo $data_show['user']; ?></td>
														<td><?php echo $data_show['service']; ?></td>
														<td><input type="text" class="form-control" value="<?php echo $data_show['link']; ?>" style="width: 200px;"></td>
														<td><?php echo number_format($data_show['quantity'],0,',','.'); ?></td>
														<td><?php echo number_format($data_show['price'],0,',','.'); ?></td>
														<td><?php echo $data_show['poid']; ?></td>
														<td><?php echo $data_show['provider']; ?></td>
														<td><span class="badge badge-<?php echo $label; ?>"><?php echo $data_show['status']; ?></span></td>
														<td align="center"><span class="badge badge-<?php if($data_show['refund'] == 0) { echo "danger"; } else { echo "success"; } ?>"><?php if($data_show['refund'] == 0) { ?><i class="fa fa-times"></i><?php } else { ?><i class="fa fa-check"></i><?php } ?></span></td>
														<td align="center">
														<a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("orders"); ?>&oid=<?php echo base64_encode($data_show['oid']); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
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
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="http://facebook.com/adminfatur">S1L3NT</a></span></div>
            </div>
        </footer>
        <!-- End Footer -->
<?php } ?>