<?php
if (empty($data_user['level'])){
	header("Location: ".$config['url_web']."?");
} else if ($data_user['level'] != "Admin"){
	header("Location: ".$config['url_web']."?");
} else {
if (isset($_GET['sid'])) {
	$post_sid = base64_decode($tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_GET['sid'],ENT_QUOTES))))));
	$checkdb_service = $tur->query("SELECT * FROM services WHERE sid = '$post_sid'");
	$datadb_service = mysqli_fetch_assoc($checkdb_service);
	if (mysqli_num_rows($checkdb_service) == 0) {
		header("Location: ".$config['url_web']."?");
	} else {
if (isset($_POST['edit'])) {
	$post_cat = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['category'],ENT_QUOTES)))));
	$post_service = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['service'],ENT_QUOTES)))));
	$post_note = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['note'],ENT_QUOTES)))));
	$post_min = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['min'],ENT_QUOTES)))));
	$post_max = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['max'],ENT_QUOTES)))));
	$post_price = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['price'],ENT_QUOTES)))));
	$post_pid = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['pid'],ENT_QUOTES)))));
	$post_provider = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['provider'],ENT_QUOTES)))));
	$post_status = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['status'],ENT_QUOTES)))));

	if (empty($post_service) || empty($post_note) || empty($post_min) || empty($post_max) || empty($post_price) || empty($post_pid) || empty($post_provider)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Mohon Mengisi Semua Input.";
	} else if ($post_status != "Active" AND $post_status != "Not active") {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Input Tidak Sesuai.";
	} else {
		$update_service = $tur->query("UPDATE services SET category = '$post_cat', service = '$post_service', note = '$post_note', min = '$post_min', max = '$post_max', price = '$post_price', status = '$post_status', pid = '$post_pid', provider = '$post_provider' WHERE sid = '$post_sid'");
		if ($update_service == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Berhasil:</b> Layanan berhasil diubah.<br /><b>Service ID:</b> $post_sid<br /><b>Service Name:</b> $post_service<br /><b>Category:</b> $post_cat<br /><b>Note:</b> $post_note<br /><b>Min:</b> ".number_format($post_min,0,',','.')."<br /><b>Max:</b> ".number_format($post_max,0,',','.')."<br /><b>Price/1000:</b> Rp. ".number_format($post_price,0,',','.')."<br /><b>Provider ID:</b> $post_pid<br /><b>Provider Code:</b> $post_provider<br /><b>Status:</b> $post_status";
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
                            <h4 class="header-title mb-4">Ubah Layanan</h4>
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
												<label class="col-md-2 control-label">Service ID</label>
												<div class="col-md-10">
													<input type="text" class="form-control" placeholder="Service ID" value="<?php echo $datadb_service['sid']; ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Service Name</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="service" placeholder="Service Name" value="<?php echo $datadb_service['service']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Category</label>
												<div class="col-md-10">
													<select class="form-control" name="category">
														<option value="<?php echo $datadb_service['category']; ?>"><?php echo $datadb_service['category']; ?> (Selected)</option>
														<?php
														$check_cat = mysqli_query($tur, "SELECT * FROM service_cat ORDER BY name ASC");
														while ($data_cat = mysqli_fetch_assoc($check_cat)) {
														?>
														<option value="<?php echo $data_cat['id']; ?>"><?php echo $data_cat['name']; ?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Note</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="note" placeholder="Note" value="<?php echo $datadb_service['note']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Min Order</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="min" placeholder="Min Order" value="<?php echo $datadb_service['min']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Max Order</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="max" placeholder="Max Order" value="<?php echo $datadb_service['max']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Price/1000</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="price" placeholder="Price/1000" value="<?php echo $datadb_service['price']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Provider ID</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="pid" placeholder="Provider ID" value="<?php echo $datadb_service['pid']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Provider Code</label>
												<div class="col-md-10">
													<select class="form-control" name="provider">
														<option value="<?php echo $datadb_service['provider']; ?>"><?php echo $datadb_service['provider']; ?> (Selected)</option>
														<?php
														$check_prov = mysqli_query($tur, "SELECT * FROM provider");
														while ($data_prov = mysqli_fetch_assoc($check_prov)) {
														?>
														<option value="<?php echo $data_prov['code']; ?>"><?php echo $data_prov['code']; ?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Status</label>
												<div class="col-md-10">
													<select class="form-control" name="status">
														<option value="<?php echo $datadb_service['status']; ?>"><?php echo $datadb_service['status']; ?> (Selected)</option>
														<option value="Active">Active</option>
														<option value="Not active">Not active</option>
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
                        <div class="card-box">
                            <h4 class="header-title mb-4">Kelola Layanan</h4>
											<center><a href="?<?php echo paramEncrypt('control=delete-services')?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Layanan</a>
											<a href="?<?php echo paramEncrypt('control=add-services')?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Layanan</a></center><br><br>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th></th>
														<th>Kategori</th>
														<th>Layanan</th>
														<th>Min</th>
														<th>Max</th>
														<th>Harga/1000</th>
														<th>PID</th>
														<th>Provider</th>
														<th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM services ORDER BY sid ASC"; // edit
$new_query = $tur->query($query_list);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
												?>
													<tr>
														<td align="center"><?php if($data_show['status'] == "Active") { ?><i class="fa fa-check"></i><?php } else { ?><i class="fa fa-times"></i><?php } ?></td>
														<td><?php echo $data_show['category']; ?></td>
														<td><?php echo $data_show['service']; ?></td>
														<td><?php echo number_format($data_show['min'],0,',','.'); ?></td>
														<td><?php echo number_format($data_show['max'],0,',','.'); ?></td>
														<td><?php echo number_format($data_show['price'],0,',','.'); ?></td>
														<td><?php echo $data_show['pid']; ?></td>
														<td><?php echo $data_show['provider']; ?></td>
														<td align="center">
														<a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("services"); ?>&sid=<?php echo base64_encode($data_show['sid']); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
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