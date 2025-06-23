<?php
include '../inc/inc.db.php';

	$output = array();

	$database = new Connection();
	$db = $database->open();
	try{
$seku = "SELECT * FROM cart_product WHERE cartId='".$_GET['o_id']."'";
$pseku = $db -> prepare($seku);
$pseku -> execute();
$fseku = $pseku -> fetch(PDO::FETCH_ASSOC);
if ($fseku['status'] == "oncart" AND $fseku['userId'] == $_SESSION['userId']) {
	$dunas = [
		'o_id' => $_GET['o_id'],
	];
	$delet = "DELETE from cart_product WHERE cartId=:o_id";
	$pdelet = $db -> prepare($delet);
	$pdelet -> execute($dunas);
	if ($pdelet) {
		 $output = 'deleted successful';
	}else{
		 $output = 'Sorry please call IT';
	}
}else{
	 $output = 'Sorry this order was checked out';
}
}
	catch(PDOException $e){
		$output['error'] = true;
		$output['message'] = $e->getMessage();;
	}

	//close connection
	$database->close();

	echo json_encode($output);
	?>