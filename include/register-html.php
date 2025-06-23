<?php

 include '../inc/inc.db.php';

$data = array();
 $database = new Connection();
  $connect = $database->open();
try {
    if(!empty($_POST['firstname']) && 
        !empty($_POST['lastname']) &&
        !empty($_POST['phonenumber']) &&
         !empty($_POST['email']) &&
          !empty($_POST['password'])
        ){




    $uniqueID = 'acc'.uniqid();
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $passwords = $_POST['password'];
 

    $select_phone = "SELECT count(*) as countphone FROM users WHERE email='$email'";
    $prepare_phone = $connect -> prepare($select_phone);
    $prepare_phone -> execute();
    $fetch_phone = $prepare_phone -> fetch(PDO::FETCH_ASSOC);

    if ($fetch_phone['countphone'] != 0) {
            $data['error'] = true;
            $data['message'] = "Sorry, email  exist";
    }else{
        $select_phone = "SELECT count(*) as countphone FROM users WHERE phonenumber='$phonenumber'";
    $prepare_phone = $connect -> prepare($select_phone);
    $prepare_phone -> execute();
    $fetch_phone = $prepare_phone -> fetch(PDO::FETCH_ASSOC);

    if ($fetch_phone['countphone'] != 0) {
            $data['error'] = true;
            $data['message'] = "Sorry, Phone Number  exist";
    }else{
      
        $passworda = md5($passwords);
        $duba = [
            'userId' => $uniqueID,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenumber' => $phonenumber,
            'email' => $email,
            'passwords' => $passworda, 
            'status' => 'online',
            'access_id' => '2',

        ];
    $insert_employer = "INSERT INTO users(userId,first_name,last_name,email,phonenumber,passwords,access,status) VALUES (:userId,:firstname,:lastname,:email,:phonenumber,:passwords,:access_id,:status)";
    $prepare_insert_employer = $connect -> prepare($insert_employer);
    $prepare_insert_employer -> execute($duba);

    if (!$prepare_insert_employer) {
            $data['error'] = true;
            $data['message'] = "Sorry, Creation Of  Account got error";
    }else{
        $selectdata = "SELECT * FROM users WHERE email='$email' AND phonenumber='$phonenumber'";
        $preparedata = $connect -> prepare($selectdata);
        $preparedata -> execute();
        $fetchdata = $preparedata -> fetch(PDO::FETCH_ASSOC);
            $fullname = $fetchdata['first_name']." ".$fetchdata['last_name'];
        
        $_SESSION['userId'] = $fetchdata['userId'];
        
        $_SESSION['fullname'] = $fetchdata['first_name']." ".$fetchdata['last_name'];
        $_SESSION['access_id'] = $fetchdata['access'];
         $data['message'] = 'Welcome '.$fullname;
}

    
}
}


}else{
    $data['error'] = true;
    $data['message'] = "All field are required";
}
}catch(PDOException $e){
        $data['error'] = true;
        $data['message'] = $e->getMessage();
    }
    //close connection
    $database->close();

    echo json_encode($data);
 ?>