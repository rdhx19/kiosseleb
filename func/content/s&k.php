div>
										<p>Layanan disediakan oleh <?php echo $config['nama_web']; ?> perjanjian berikut telah dibuat.</p>
										<p><b>1. umum</b>
										<br />Dengan mendaftar dan menggunakan layanan <?php echo $config['nama_web']; ?>,Anda secara otomatis menyetujui semua ketentuan layanan kami. Kami berhak mengubah ketentuan layanan ini tanpa pemberitahuan sebelumnya. Anda diharapkan membaca semua ketentuan layanan kami sebelum melakukan pemesanan.
										<br />Rejection: <?php echo $config['nama_web']; ?> tidak akan bertanggung jawab jika Anda mengalami kerugian dalam bisnis Anda.
										<br />Obligation: <?php echo $config['nama_web']; ?> tidak bertanggung jawab jika Anda mengalami penangguhan akun atau penghapusan pengiriman yang dilakukan oleh Instagram, Twitter, Facebook, Youtube, dan lainnya.
										<br><br /><b>2. layanan</b>
										<br /><?php echo $config['nama_web']; ?> hanya digunakan untuk media promosi media sosial dan membantu meningkatkan tampilan akun Anda saja.
										<br /><?php echo $config['nama_web']; ?> tidak menjamin bahwa pengikut baru Anda berinteraksi dengan Anda, kami hanya menjamin bahwa Anda mendapatkan pengikut yang Anda beli.
										<br /><?php echo $config['nama_web']; ?> tidak menerima permintaan pembatalan / pengembalian dana setelah pesanan masuk ke sistem kami. Kami memberikan pengembalian uang yang sesuai jika pesanan tidak dapat diselesaikan.</p>
<center>
<form method="POST" action="https://kiosseleb.site/">
 mengerti<input type="checkbox" name="checkbox" value="check" />
 <input type="submit" name="email_submit" value="kembali" onclick="if(!this.form.checkbox.checked){alert('Anda harus menyetujui persyaratan terlebih dahulu.');return false}"  />
</form></center>
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
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="">kiosseleb</a></span></div>
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