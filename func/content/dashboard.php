                <div class="row">
                    <div class="col-md-12">
									<div class="alert alert-info">
	<marquee>
	<?php
date_default_timezone_set("Asia/Jakarta");
$time = date('H:i:s');
$date = date("Y-m-d");
$i=0;

$tampil = $tur->query("SELECT * FROM orders WHERE date = '$date' ORDER BY id DESC LIMIT 20");

if (mysqli_num_rows($tampil) == 0) {
echo "<b>[".$date."]</b> anda belum melakukan pesanan saat ini...";
} else {


while($data = mysqli_fetch_assoc($tampil))
 {
		$slider_userstr = "-".strlen($data['user']);
		$slider_usersensor = substr($data['user'],$slider_userstr,-4);
 $i++;
 
echo "<span style='margin-right: 30px;'>[".$data['date']."] <b>".$slider_usersensor."****</b> telah melakukan pembelian ".$data['quantity']." ".$data['service']."</span>";
}
}
	?>
	</marquee>
									</div><br>
									                <div class="row">
                    <div class="col-md-12">
                            <div class="card-box">
                            <h4 class="header-title mb-4">laporan Pesanan <?php echo $data_user['username']; ?> 7 Hari Terakhir</h4>
                                               <center>
                                                <ul class="list-inline chart-detail-list">
                                                    <li class="list-inline-item">
                                                        <span><i class="fa fa-circle m-r-5" style="color: #008000;"></i>Sosial Media</span>
                                                    </li>
                                                    
                                                </ul>
                                               </center>
                                            <div id="fatur" style="height: 200px;"></div>
                        </div><!-- end col -->
                                            <div class="col-md-12">
                                                <div class="card-box">
                           <center> <h4 class="header-title mb-4">WAJIB BACA INFORMASI</h4></center>
                           <div style="border: 2px #006400 ridge; padding: 10px; text-align: left;">Di <a href="https://kiosseleb.site">kiosseleb</a> Anda Bisa Membeli Untuk Kebutuhan Sendiri Atau Untuk Reseller Karena <a href="https://kiosseleb.site">kiosseleb</a> Menjual Layanan Sosial Media Dengan Harga Grosir</div>
                           <div style="border: 2px #006400 ridge; padding: 10px; text-align: left;">Jika Sudah Membuat <a href="?<?php echo paramEncrypt('content=order')?>">Order</a> Maka Orderan Sedang Di Proses Silakan Cek Status Order Di <a href="?<?php echo paramEncrypt('content=riwayat')?>">Riwayat Order</a></div>
    <div style="border: 2px #006400 ridge; padding: 10px; text-align: left;">CARA RESELLER SILAKAN KUNJUNGI <a href="https://blog.kiosseleb.site">BLOG</a> KAMI</div>
    <div style="border: 2px #006400 ridge; padding: 10px; text-align: left;">Apa yang dimaksud dengan Refill?<br>
Dalam bahasa sederhana nya sendiri adalah Garansi pengisian ulang kembali. Jika nanti layanan yang Anda pesan seperti Followers Drop atau turun maka akan terisi kembali jumlahnya sesuai yang sebelumnya Anda pesan. Ada batas waktu tertentu untuk Refill normalnya 30 Hari dan perlu diperhatikan, dalam masa Refill yaitu setelah Anda order layanan yang memiliki keterangan khusus Refill setelah status telah Completed Akun Anda tidak boleh mengganti username dan private akun atau Jaminan Refill akan hilang.<br>
Note :  Untuk Refill jika tidak berjalan otomatis bisa request ke Admin melalui tiket atau whatsapp.<br>
Add : Khusus Refill Instagram Followers Indonesia, kami sudah memiliki sistem refill khusus, dimana ada layanan khusus untuk refill followers indonesia, cukup masukan saja username yang ingin di refill di kategori Instagram Followers Indonesia [Refill] Kemudian pilih layanan (REQUEST) Refil lInstagram Followers Indonesia</div><br>
<button class="btn_style"><a href="kiosseleb.apk">Download Aplikasi kiosseleb</a></button> 
    
    
    </div></div>
    
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Layanan Rekomendasi</h4>
<div class="table-responsive">
												
													<tbody>
													<?php
function bacaURL($url){
     $session = curl_init(); // buat session
     // setting CURL
     curl_setopt($session, CURLOPT_URL, $url);
  curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
     $hasil = curl_exec($session);
     curl_close($session);
     return $hasil;
}
$sumber =  bacaURL('https://medanpedia.co.id/auth/index');
$ambil_kata = explode('<div class="mt-2 mb-2">', $sumber);
$ambil_kata_lagi = explode('</div>', $ambil_kata[1]?? '');
echo $ambil_kata_lagi[0];
?>
													</tbody>
												</table>
											</div>
                        </div>
                        
                    </div> <!-- end col -->
                   <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Activity Note</h4>
                            <div class="table-responsive">
												<table class="table table-striped table-bordered table-hover m-0">
													<thead>
														<tr>
															<th>#</th>
															<th>Note</th>
															<th>Time</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$check_catatan = $tur->query("SELECT * FROM catatan WHERE username = '$sess_username' ORDER BY id DESC LIMIT 5");
														$no = 1;
														while ($data_catatan = mysqli_fetch_assoc($check_catatan)) {
														?>
														<tr>
															<th scope="row"><?php echo $no; ?></th>
															<td><?php echo $data_catatan['note']; ?></td>
															<td><?php echo $data_catatan['waktu']; ?></td>
														</tr>
														<?php
														$no++;
														}
														?>
													</tbody>
												</table>
											</div>
<center><a href="?<?php echo paramEncrypt('content=view')?>">Read More</a></center>
                        </div>
                        <!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+6281291420705", // WhatsApp number
            call_to_action: "Butuh Bantuan?", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
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
        