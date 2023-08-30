<?php
require("../../config/config.php");

if (isset($_POST['service'])) {
	$post_sid = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['service'],ENT_QUOTES)))));
	$check_service = $tur->query("SELECT * FROM services WHERE sid = '$post_sid' AND status = 'Active'");
	if (mysqli_num_rows($check_service) == 1) {
		$data_service = mysqli_fetch_assoc($check_service);
	?>
										<table class="table table-bordered">
											<tbody>
											<tr>
												<td align="center"><b>Minimal</b></td>
												<td align="center"><b>maksimal</b></td>
												<td align="center"><b>harga per 1000</b></td>
											</tr>
											<tr>
												<td align="center"><?php echo number_format($data_service['min'],0,',','.'); ?></td>
												<td align="center"><?php echo number_format($data_service['max'],0,',','.'); ?></td>
												<td align="center">Rp. <?php echo number_format($data_service['price'],0,',','.'); ?></td>
											</tr>
											<tr>
												<td align="center" colspan="3"><b>Note</b></td>
											</tr>
											<tr>
												<td align="center" colspan="3"><?php echo $data_service['note']; ?></td>
											</tr>
 											</tbody>
										</table>
	<?php
	} else {
	?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
													<i class="mdi mdi-block-helper"></i>
													<b>Error:</b> Layanan tidak ditemukan.
												</div>
	<?php
	}
} else {
?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
													<i class="mdi mdi-block-helper"></i>
													<b>Error:</b> Sesuatu berjalan wong.
												</div>
<?php
}