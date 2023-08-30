<?php

if (isset($_POST['order'])) {

	$post_service = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['service'],ENT_QUOTES)))));
	$post_quantity = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['quantity'],ENT_QUOTES)))));
	$post_link = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['link'],ENT_QUOTES)))));

	$check_service = $tur->query("SELECT * FROM services WHERE sid = '$post_service' AND status = 'Active'");
	$data_service = mysqli_fetch_assoc($check_service);

	$check_orders = $tur->query("SELECT * FROM orders WHERE link = '$post_link' AND status IN ('Pending','Processing')");
	$data_orders = mysqli_fetch_assoc($check_orders);
	$rate = $data_service['price'] / 1000;
	$price = $rate*$post_quantity;
	$oid = rand(10000,99999);
	$service = $data_service['service'];
	$provider = $data_service['provider'];
	$pid = $data_service['pid'];

	$check_provider = $tur->query("SELECT * FROM provider WHERE code = '$provider'");
	$data_provider = mysqli_fetch_assoc($check_provider);

	if (empty($post_service) || empty($post_link) || empty($post_quantity)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Silakan Isi Semua Input.";
	} else if (mysqli_num_rows($check_orders) == 1) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>ada pesanan lain dengan target/link yang sama, tunggu orderan sebelum nya selesai";
	} else if (mysqli_num_rows($check_service) == 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Layanan tidak ditemukan.";
	} else if (mysqli_num_rows($check_provider) == 0) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Maintenance.";
	} else if ($post_quantity < $data_service['min']) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Jumlah Minimum Tidak Cocok.";
	} else if ($post_quantity > $data_service['max']) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Jumlah Maksimum Tidak Cocok.";
	} else if ($data_user['balance'] < $price) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Saldo Anda tidak mencukupi.";
	} else {
		// api data
			$api_link = $data_provider['link'];
			$api_key = $data_provider['api_key'];
			// end api data

			if ($provider == "MANUAL") {
				$api_postdata = "";
			} else if ($provider == "MEDANPEDIA") {
                $postdata = "api_id=5291&api_key=$api_key&service=$pid&target=$post_link&quantity=$post_quantity";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://medanpedia.co.id/api/order');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $chresult = curl_exec($ch);
                curl_close($ch);
                    $json_result = json_decode($chresult);
			} else {
				die("System Error!");
			}

            if ($provider != "MANUAL" AND $json_result->status == false) {
				$msg_type = "error";
				$msg_content = "<b>Gagal: </b> ".$json_result->data;
			} else {
				if ($provider == "MEDANPEDIA") {
					$poid = $json_result->data->id;
				} else if ($provider == "MANUAL") {
					$poid = $oid;
				}
					$update_user = $tur->query("UPDATE users SET balance = balance-$price WHERE username = '$sess_username'");
					$update_user = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$sess_username', 'You have done an Order activity $service', '$date $time')");
				if ($update_user == TRUE) {
					$insert_order = $tur->query("INSERT INTO orders (oid, poid, user, service, link, quantity, remains, start_count, price, status, date, provider, place_from) VALUES ('$oid', '$poid', '$sess_username', '$service', '$post_link', '$post_quantity', '0', '0', '$price', 'Pending', '$date', '$provider', 'WEB')");
				if ($insert_order == TRUE) {
					$msg_type = "success";
					$msg_content = "<b>Success</b><br /><b>Message Received</b><br /><b>ID Pesanan:</b> $oid<br /><b>Layanan:</b> $service<br /><b>Link:</b> $post_link<br /><b>Total:</b> ".number_format($post_quantity,0,',','.')."<br /><b>Price:</b> Rp. ".number_format($price,0,',','.');
				} else {
					$msg_type = 'error';
					$msg_content = "<b>Gagal</b><br>Error System";
				}
			} else {
				$msg_type = 'error';
				$msg_content = "<b>Gagal</b><br>Error System";
			}
		}
	}
}

