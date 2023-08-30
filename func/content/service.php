<?php
require("../../config/config.php");

if (isset($_POST['category'])) {
	$post_cat = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['category'],ENT_QUOTES)))));
	$check_service = $tur->query("SELECT * FROM services WHERE category = '$post_cat' AND status = 'Active' ORDER BY sid ASC");
	?>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th></th>
														<th>ID</th>
														<th>Service</th>
														<th>Price/1000</th>
														<th>Min</th>
														<th>Max</th>
													</tr>
												</thead>
												<tbody>
												<?php
												$check_service = $tur->query("SELECT * FROM services WHERE category = '$post_cat' AND status = 'Active'");
												while ($data_service = mysqli_fetch_assoc($check_service)) {
												?>
													<tr>
														<td align="center"><?php if($data_service['status'] == "Active") { ?><i class="fa fa-check"></i><?php } else { ?><i class="fa fa-times"></i><?php } ?></td>
														<th scope="row"><?php echo $data_service['sid']; ?></th>
														<td><?php echo $data_service['service']; ?></td>
														<td>Rp. <?php echo number_format($data_service['price'],0,',','.'); ?></td>
														<td><?php echo number_format($data_service['min'],0,',','.'); ?></td>
														<td><?php echo number_format($data_service['max'],0,',','.'); ?></td>
													</tr>
												<?php
												} 
												?>
												</tbody>
											</table>
										</div>
<?php
}