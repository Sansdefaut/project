<?php 
include 'session.php';
$data = array();
$database = new Connection();
  $connect = $database->open();

  try {
      
        if (empty($_POST['PayMentGateWay']) OR empty($_POST['paymentphpone']) OR empty($_POST['salesId'])) {
            $data['error'] = true;
      $data['message'] = "Error occurred, all field are required";
        }else{
        $PayMentGateWay = $_POST['PayMentGateWay'];
        $paymentphpone = $_POST['paymentphpone'];
        $salesId = $_POST['salesId'];
        $select_sales = "SELECT *,count(*) as salesowner FROM sales WHERE salesId='$salesId' AND userId='".$_SESSION['userId']."'";
        $prepare_sales = $connect -> prepare($select_sales);
        $prepare_sales -> execute();
        $fetch_sales = $prepare_sales -> fetch(PDO::FETCH_ASSOC);
        if($fetch_sales['salesowner'] != 0 OR $fetch_sales['status'] != 'pending'){

$valuescreat = [
'PayMentGateWay' => $PayMentGateWay,
'paymentphpone' => $paymentphpone,
'salesId' => $salesId,
'status' => 'online',
];
$insert_INTo = "INSERT INTO paymentnow(salesId,payMentGateWay,paymentphpone,status) VALUES(:salesId,:PayMentGateWay,:paymentphpone,:status)";
$prepare_INTo = $connect -> prepare($insert_INTo);
$prepare_INTo ->execute($valuescreat);

if($prepare_INTo){
  $newds = [
    'salesId' => $salesId,
    'status' => 'paid',
  ];
 $select_preorder = "SELECT * FROM cart_product WHERE salesId='$salesId'";
  $prepare_preorder = $connect->prepare($select_preorder);
                                                $prepare_preorder->execute();
  while ($fetch_preorder = $prepare_preorder->fetch(PDO::FETCH_ASSOC)) {
      $selectproder = "SELECT * FROM products WHERE productId='".$fetch_preorder['productId']."'";
                                                    $prepareproder = $connect->prepare($selectproder);
                                                    $prepareproder->execute();
                                                    $fetchpropreder = $prepareproder -> fetch(PDO::FETCH_ASSOC);
     $newuoda = $fetchpropreder['product_quantity'] - $fetch_preorder['quantity'];
     $udatedata = [
                  'newquantity' => $newuoda,
                  'productId' =>$fetch_preorder['productId'],
                  ];
        $updateproduct = "UPDATE products SET product_quantity=:newquantity WHERE productId=:productId";
        $pupdateproduct = $connect -> prepare($updateproduct);
        $pupdateproduct->execute($udatedata);
                                      


                                       }



        $create_status = "UPDATE sales SET
         status=:status
         WHERE salesId=:salesId";
        $prepare_create_status = $connect -> prepare($create_status);
        $prepare_create_status -> execute($newds);

        if($prepare_create_status){
             $data['error'] = false;
              $data['message'] = 'Payment Initialized Successful';
          }else{
           $data['error'] = true;
      $data['message'] = "Error occurred, in Updating Payment data";
          }
   }else{
     $data['error'] = true;
      $data['message'] = "Error occurred, in Updating Payment Form";

   }
    }else{
      $data['error'] = true;
      $data['message'] = "Error occurred, Order is not yours";
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