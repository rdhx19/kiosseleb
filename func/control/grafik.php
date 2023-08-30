<?php
if (empty($data_user['level'])){
	header("Location: ".$config['url_web']."?");
} else if ($data_user['level'] != "Admin"){
	header("Location: ".$config['url_web']."?");
} else {
?>
                <div class="row">
                    <div class="col-md-12">
                       <div class="card-box">
                            <h4 class="header-title mb-4">Grafik Pesanan 7 Hari Terakhir Seluruh Pengguna</h4>
                                               <center>
                                                <ul class="list-inline chart-detail-list">
                                                    <li class="list-inline-item">
                                                        <span><i class="fa fa-circle m-r-5" style="color: #008000;"></i>Sosial Media</span>
                                                    </li>
                                                    
                                                </ul>
                                               </center>
                                            <div id="tampan" style="height: 300px;"></div>
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
<?php } ?>