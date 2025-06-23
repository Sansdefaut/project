<?php 
include 'session.php';
$data = array();
$database = new Connection();
  $connect = $database->open();

  try {
  	  
        if (empty($_POST['deliveryid']) OR empty($_POST['orderid'])) {
        	  $data['error'] = true;
			$data['message'] = "Error occurred, all field are required";
        }else{
  	    
  	    $deliveryid = $_POST['deliveryid'];
        $orderid = $_POST['orderid'];

        $select_sales = "SELECT count(*) as salesowner FROM sales WHERE userId='$deliveryid' AND salesId='$orderid'";
        $prepare_sales = $connect -> prepare($select_sales);
        $prepare_sales -> execute();
        $fetch_sales = $prepare_sales -> fetch(PDO::FETCH_ASSOC);
        if($fetch_sales['salesowner'] == 0){

  $newds = [
    'userId' => $deliveryid,
    'salesId' => $orderid,
    'code_now' => uniqid(),
    'status' => 'pending',
  ];
        $create_status = "INSERT INTO delivery(userId,salesId,code_now,status) VALUES(:userId,:salesId,:code_now,:status)";
        $prepare_create_status = $connect -> prepare($create_status);
        $prepare_create_status -> execute($newds);

        if($prepare_create_status){
             $data['error'] = false;
              $data['message'] = 'Delivery Assigned  Successful';
        	}else{
           $data['error'] = true;
			$data['message'] = "Error occurred, in Delivery Assigned Sales";
        	}
 
    }else{
      $data['error'] = true;
      $data['message'] = "Error occurred, Order is not Available";
    }
  }
  }catch(PDOException $e){
    $message = $e->getMessage();
    echo $message;
  }
  //close connection
  $database->close();

	echo json_encode($data);
 ?>