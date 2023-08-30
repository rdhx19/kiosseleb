<?php
require("../../config/config.php");

if (isset($_POST['type'])) {
	$post_cat = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['type'],ENT_QUOTES)))));
	$check_service = $tur->query("SELECT * FROM service_cat_pulsa WHERE type = '$post_cat' ORDER BY name ASC");
	?>
	<option value="0">Select one...</option>
	<?php
	while ($data_service = mysqli_fetch_assoc($check_service)) {
	?>
	<option value="<?php echo $data_service['code'];?>"><?php echo $data_service['name'];?></option>
	<?php
	}
} else {
?>
<option value="0">Error.</option>
<?php
}