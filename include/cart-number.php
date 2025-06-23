<?php 

 include '../inc/inc.db.php';

 $database = new Connection();
  $connect = $database->open();
try {
	if(!empty($_SESSION['userId'])){
		$userid = $_SESSION['userId'];
	   $select_count = "SELECT count(*) as countcart FROM cart_product WHERE userId='$userid' and status='oncart'";
		$prepare_count = $connect -> prepare($select_count);
		$prepare_count -> execute();
		$fetch_count = $prepare_count -> fetch(PDO::FETCH_ASSOC);
		echo $fetch_count['countcart'];
	}else{
		echo "0";
	}
	}catch(PDOException $e){
		$data['error'] = true;
 		$data['message'] = $e->getMessage();
 	}
	//close connection
	$database->close();

 ?>