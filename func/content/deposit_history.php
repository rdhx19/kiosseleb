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
                            <h4 class="header-title mb-4">Riwayat Deposit</h4>
                            <div><div class="alert alert-info">
											
										 *Geser ke kanan jika lihat dari HP
										</div></div>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th>Code ID</th>
														<th>Metode</th>
														<th>tujuan</th>
														<th>Saldo Isi Ulang</th>
                                                        <th>Saldo Diterima</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
														<?php
														$check_depo = $tur->query("SELECT * FROM deposits WHERE username = '$sess_username' ORDER BY id DESC");
														$no = 1;
														while ($data_depo = mysqli_fetch_assoc($check_depo)) {
													if($data_depo['status'] == "Pending") {
														$label = "warning";
													} else if($data_depo['status'] == "Error") {
														$label = "danger";
													} else if($data_depo['status'] == "Success") {
														$label = "success";
													}
														?>
														<tr>
														<td><?php echo $data_depo['code']; ?></td>
														<td><?php echo $data_depo['method']; ?></td>
														<td><?php echo $data_depo['note']; ?></td>
														<td><?php echo number_format($data_depo['quantity'],0,',','.'); ?></td>
														<td><?php echo number_format($data_depo['balance'],0,',','.'); ?></td>
														<td><?php echo $data_depo['date']; ?></td>
														<td align="center"><span class="badge badge-<?php echo $label; ?>"><?php echo $data_depo['status']; ?></span></td>
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