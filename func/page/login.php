<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Masuk</h4>
							<?php 
if (isset($msg_type) && $msg_type == "error") {
?>
<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	<i class="fa fa-times-circle"></i>
	<?php echo $msg_content; ?>
</div>
<?php
}
?>

										<div class="alert alert-info">
											<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
										masukan akun yang sudah terdaftar!!
										</div>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group row">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="password" name="password" class="form-control" placeholder="Password">
												</div>
											</div>
											<div class="form-group row justify-content-end">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="login">Masuk</button>
													<button type="reset" class="btn btn-default waves-effect w-md waves-light">Reset</button>
													<br></br><a href="?<?php echo md5("page"); ?>=<?php echo base64_encode("lupa-password"); ?>"><i class="fa fa-question-mark"></i>lupa password?</a>
												</div>
											</div>
										</form>
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