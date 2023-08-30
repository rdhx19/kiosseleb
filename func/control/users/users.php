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
if (isset($_GET['username'])) {
	$post_id = base64_decode($tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_GET['username'],ENT_QUOTES))))));
	$checkdb_users = $tur->query("SELECT * FROM users WHERE username = '$post_id'");
	$datadb_users = mysqli_fetch_assoc($checkdb_users);
	if (mysqli_num_rows($checkdb_users) == 0) {
		header("Location: ".$config['url_web']."?");
	} else {
if (isset($_POST['edit'])) {
	$post_email = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['email'],ENT_QUOTES)))));
	$post_username = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['user'],ENT_QUOTES)))));
	$post_status = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['status'],ENT_QUOTES)))));
	$post_password = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['password'],ENT_QUOTES)))));
	$post_balance = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['balance'],ENT_QUOTES)))));
	$post_level = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['level'],ENT_QUOTES)))));
	$new_password = password_hash($post_password, PASSWORD_DEFAULT);

	if (empty($post_email) || empty($post_username) || empty($post_status) || empty($post_password) || empty($post_balance) || empty($post_level)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Mohon Mengisi Semua Input.";
	} else if ($post_level != "Member" AND $post_level != "Agen" AND $post_level != "Reseller") {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Input Tidak Sesuai.";
	} else if ($post_status != "Active" AND $post_status != "Suspended") {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Input Tidak Sesuai.";
	} else {
		if(password_verify($post_password, $data_user['password'])) {
			$update_user = $tur->query("UPDATE users SET password = '$new_password', balance = '$post_balance', level = '$post_level', status = '$post_status', email = '$post_email' WHERE username = '$post_id'");
			if ($update_user == TRUE) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil:</b> Pengguna berhasil diubah.<br /><b>Email:</b> $post_email<br /><b>Username:</b> $post_username<br /><b>Password:</b> $post_password<br /><b>Level:</b> $post_level<br /><b>Status:</b> $post_status<br /><b>Balance:</b> Rp. ".number_format($post_balance,0,',','.');
			} else {
				$msg_type = "error";
				$msg_content = "<b>Gagal</b><br>Error System.";
			}
		}
	}
}
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Ubah Pengguna</h4>
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
												<label class="col-md-2 control-label">Email</label>
												<div class="col-md-10">
													<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $datadb_users['email']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="user" placeholder="Username" value="<?php echo $datadb_users['username']; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="text" name="password" class="form-control" placeholder="Password">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Level</label>
												<div class="col-md-10">
													<select class="form-control" name="level">
														<option value="<?php echo $datadb_users['level']; ?>"><?php echo $datadb_users['level']; ?> (Selected)</option>
														<option value="Member">Member</option>
														<option value="Agen">Agen</option>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Status</label>
												<div class="col-md-10">
													<select class="form-control" name="status">
														<option value="<?php echo $datadb_users['status']; ?>"><?php echo $datadb_users['status']; ?> (Selected)</option>
														<option value="Active">Active</option>
														<option value="Suspended">Suspended</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Saldo</label>
												<div class="col-md-10">
													<input type="number" name="balance" class="form-control" placeholder="Balance" value="<?php echo $datadb_users['balance']; ?>">
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
                            <h4 class="header-title mb-4">Kelola Pengguna</h4>
											<center><a href="?<?php echo paramEncrypt('control=delete-users')?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Pengguna</a>
											<a href="?<?php echo paramEncrypt('control=add-users')?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pengguna</a></center><br><br>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th></th>
														<th>Email</th>
														<th>Username</th>
														<th>Password</th>
														<th>Level</th>
														<th>Saldo</th>
														<th>Terdaftar</th>
														<th>Uplink</th>
														<th>API Key</th>
														<th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
												<?php
// start paging config
	$query_list = "SELECT * FROM users ORDER BY id DESC"; // edit
$new_query = $tur->query($query_list);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
												?>
													<tr>
														<td align="center"><?php if($data_show['status'] == "Active") { ?><i class="fa fa-check"></i><?php } else { ?><i class="fa fa-times"></i><?php } ?></td>
														<td><?php echo $data_show['email']; ?></td>
														<td><?php echo $data_show['username']; ?></td>
														<td><?php echo $data_show['password']; ?></td>
														<td><?php echo $data_show['level']; ?></td>
														<td>Rp. <?php echo number_format($data_show['balance'],0,',','.'); ?></td>
														<td><?php echo $data_show['registered']; ?></td>
														<td><?php echo $data_show['uplink']; ?></td>
														<td><?php echo $data_show['api_key']; ?></td>
														<td align="center">
														<a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("users"); ?>&username=<?php echo base64_encode($data_show['username']); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
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