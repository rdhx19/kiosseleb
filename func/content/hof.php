
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Top 5 Pembelian Bulan Ini</h4>
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
														<th> Peringkat </th>
<th> Nama Pengguna </th>
<th> jumlah pembelian </th>
                                        </tr>
                                        </thead>
                                        <tbody>
														<?php
														$check_hof = $tur->query("SELECT a.username as users, b.user , SUM(b.price) as total FROM users a INNER JOIN hof b ON a.username = b.user where user = a.username and b.type ='Sosmed' GROUP BY b.user ORDER BY total DESC LIMIT 5");
														$no = 1;
														while ($data_hof = mysqli_fetch_assoc($check_hof)) {
													if($no == "1") {
														$label = "success";
													} else if($no == "2") {
														$label = "info";
													} else if($no == "3") {
														$label = "warning";
													} else if($no == "4") {
														$label = "danger";
													} else if($no == "5") {
														$label = "danger";
													}
														?>
														<tr>
														<td align="center"><span class="badge badge-<?php echo $label; ?>"><?php echo $no; ?></span></td>
														<td><?php echo $data_hof['users']; ?></td>
														<td>Rp. <?php echo number_format($data_hof['total'],0,",",".");?></td>
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
                    
                    
                    <div class="col-md-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">5 Deposit Terbaik bulan ini</h4>
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
																												<th> Peringkat </th>
<th> Nama Pengguna </th>
<th> jumlah pembelian </th>
                                        </tr>
                                        </thead>
                                        <tbody>
														<?php
														$check_hof = $tur->query("SELECT a.username as users, b.user , SUM(b.price) as total FROM users a INNER JOIN hof b ON a.username = b.user where user = a.username and b.type ='Deposit' GROUP BY b.user ORDER BY total DESC LIMIT 5");
														$no = 1;
														while ($data_hof = mysqli_fetch_assoc($check_hof)) {
													if($no == "1") {
														$label = "success";
													} else if($no == "2") {
														$label = "info";
													} else if($no == "3") {
														$label = "warning";
													} else if($no == "4") {
														$label = "danger";
													} else if($no == "5") {
														$label = "danger";
													}
														?>
														<tr>
														<td align="center"><span class="badge badge-<?php echo $label; ?>"><?php echo $no; ?></span></td>
														<td><?php echo $data_hof['users']; ?></td>
														<td>Rp <?php echo number_format($data_hof['total'],0,",",".");?></td>
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
                 <div class="pull-right"><span class ="hide-phone">Create With <i class="mdi mdi-heart text-danger"></i> by <a href="">S1L3NT</a></span></div>
            </div>
        </footer>
        <!-- End Footer -->