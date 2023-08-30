<?php 
	$q = mysql_query("SELECT count(code) as rkiosco1_media FROM deposits WHERE status='tunggukonfirmasi' ", $link);
	if(mysql_num_rows($q) > 0) {
		$row = mysql_fetch_assoc($q);
                echo $row['rkiosco1_media'];
	}
?>