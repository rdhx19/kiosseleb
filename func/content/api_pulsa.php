<?php
//************************************************
//* Developer : Muhammad Fahturrozi (S1L3NT)
//* Release Date : 01 Agustus 2018
//* © Dilarang Keras Mengedit/Menghapus Semuanya ©
//* © Hargai Orang Jika Anda Ingin Dihargai ©
//* UU Nomor 28 Tahun 2014
//************************************************

if (isset($_POST['ubah'])) {
	$set_api_key = random(20);
	$update_user = $tur->query("UPDATE users SET api_key = '$set_api_key' WHERE username = '$sess_username'");
	if ($update_user == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b><br> API Key Telah Diubah.";
	} else {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Error System 
.";
	}
}
$sess_username = $_SESSION['user']['username'];	$check_user = $tur->query("SELECT * FROM users WHERE username = '$sess_username'");
$data_user = mysqli_fetch_assoc($check_user);
?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Order</h4>
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
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="<?php echo $data_user['api_key']; ?>" name="api" aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="ubah">Ubah Api</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										</form>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Parameters</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>URL</td>
													<td><?php echo $config['url_web']; ?>api/api_pulsa.php</td>
												</tr>
												<tr>
													<td>key</td>
													<td>Your API key</td>
												</tr>
												<tr>
													<td>action</td>
													<td>add</td>
												</tr>
												<tr>
													<td>service</td>
													<td>Service ID <a href="<?php echo $config['url_web']; ?>?<?php echo paramEncrypt('content=harga-pulsa')?>">Check at price list</a></td>
												</tr>
												<tr>
													<td>phone</td>
													<td>target to page</td>
												</tr>
												<tr>
													<td>Example PHP Code</td>
													<td><a href="<?php echo $config['url_web']; ?>api/api_order_pulsa.txt" target="blank">Example</a></td>
												</tr>
											</tbody>
										</table>
									</div>
<b>Example Response</b><br />
<pre>
IF ORDER SUCCESS

{
	"status" = "true",
	"data" = {
		"id" = "12345"
	}	
}

IF ORDER FAIL

{
	"status" = "false",
	"data" = {
		"msg" = "Incorrect Request"
	}	
}
</pre>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Status</h4>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Parameters</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>URL</td>
													<td><?php echo $config['url_web']; ?>api/api_pulsa.php</td>
												</tr>
												<tr>
													<td>key</td>
													<td>Your API key</td>
												</tr>
												<tr>
													<td>action</td>
													<td>status</td>
												</tr>
												<tr>
													<td>id</td>
													<td>Your order id</td>
												</tr>
												<tr>
													<td>Example PHP Code</td>
													<td><a href="<?php echo $config['url_web']; ?>api/api_status_pulsa.txt" target="blank">Example</a></td>
												</tr>
											</tbody>
										</table>
									</div>
<b>Example Response</b><br />
<pre>
IF CHECK STATUS SUCCESS

{
	"status" = "true",
	"data" = {
		"id" = "12345"
		"status" = "Success"
	}	
}

IF CHECK STATUS FAIL

{
	"status" = "false",
	"data" = {
		"msg" = "Incorrect Request"
	}	
}
</pre>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Services</h4>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Parameters</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>URL</td>
													<td><?php echo $config['url_web']; ?>api/api_pulsa.php</td>
												</tr>
												<tr>
													<td>key</td>
													<td>Your API key</td>
												</tr>
												<tr>
													<td>action</td>
													<td>services</td>
												</tr>
											</tbody>
										</table>
									</div>
<b>Example Response</b><br />
<pre>
IF CHECK STATUS SUCCESS

{
	"status" = "true",
	"data" = {
		"sid" = "1"
		"category" = "Telkomsel"
		"service" = "Telkomsel 10000"
		"price" = "10000"
		"status" = "Active"
	}
}

IF CHECK STATUS FAIL

{
	"status" = "false",
	"data" = {
		"msg" = "Incorrect Request"
	}	
}
</pre>
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