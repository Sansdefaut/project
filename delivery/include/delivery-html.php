<?php 
include 'session.php';
$data = array();
$database = new Connection();
  $connect = $database->open();

  try {
    

  	  
        if (empty($_POST['salesId']) || empty($_POST['deliverycode'])) {
        	  $data['error'] = true;
			$data['message'] = "Error occurred, all field are required";
        }else{
  	    
  	    $salesId = $_POST['salesId'];
        $deliverycode = $_POST['deliverycode'];
        $select_sales = "SELECT *,count(*) as salesowner FROM delivery WHERE deli_no='$salesId' AND userId='".$_SESSION['userId']."'";
        $prepare_sales = $connect -> prepare($select_sales);
        $prepare_sales -> execute();
        $fetch_sales = $prepare_sales -> fetch(PDO::FETCH_ASSOC);
        if($fetch_sales['salesowner'] != 0 OR $fetch_sales['status'] == 'pending'){
          if($fetch_sales['code_now'] == $deliverycode){

  $newds = [
    'salesId' => $salesId,
    'status' => 'success',
  ];
        $create_status = "UPDATE delivery SET
         status=:status
         WHERE deli_no=:salesId";
        $prepare_create_status = $connect -> prepare($create_status);
        $prepare_create_status -> execute($newds);

        if($prepare_create_status){
             $data['error'] = false;
              $data['message'] = 'Order Delivered  Successful';
        	}else{
           $data['error'] = true;
			$data['message'] = "Error occurred, in Delivering Orders";
        	}
 }else{

 $data['error'] = true;
      $data['message'] = "Error occurred, Delivery Code is incorrect";
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