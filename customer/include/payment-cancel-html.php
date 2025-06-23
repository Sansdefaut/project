<?php 
include 'session.php';
$data = array();
$database = new Connection();
  $connect = $database->open();

  try {
  	  
        if (empty($_POST['jobapp_no'])) {
        	  $data['error'] = true;
			$data['message'] = "Error occurred, all field are required";
        }else{
  	    
  	    $salesId = $_POST['jobapp_no'];
        $select_sales = "SELECT count(*) as salesowner FROM sales WHERE salesId='$salesId' AND userId='".$_SESSION['userId']."'";
        $prepare_sales = $connect -> prepare($select_sales);
        $prepare_sales -> execute();
        $fetch_sales = $prepare_sales -> fetch(PDO::FETCH_ASSOC);
        if($fetch_sales['salesowner'] != 0 OR $fetch_sales['status'] != 'pending'){

  $newds = [
    'salesId' => $salesId,
    'status' => 'canceled',
  ];
        $create_status = "UPDATE sales SET
         status=:status
         WHERE salesId=:salesId";
        $prepare_create_status = $connect -> prepare($create_status);
        $prepare_create_status -> execute($newds);

        if($prepare_create_status){
             $data['error'] = false;
              $data['message'] = 'Sales canceled Successful';
        	}else{
           $data['error'] = true;
			$data['message'] = "Error occurred, in Canceling Sales";
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