<?php
require("../../config/config.php");

if (isset($_POST['category'])) {
	$post_cat = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['category'],ENT_QUOTES)))));
	$check_service = $tur->query("SELECT * FROM services WHERE category = '$post_cat' AND status = 'Active' ORDER BY sid ASC");
	?>
	<option value="0">Select one...</option>
	<?php
	while ($data_service = mysqli_fetch_assoc($check_service)) {
	?>
	<option value="<?php echo $data_service['sid'];?>"><?php echo $data_service['service'];?> Rp.<?php echo number_format($data_service['price'],0,',','.'); ?>/1k </option>
	<?php
	}
} else {
?>
<option value="0">Not Found.</option>
<?php
}