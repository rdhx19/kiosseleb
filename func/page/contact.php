<?php

$hasil = str_replace("0", "62", $kontak['wa']);
?>
                <div class="row">
							<div class="col-md-4">
<div class="card-box text-center ">
	<div class="m-b-md">
		<img src="assets/images/wa.png" width="100px" height="100px" class="img-responsive rounded-circle" alt="user">
		<h5 class="box-title" style="margin: 10px 0 5px 0;">WhatsApp</h5>
		<small><a href="https://api.whatsapp.com/send?phone=<?php echo $hasil; ?>"><?php echo $kontak['wa']; ?></a></small>
	</div>
</div>
							</div><!-- end col -->
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