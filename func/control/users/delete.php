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
if (isset($_POST['delete'])) {
	$post_id = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['username'],ENT_QUOTES)))));
	$checkdb_users = $tur->query("SELECT * FROM users WHERE username = '$post_id'");
	if (mysqli_num_rows($checkdb_users) == 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Pengguna Tidak Ditemukan.";
	} else {
		$delete_users = $tur->query("DELETE FROM users WHERE username = '$post_id'");
		if ($delete_users == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Berhasil</b><br>Pengguna Telah Dihapus.";
		}
	}
}
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Hapus Pengguna</h4>
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
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<select class="form-control" name="username">
														<option value="0">Pilih salah satu...</option>
														<?php
														$check_users = mysqli_query($tur, "SELECT * FROM users ORDER BY username ASC");
														while ($data_users = mysqli_fetch_assoc($check_users)) {
														?>
														<option value="<?php echo $data_users['username']; ?>"><?php echo $data_users['username']; ?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
											<a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("users"); ?>" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<button type="submit" class="pull-right btn btn-success btn-bordered waves-effect w-md waves-light" name="delete">Hapus</button>
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