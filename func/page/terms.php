<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Ketentuan</h4>
										<p>Layanan disediakan oleh <?php echo $config['nama_web']; ?> perjanjian berikut telah dibuat.</p>
										<p><b>1. umum</b>
										<br />Dengan mendaftar dan menggunakan layanan <?php echo $config['nama_web']; ?>,Anda secara otomatis menyetujui semua ketentuan layanan kami. Kami berhak mengubah ketentuan layanan ini tanpa pemberitahuan sebelumnya. Anda diharapkan membaca semua ketentuan layanan kami sebelum melakukan pemesanan.
										<br />Rejection: <?php echo $config['nama_web']; ?> tidak akan bertanggung jawab jika Anda mengalami kerugian dalam bisnis Anda.
										<br />Obligation: <?php echo $config['nama_web']; ?> tidak bertanggung jawab jika Anda mengalami penangguhan akun atau penghapusan pengiriman yang dilakukan oleh Instagram, Twitter, Facebook, Youtube, dan lainnya.
										<br><br /><b>2. layanan</b>
										<br /><?php echo $config['nama_web']; ?> hanya digunakan untuk media promosi media sosial dan membantu meningkatkan tampilan akun Anda saja.
										<br /><?php echo $config['nama_web']; ?> tidak menjamin bahwa pengikut baru Anda berinteraksi dengan Anda, kami hanya menjamin bahwa Anda mendapatkan pengikut yang Anda beli.
										<br /><?php echo $config['nama_web']; ?> tidak menerima permintaan pembatalan / pengembalian dana setelah pesanan masuk ke sistem kami. Kami memberikan pengembalian uang yang sesuai jika pesanan tidak dapat diselesaikan.
										<br/>                        <center>
<form method="POST" action="<?php echo $config["url_web"];?>">
 mengerti<input type="checkbox" name="checkbox" value="check" />
 <input type="submit" name="email_submit" value="kembali" onclick="if(!this.form.checkbox.checked){alert('Anda harus menyetujui persyaratan terlebih dahulu.');return false}"  />
</form></center></p>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div> <!-- end wrapper -->

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                 <div class="pull-left">2019 © <a href="javascript:void(0);"><?php echo $config['nama_web']; ?></a></div>
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="">M.Ridho Hakim</a></span></div>
            </div>
        </footer>
        <!-- End Footer -->