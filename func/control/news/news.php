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
if (isset($_GET['id'])) {
	$post_id = base64_decode($tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_GET['id'],ENT_QUOTES))))));
	$checkdb_news = $tur->query("SELECT * FROM news WHERE id = '$post_id'");
	$datadb_news = mysqli_fetch_assoc($checkdb_news);
	if (mysqli_num_rows($checkdb_news) == 0) {
		header("Location: ".$config['url_web']."?");
} else {
if (isset($_POST['edit'])) {
	$post_content = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['content'],ENT_QUOTES)))));
	$post_type = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['type'],ENT_QUOTES)))));

	if (empty($post_content) || empty($post_type)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Mohon Mengisi Semua Input.";
	} else {
		$update_news = $tur->query("UPDATE news SET content = '$post_content', type = '$post_type' WHERE id = '$post_id'");
		if ($update_news == TRUE) {
			$msg_type = "success";
			$msg_content = "<b>Berhasil</b><br>Informasi Telah Diubah.";
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
                            <h4 class="header-title mb-4">Ubah Informasi</h4>
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
												<label class="col-md-2 control-label">Type</label>
												<div class="col-md-10">
													<select class="form-control" name="type">
														<option value="<?php echo $datadb_news['type']; ?>"><?php echo $datadb_news['type']; ?> (Selected)</option>
														<option value="UPDATE">Update</option>
														<option value="INFO">Info</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Konten</label>
												<div class="col-md-10">
													<textarea name="content" class="form-control" placeholder="Konten"><?php echo $datadb_news['content']; ?></textarea>
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
                            <h4 class="header-title mb-4">Kelola Informasi</h4>
											<center><a href="?<?php echo paramEncrypt('control=delete-news')?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Informasi</a>
											<a href="?<?php echo paramEncrypt('control=add-news')?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Informasi</a></center><br><br>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th>#</th>
														<th>Tipe</th>
														<th>Konten</th>
														<th>Tanggal</th>
														<th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM news ORDER BY id DESC"; // edit
$new_query = $tur->query($query_list);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
													if($data_show['type'] == "UPDATE") {
														$label = "warning";
													} else if($data_show['type'] == "INFO") {
														$label = "info";
													}
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td align="center"><span class="badge badge-<?php echo $label; ?>"><?php echo $data_show['type']; ?></span></td>
														<td><?php echo nl2br($data_show['content']); ?></td>
														<td><?php echo $data_show['date']; ?></td>
														<td align="center">
														<a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("news"); ?>&id=<?php echo base64_encode($data_show['id']); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
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