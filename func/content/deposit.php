<?php
if(isset($_POST['deposit'])) {
	$post_sistem = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['sistem'],ENT_QUOTES)))));
	$post_method = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['method'],ENT_QUOTES)))));
	$post_quantity = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['quantity'],ENT_QUOTES)))));
	$post_pengirim = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['sending'],ENT_QUOTES)))));
	$post_code = "ID-".random(5)."";
	$post_unik = rand(1,99);
	$post_unik2 = rand(1,99);
	$post_unik3 = rand(1,99);
	$post_unik4 = rand(1,99);

	if(!preg_match('/[^+0-9]/',$post_pengirim)) {
		if(substr($post_pengirim, 0, 3)=='62'){
			$no_pengirim_pulsa = $post_pengirim;
		} else if(substr($post_pengirim, 0, 1)=='0') {
			$no_pengirim_pulsa = '60'.substr($post_pengirim, 1);
		}
	}
	 
	$query_depo = $tur->query("SELECT * FROM deposit_method WHERE name = '$post_method'");
	$data_depo = mysqli_fetch_assoc($query_depo);
	$note = $data_depo['note'];
	$rate = $data_depo['rate'] / 1;
	$price = $rate*$post_quantity;

	$qcheckd= $tur->query("SELECT * FROM deposits WHERE username = '$sess_username' AND status = 'Pending'");
	$countd = mysqli_num_rows($qcheckd);
	 
	$getbalance = $price+$post_unik+$post_unik2+$post_unik3+$post_unik4;
	$getbalance1 = $post_quantity+$post_unik+$post_unik2+$post_unik3+$post_unik4;
	 
	if(preg_match("/./", $post_quantity)) {
		$post_quantity = str_replace(".","", $post_quantity);
	}
	 
	 
	if(empty($post_method) || empty($post_quantity) || empty($post_sistem)) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Silakan isi input.";
	} else if($post_quantity < 15000) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Deposit Minimum adalah 15000.";
	} else if ($countd >= 100) {
		$msg_type = "error";
		$msg_content = "<b>Gagal</b><br>Anda Masih Memiliki Permintaan Tertunda untuk Deposit, Selesaikan Pembayaran Segera !.";
	} else {
		if ($post_method == "BCA") {
			$insert_depo = $tur->query("INSERT INTO deposits (code, username, pengirim, note, method, sistem, quantity, unik, balance, status, place_from, date) VALUES ('$post_code', '$sess_username', '$no_pengirim_pulsa', '$note', '$post_method', '$post_sistem', '$getbalance1', '$post_unik'+'$post_unik2'+'$post_unik3'+'$post_unik4', '$getbalance', 'Pending', 'WEB', '$date')");
			$insert_depo = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$sess_username', 'Anda telah melakukan aktivitas deposit $getbalance', '$date $time')");
			if($insert_depo == TRUE) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil:</b> Permintaan Deposit Berhasil.<br />Metode Pembayaran: ".$data_depo['name']." <br />Harap transfer ke: <b>".$data_depo['QRIS.jpeg']."</b> dengan jumlah &nbsp; ".number_format($getbalance1,0,',','.')." Dan Anda akan mendapatkan kesaldo Sebesar &nbsp; " .number_format($getbalance,0,',','.');
			} else {
				$msg_type = 'error';
				$msg_content = "<b>Gagal</b><br>Error System";
			}
		}
		else {
			$insert_depo = $tur->query("INSERT INTO deposits (code, username, pengirim, note, method, sistem, quantity, unik, balance, status, place_from, date) VALUES ('$post_code', '$sess_username', '$no_pengirim_pulsa', '$note', '$post_method', '$post_sistem', '$post_quantity', '$post_unik'+'$post_unik2'+'$post_unik3'+'$post_unik4', '$price', 'Pending', 'WEB', '$date')");
			$insert_depo = $tur->query("INSERT INTO catatan (username, note, waktu) VALUES ('$sess_username', 'Anda telah melakukan aktivitas deposit $price', '$date $time')");
			if($insert_depo == TRUE) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil:</b> Permintaan Deposit Berhasil.<br />Metode Pembayaran: ".$data_depo['name']." <br />Harap transfer ke: <b>".$data_depo['note']."</b> dengan jumlah &nbsp;".number_format($post_quantity,0,',','.')." Dan Anda akan mendapatkan kesaldo Sebesar &nbsp;".number_format($price,0,',','.');
				
				
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
											<b>Baca From Informasi Yang Terletak Paling Dibawah Sebelum Melakukan Submit</b><br>
											*note : pembayaran via pulsa kena rate(potongan saldo).
											<br>&emsp; bank & dompet digital tidak kena rate (tanpa potongan saldo).
											</div></div>
    <div><div class="alert alert-info">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>											        
										<br>	<b><i>Info : Deposit pulsa hanya untuk metode pulsa transfer operator, apabila ingin melalui pulsa isi ulang silahkan <a href="https://wa.me/12066419399?text=hi%20saya%20ingin%20deposits%20manual">Hubungi Kami</a></i></b>
											
				</div></div>
                <div></div><div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Deposit Baru</h4>
										<?php 
										if (isset($msg_type) && ($msg_type) == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if (isset($msg_type) && ($msg_type) == "error") {
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
												<label class="col-md-2 control-label">Sistem</label>
												<div class="col-md-10">
													<select class="form-control" name="sistem" id="sistem">
														<option value="0">Pilih Satu</option>
														<option value="Bank">Bank/ATM</option><option value="BDigital">Dompet Digital</option><option value="Pulsa">Pulsa (transfer)</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Metode</label>
												<div class="col-md-10">
													<select class="form-control" name="method" id="method">
														<option value="0">Pilih Metode</option>
													</select>
												</div>
											</div>
											<div id="note">
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Jumlah Saldo</label> 
												<div class="col-md-10">
													<input type="number" name="quantity" class="form-control" placeholder="Total" onkeyup="get_total(this.value).value;">Isi nomor tanpa  menggunakan titik "."
												</div>
											</div>
											<input type="hidden" id="rate" value="0">
											<div class="form-group row">
												<label class="col-md-2 control-label">Saldo Diperoleh</label>
												<div class="col-md-10">
													<input type="number" class="form-control" id="total" readonly>
												</div>
											</div>
											<div class="form-group row justify-content-end">

												<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="deposit" a href="<?php
define('BOT_TOKEN', '1019923665:AAEtNMK4ynM1B5ILbQzBieUYzp77DI7H9co');
define('CHAT_ID','908247245');
 
function kirimTelegram($pesan) {
    $pesan = json_encode($pesan);
    $pesan1 = $data_user = 'username';
    $API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".CHAT_ID."&text=$pesan, $pesan1";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $API);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
    
}
 
kirimTelegram("$username deposit");?>">Buat Deposit </button>
										
											</div>
										</form>
                        </div>
                        <div class="row">
		<div class="col-md-12"><div class="card-box">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-info-circle fa-fw"></i> Informasi</h4>
			<div class="card-body">
			<p>
         <h4>Langkah-langkah:</h4>
         <ul>
          <li>Pilih jenis pembayaran yang Anda inginkan, tersedia 2 opsi: <b>Transfer Bank</b> & <b>Transfer Pulsa</b>.</li>
          <li>Pilih jenis permintaan yang Anda inginkan, tersedia 2 opsi:
           <ul>
            <li><b>Otomatis:</b> Pembayaran Anda akan dikonfirmasi secara otomatis oleh sistem dalam 5-10 menit setelah melakukan pembayaran.</li>
            <li><b>Manual:</b> Anda melakukan konfirmasi pembayaran pada Admin agar deposit Anda dapat diterima, Konfirmasi Deposit Pada Kolom Sukses Dan Widget WA Dibagian Kanan-Bawah.</li>
           </ul>
          </li>
          <li>Pilih metode pembayaran yang Anda inginkan.</li>
          <li>Masukkan jumlah deposit.</li>
          <li>Jika Anda memilih jenis pembayaran <b>Transfer Pulsa</b>, Anda diharuskan menginput nomor HP yang digunakan untuk transfer pulsa.</li>
         </ul>
         <h4>Penting:</h4>
         <ul>
          <li>Anda hanya dapat memiliki maksimal 3 permintaan deposit Pending, jadi jangan melakukan <i>spam</i> dan segera lunasi pembayaran.</li>
          <li>Jika permintaan deposit tidak dibayar dalam waktu lebih dari 24 jam, maka permintaan deposit akan otomatis dibatalkan.</li>
         </ul>  			</p>
		</div></div>
	</div>
	 <!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+6281291420705", // WhatsApp number
            call_to_action: "Konfirmasi Saldo?", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
</div>

                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div> <!-- end wrapper -->

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                 <div class="pull-left">2018 © <a href="javascript:void(0);"><?php echo $config['nama_web']; ?></a></div>
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="r">S1L3NT</a></span></div>
            </div>
        </footer>
        <!-- End Footer -->
						<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
	$("#sistem").change(function() {
		var sistem = $("#sistem").val();
		$.ajax({
			url: '<?php echo $config['url_web']; ?>config/inc/deposit_sistem.php',
			data: 'sistem=' + sistem,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#method").html(msg);
			}
		});
	});
	$("#method").change(function() {
		var method = $("#method").val();
		$.ajax({
			url: '<?php echo $config['url_web']; ?>config/inc/deposit_rate.php',
			data: 'method=' + method,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#rate").val(msg);
			}
		});
		$.ajax({
			url: '<?php echo $config['url_web']; ?>config/inc/deposit.php',
			data: 'method=' + method,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#note").html(msg);
			}
		});
	});
});

function get_total(quantity) {
	var rate = $("#rate").val();
	var result = eval(quantity) * rate;
	$('#total').val(result);
}
	</script>