<?php 
include 'session.php';
	$data = array();
$database = new Connection();
  $connect = $database->open();

  try {
  	  
        if (empty($_POST['messagebio']) OR $_POST['messagebio']== '') {
        	  $data['error'] = true;
			$data['message'] = "Error occurred, please add Biograthy";
        }else{
  	    $messagebio = $_POST['messagebio'];
 


    $checkin = "SELECT *,count(*) as nowcount FROM biography WHERE userId='".$_SESSION['userId']."'";
    $pcheckin = $connect -> prepare($checkin);
    $pcheckin -> execute();
    $fcheckin = $pcheckin -> fetch(PDO::FETCH_ASSOC);
    if($fcheckin['nowcount'] == 0){
$valuescreat = [
'messagebio' => $messagebio,
'userId' =>$_SESSION['userId'],
'status' => 'active',
];
        $create_status = "INSERT INTO biography(userId,aboutme,status) VALUES(:userId,:messagebio,:status)";
        $prepare_create_status = $connect -> prepare($create_status);
        $prepare_create_status -> execute($valuescreat);

        if($prepare_create_status){
             $data['error'] = false;
              $data['message'] = 'Biograthy added Successful';
        	}else{
           $data['error'] = true;
			$data['message'] = "Error occurred, in adding Biograthy";
        	}
      }else{
              $valuescreat = [
'messagebio' => $messagebio,
'aboutmeId' =>$fcheckin['aboutmeId'],
];
        $create_status = "UPDATE biography SET aboutme=:messagebio WHERE aboutmeId=:aboutmeId";
        $prepare_create_status = $connect -> prepare($create_status);
        $prepare_create_status -> execute($valuescreat);

        if($prepare_create_status){
             $data['error'] = false;
              $data['message'] = 'Biograthy Update Successful';
          }else{
           $data['error'] = true;
      $data['message'] = "Error occurred, in Updating Biograthy";
          }
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