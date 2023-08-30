
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">List harga Sosial Media</h4>
<?php 
$check_service = $tur->query("SELECT * FROM services ORDER BY sid ASC");

if (mysqli_num_rows($check_service) != 0) {
?>
										<div class="alert alert-info">
												<i class="fa fa-info"></i>: List Tidak Muncul? Silakan Refresh Halaman<br />
												
											</div>
									<form class="form-horizontal" role="form" method="POST">
											<div class="form-group row">
												<label class="control-label">Categori</label>
													<select class="form-control" id="category">
														<option value="0">Select One...</option>
														<?php
														$check_cat = $tur->query("SELECT * FROM service_cat ORDER BY name ASC");
														while ($data_cat = mysqli_fetch_assoc($check_cat)) {
														?>
														<option value="<?php echo $data_cat['id']; ?>"><?php echo $data_cat['name']; ?></option>
														<?php
														}
														?>
													</select>
											</div>
											<div id="note"></div>
									</form>
<?php
} else {
?>
										<div class="alert alert-info">
												No Services Available
											</div>
<?php
}
?>
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
						<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
	$("#category").change(function() {
		var category = $("#category").val();
		$.ajax({
			url: '<?php echo $config['url_web']; ?>func/content/service.php',
			data: 'category=' + category,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#note").html(msg);
			}
		});
	});
});
	</script>