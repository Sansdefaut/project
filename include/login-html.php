<?php

 include '../inc/inc.db.php';

$data = array();
 $database = new Connection();
  $connect = $database->open();
try {
	$username = $_POST['username'];
	$password = $_POST['passwords'];

	$select_phone = "SELECT count(*) as countphone FROM users WHERE email='$username'";
	$prepare_phone = $connect -> prepare($select_phone);
	$prepare_phone -> execute();
	$fetch_phone = $prepare_phone -> fetch(PDO::FETCH_ASSOC);

	if ($fetch_phone['countphone'] != 1) {
	        $data['error'] = true;
			$data['message'] = "Sorry, email  doesn't  exist";
	}else{
		$passworda = md5($password);
		$duba = [
			'username' => $username,
			'passwords' => $passworda,
		];
    $select_all = "SELECT *,count(*) as countall FROM users WHERE  email=:username AND passwords=:passwords";
	$prepare_all = $connect -> prepare($select_all);
	$prepare_all -> execute($duba);
	$fetch_all = $prepare_all -> fetch(PDO::FETCH_ASSOC);
	if ($fetch_all['countall'] != 1) {
	        $data['error'] = true;
			$data['message'] = "Sorry, Credential doesn't match";
	}else{
		
			$fullname = $fetch_all['first_name']." ".$fetch_all['last_name'];
		
		$_SESSION['userId'] = $fetch_all['userId'];
		$_SESSION['access_id'] = $fetch_all['access'];
		$_SESSION['fullname'] = $fullname;
		if ($_SESSION['access_id'] == 1) {
         $data['message'] = 'Welcome '.$fullname;
    
        }else if($_SESSION['access_id'] == 2){
	
         $data['message'] = 'Welcome '.$fullname;

 }
  else if($_SESSION['access_id'] == 3){
	
         $data['message'] = 'Welcome '.$fullname;
         $data['location'] = 'employer/';
 }
  else if($_SESSION['access_id'] == 4){
	
         $data['message'] = 'Welcome '.$fullname;
         $data['location'] = 'employee/';
 }else{
 	  $data['error'] = true;
 	  $data['message'] = 'Account blocked for '.$fullname;
 }
	}

	}


}catch(PDOException $e){
		$data['error'] = true;
 		$data['message'] = $e->getMessage();
 	}
	//close connection
	$database->close();

	echo json_encode($data);
 ?>