<?php
require("../../config/config.php");

if (isset($_POST['sistem'])) {
	$post_cat = $tur->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['sistem'],ENT_QUOTES)))));
	$check_depo = $tur->query("SELECT * FROM deposit_method WHERE sistem = '$post_cat' ORDER BY name ASC");
	?>
	<option value="0">Select one...</option>
	<?php
	while ($data_depo = mysqli_fetch_assoc($check_depo)) {
	?>
	<option value="<?php echo $data_depo['name'];?>"><?php echo $data_depo['name'];?></option>
	<?php
	}
} else {
?>
<option value="0">Not Found.</option>
<?php
}