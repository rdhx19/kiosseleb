<!--
//************************************************
//* Developer : Muhammad Fahturrozi (S1L3NT)
//* Release Date : 01 Agustus 2018
//* © Dilarang Keras Mengedit/Menghapus Semuanya ©
//* © Hargai Orang Jika Anda Ingin Dihargai ©
//* UU Nomor 28 Tahun 2014
//************************************************
-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">RIWAYAT ORDER</h4>
                                    <div class="table-responsive">
                                        <div style="border: 2px #006400 ridge; padding: 10px; text-align: left;">ARTI STATUS ORDER<br>
                           <td align="center"><span class="badge badge-success">Success</span></td> = Artinya orderan Anda telah tuntas sepenuhnya.<Br>
                           <td><span class="badge badge-danger">Partial</span></td> = Artinya orderan Anda telah tuntas namun hanya sebagian, biaya juga hanya sebagian diambil tergantung dari jumlah yang sudah masuk.<Br>
                           <td><span class="badge badge-danger">Error</span></td> = Orderan anda batal atau tidak dapat diproses karena suatu kesalahan dan ada kode kesalahan nya beserta artinya dibawah saldo otomatis langsung dikembalikan. Jika anda bingung bisa kontak CS.<br>
                           <td><span class="badge badge-info">Processing</span></td> = Order Anda telah di cek dan valid untuk selanjutnya sedang dalam proses.
                           <div><div class="alert alert-info">
											
										 *Geser ke kanan jika lihat dari HP
										</div></div>
                           </div>
                                    <table id="datatable" class="table table-bordered table-striped">
                                        
                                        <tr>
                                             <th> ID Pesanan </th>
                                             <th> Layanan </th>
                                             <th> Target </th>
                                             <th> Total </th>
                                             <th> Jumlah Awal </th>
                                             <th> Sisa </th>
                                             <th> Harga </th>
                                             <th> Status </th>
                                             <th> Pengembalian dana </th>
                                        </tr>
                                        
                                        <tbody>
                                                                       
														<?php
// start paging config
$query_order = "SELECT * FROM orders WHERE user = '$sess_username' ORDER BY id DESC"; // edit
$new_query = $tur->query($query_order);
// end paging config
														$no = 1;
												while ($data_order = mysqli_fetch_assoc($new_query)) {
													if($data_order['status'] == "Pending") {
														$label = "warning";
													} else if($data_order['status'] == "Processing") {
														$label = "info";
													} else if($data_order['status'] == "Error") {
														$label = "danger";
													} else if($data_order['status'] == "Partial") {
														$label = "danger";
													} else if($data_order['status'] == "Success") {
														$label = "success";
													}
												?>
														<tr>
														<td><?php echo $data_order['oid']; ?></td>
														<td><?php echo $data_order['service']; ?> (<?php if($data_order['place_from'] == "API") { ?><i class="fa fa-random"></i><?php } else { ?><i class="fa fa-globe"></i><?php } ?>)</td>
														<td><?php echo $data_order['link']; ?></td>
														<td><?php echo number_format($data_order['quantity'],0,',','.'); ?></td>
														<td><?php echo number_format($data_order['start_count'],0,',','.'); ?></td>
														<td><?php echo number_format($data_order['remains'],0,',','.'); ?></td>
														<td>Rp. <?php echo number_format($data_order['price'],0,',','.'); ?></td>
														<td align="center"><span class="badge badge-<?php echo $label; ?>"><?php echo $data_order['status']; ?></span></td>
														<td align="center"><span class="badge badge-<?php if($data_order['refund'] == 0) { echo "danger"; } else { echo "success"; } ?>"><?php if($data_order['refund'] == 0) { ?><i class="fa fa-times"></i><?php } else { ?><i class="fa fa-check"></i><?php } ?></span></td>
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