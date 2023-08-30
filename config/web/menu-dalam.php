<?php
							if ($data_user['level'] == "Admin") {
							?>
                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-star"></i>Fitur Admin</a>
                                <ul class="submenu">
                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("users"); ?>">kelola pengguna</a></li>
                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("services"); ?>">Kelola Layanan</a></li>
                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("orders"); ?>">Kelola Pesanan</a></li>
                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("deposithis"); ?>">Kelola Setoran</a></li>
                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("news"); ?>">Kelola Berita</a></li>
                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("catatan"); ?>">Kelola Aktivitas Pengguna</a></li>
                                    <li><a href="?<?php echo paramEncrypt('staff=transfers')?>">Kelola Transfer</a></li>
                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("grafik"); ?>">Grafik Pesanan Pengguna</a></li>
                                </ul>
                            </li>
							<?php
							}
							?>
							<?php
							
							if ($data_user['level'] != "Member") {
							?>
							                                    <li><a href="?<?php echo md5("admin"); ?>=<?php echo base64_encode("news"); ?>">Kelola Berita</a></li>
                            <li class="has-submenu">
                                <a href="?<?php echo paramEncrypt('staff=transfer')?>"><i class="fa fa-star"></i>Transfer saldo</a>
                            </li>
                            <li class="has-submenu">
                                <a href="?<?php echo paramEncrypt('staff=voucher')?>"><i class="fa fa-star"></i>Voucher saldo</a>
                            </li>
							<?php
							}
							?>
                            <li class="has-submenu">
                                <a href="<?php echo $config['url_web']; ?>?"><i class="fa fa-home"></i>Halaman Utama</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-shopping-cart"></i>Order Social Media</a>
                                <ul class="submenu">
                                    <li><a href="?<?php echo paramEncrypt('content=order')?>">Order baru</a></li>
                                    <li><a href="?<?php echo paramEncrypt('content=riwayat')?>">Riwayat Order</a></li>
                                </ul>
                            </li>

                           <li class="has-submenu">
                                <a href="#"><i class="fa fa-money"></i>Isi Saldo</a>
                                <ul class="submenu">
                                    <li><a href="?<?php echo md5("topup"); ?>=<?php echo base64_encode("deposit"); ?>">Tambah Saldo</a></li>
                                    <li><a href="?<?php echo md5("topup"); ?>=<?php echo base64_encode("riwayat-deposit"); ?>">Riwayat Isi Saldo</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-tags"></i>Daftar Harga</a>
                                <ul class="submenu">
                                    <li><a href="?<?php echo paramEncrypt('content=harga')?>">Social Media</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="?<?php echo paramEncrypt('content=voucher')?>"><i class="fa fa-money"></i>Redeem Code saldo</a>
                            </li>
                             <li class="has-submenu">
                                <a href="#"><i class="fa fa-info"></i>Info</a>
                                <ul class="submenu">
                                    <li><a href="?<?php echo paramEncrypt('content=apidok')?>">Api Dokumentasi</a></li>
                                    <li><a href="Kiosseleb.apk">Download Aplikasi Kiosseleb</a></li>
                                    <li><a href="https://blog.rkios.site/">Bantuan</a></li>
                                  
                                    <li><a href="https://chat.whatsapp.com/KQLzGdmP4TEEajJ1LUGZ9f">Grup WhatsApp</a></li>
                                    
                            </ul>
                            </li>