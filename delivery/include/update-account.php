<?php 
include 'session.php';
	$data = array();
$database = new Connection();
  $connect = $database->open();

  try {
  	  
        if (empty($_POST['firstname']) OR empty($_POST['lastname']) OR empty($_POST['email']) OR empty($_POST['phonenumber'])) {
        	  $data['error'] = true;
			$data['message'] = "Error occurred, all field are required";
        }else{
  	    $firstname = $_POST['firstname'];
  	    $lastname = $_POST['lastname'];
  	    $email = $_POST['email'];
  	    $phonenumber = $_POST['phonenumber'];
  	   


    $checkin = "SELECT count(*) as nowcount FROM users WHERE first_name='$firstname' AND last_name='$lastname' AND email='$email' AND phonenumber='$phonenumber' AND userId='".$_SESSION['userId']."'";
    $pcheckin = $connect -> prepare($checkin);
    $pcheckin -> execute();
    $fcheckin = $pcheckin -> fetch(PDO::FETCH_ASSOC);
    if($fcheckin['nowcount'] == 0){
$valuescreat = [
'firstname' => $firstname,
'lastname' => $lastname,
'email' => $email,
'phonenumber' => $phonenumber,
'userId' =>$_SESSION['userId'],
];
        $create_status = "UPDATE users SET
         first_name=:firstname,
         last_name=:lastname,
         email=:email,
         phonenumber=:phonenumber 
         WHERE userId=:userId";
        $prepare_create_status = $connect -> prepare($create_status);
        $prepare_create_status -> execute($valuescreat);

        if($prepare_create_status){
             $data['error'] = false;
              $data['message'] = 'Account data Updated Success full';
        	}else{
           $data['error'] = true;
			$data['message'] = "Error occurred, in Updating Account data";
        	}
      }else{
              $data['error'] = true;
      $data['message'] = "Error occurred, No change Detected";
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