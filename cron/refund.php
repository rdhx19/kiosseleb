<?php
require_once("../config/config.php");
require_once("../config/setting.php"); 

$check_order = $tur->query("SELECT * FROM orders WHERE status IN ('Error','Partial') AND refund = '0'");

if (mysqli_num_rows($check_order) == 0) {
	die("Order Error or Partial not found.");
} else {
	while($data_order = mysqli_fetch_assoc($check_order)) {
		$o_oid = $data_order['oid'];
		$u_remains = $data_order['remains'];
		
		    $priceone = $data_order['price'] / $data_order['quantity'];
		    $refund = $priceone * $u_remains;
		    $buyer = $data_order['user'];
		    if($u_remains == 0) {
		        $refund = $data_order['price'];
		    }
		    
			$update_order = $tur->query("UPDATE users SET balance = balance+$refund WHERE username = '$buyer'");
    		$update_order = $tur->query("UPDATE orders SET refund = '1'  WHERE oid = '$o_oid'");
    		if ($update_order == TRUE) {
    			echo "Refunded Rp $refund - $o_oid<br />";
    		} else {
    			echo "Error database.";
    		}
	}
}