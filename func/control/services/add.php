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
} else if ($data_user['level'] != "Admin"){
	header("Location: ".$config['url_web']."?");
} else {
if (isset($_POST['add'])) {
	$post_cat = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['category'],ENT_QUOTES)))));
	$post_service = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['service'],ENT_QUOTES)))));
	$post_note = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['note'],ENT_QUOTES)))));
	$post_min = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['min'],ENT_QUOTES)))));
	$post_max = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['max'],ENT_QUOTES)))));
	$post_price = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['price'],ENT_QUOTES)))));
	$post_pid = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['pid'],ENT_QUOTES)))));
	$post_provider = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['provider'],ENT_QUOTES)))));
	$post_sid = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['sid'],ENT_QUOTES)))));

	$checkdb_service = $tur->query("SELECT * FROM services WHERE sid = '$post_sid'");
	$datadb_service = mysqli_fetch_assoc($checkdb_service);

	if (empty($post_sid) || empty($post_service) || empty($post_note) || empty($post_min) || empty($post_max) || empty($post_price) || empty($post_pid) || empty($post_provider)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Mohon Mengisi Semua Input.";
	} else if (mysqli_num_rows($checkdb_service) > 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Service ID ".$post_sid." Telah Terdaftar.";
	} else {
		$insert_service = $tur->query("INSERT INTO services (sid, category, service, note, min, max, price, status, pid, provider) VALUES ('$post_sid', '$post_cat', '$post_service', '$post_note', '$post_min', '$post_max', '$post_price', 'Active', '$post_pid', '$post_provider')");
		if ($insert_service == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Berhasil:</b> Layanan berhasil ditambahkan.<br /><b>Service ID:</b> $post_sid<br /><b>Service Name:</b> $post_service<br /><b>Category:</b> $post_cat<br /><b>Note:</b> $post_note<br /><b>Min:</b> ".number_format($post_min,0,',','.')."<br /><b>Max:</b> ".number_format($post_max,0,',','.')."<br /><b>Price/1000:</b> Rp. ".number_format($post_price,0,',','.')."<br /><b>Provider ID:</b> $post_pid<br /><b>Provider Code:</b> $post_provider";
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
                            <h4 class="header-title mb-4">Tambah Layanan</h4>
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
												<label class="col-md-2 control-label">Category</label>
												<div class="col-md-10">
													<select class="form-control" name="category">
														<?php
														$check_cat = $tur->query("SELECT * FROM service_cat ORDER BY name ASC");
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
												<label class="col-md-2 control-label">Service ID</label>
												<div class="col-md-10">
													<input type="number" name="sid" class="form-control" placeholder="Service ID">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Service Name</label>
												<div class="col-md-10">
													<input type="text" name="service" class="form-control" placeholder="Service Name">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Note</label>
												<div class="col-md-10">
													<input type="text" name="note" class="form-control" placeholder="Etc: Input username, Input link">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Min Order</label>
												<div class="col-md-10">
													<input type="number" name="min" class="form-control" placeholder="Min Order">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Max Order</label>
												<div class="col-md-10">
													<input type="number" name="max" class="form-control" placeholder="Max Order">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Price/1000</label>
												<div class="col-md-10">
													<input type="number" name="price" class="form-control" placeholder="Etc: 30000">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Provider ID</label>
												<div class="col-md-10">
													<input type="number" name="pid" class="form-control" placeholder="Provider ID">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Provider Code</label>
												<div class="col-md-10">
													<select class="form-control" name="provider">
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
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
											<a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("services"); ?>" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<div class="pull-right">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Ulangi</button>
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="add">Tambah</button>
											</div>
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