?><div><div class="alert alert-warning">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-info-circle"></i>
											Baca from informasi yang terletak paling dibawah sebelum melakukan Submit
										</div></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Order baru</h4>
										<?php 
										if (isset($msg_type) && ($msg_type) == 'success') {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if (isset($msg_type) && ($msg_type) == 'error') {
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
												<label class="col-md-2 control-label">Kategori</label>
												<div class="col-md-10">
													<select class="form-control" id="category">
														<option value="0">Select One...</option>
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
												<label class="col-md-2 control-label">Layanan</label>
												<div class="col-md-10">
													<select class="form-control" name="service" id="service">
														<option value="0">Pilih Categori...</option>
													</select>
												</div>
											</div>
											<div id="note">
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Link/Target</label>
												<div class="col-md-10">
													<input type="text" name="link" class="form-control" placeholder="Link/Target">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">jumlah</label>
												<div class="col-md-10">
													<input type="number" name="quantity" class="form-control" placeholder="Total" onkeyup="get_total(this.value);">
												</div>
											</div>
											
											<input type="hidden" id="rate" value="0">
											<div class="form-group row">
												<label class="col-md-2 control-label">total harga</label>
												<div class="col-md-10">
													<input type="number" class="form-control" id="total" readonly>
												</div>
											</div>
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="order">Buat Order</button>
												</div>
											</div>
										</form>
										<div>
										<b><h4><i class="fa fa-info-circle"></i>Informasi</h4><br></b>
											<b>Langkah-langkah membuat pesanan baru:</b><br />
<ul><li>Pilih salah satu Kategori.</li><br />
<li>Pilih salah satu Layanan yang ingin dipesan.</li><br />
<li>Masukkan Target pesanan sesuai ketentuan yang diberikan layanan tersebut.</li><br />
<li>Masukkan Jumlah Pesanan yang diinginkan.</li><br />
<li>Klik Submit untuk membuat pesanan baru</li><br />
</ul><br />
<ul><b>Ketentuan membuat pesanan baru:</b><br />
 <li>Silahkan membuat pesanan sesuai langkah-langkah diatas.</li><br />
<li>Jika ingin membuat pesanan dengan<br />
Target yang sama dengan pesanan yang sudah pernah dipesan sebelumnya, mohon menunggu sampai pesanan sebelumnya selesai diproses.<br />jangan lupa baca menu F.A.Q serta Terms
Jika terjadi kesalahan / mendapatkan pesan gagal yang kurang jelas, silahkan hubungi Admin untuk informasi lebih lanjut.</li><br />
 <li>Jangan memasukkan orderan yang sama jika orderan sebelumnya belum selesai. </li><br />
 <li>Jangan memasukkan orderan yang sama di panel lain jika orderan di MedanPedia belum selesai. </li><br />
 <li>Jangan mengganti username atau menghapus link target saat sudah order. </li><br />
 <li>Orderan yang sudah masuk tidak dapat di cancel / refund manual, seluruh proses orderan dikerjakan secara otomatis oleh server. </li><br />
 <li>Jika Anda memasukkan orderan di RKios berarti Anda sudah mengerti aturan Rkios dan <b><a href="?<?php echo paramEncrypt('content=ketentuan')?>">jangan lupa baca menu F.A.Q serta Terms</a></li></b>

										</div></div>
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
						<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
	$("#category").change(function() {
		var category = $("#category").val();
		$.ajax({
			url: '<?php echo $config['url_web']; ?>func/content/order_service.php',
			data: 'category=' + category,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#service").html(msg);
			}
		});
	});
	$("#service").change(function() {
		var service = $("#service").val();
		$.ajax({
			url: '<?php echo $config['url_web']; ?>func/content/order_note.php',
			crossDomain: true,
			/*
			headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            */
			data: 'service=' + service,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#note").html(msg);
			}
		});

		$.ajax({
			url: '<?php echo $config['url_web']; ?>func/content/order_rate.php',
			data: 'service=' + service,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#rate").val(msg);
			}
		});

	});
});

function get_total(quantity) {
	var rate = $("#rate").val();
	var result = eval(quantity) * rate;
	console.info('get_total :: quantity : '+quantity+', rate : '+rate);
	$('#total').val(result);
}
	</script>