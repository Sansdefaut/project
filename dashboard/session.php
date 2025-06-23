<?php
 include '../inc/inc.db.php'; 
if (empty($_SESSION['userId']) OR $_SESSION['access_id'] != 1 OR isset($_GET['logout'])) {
 session_destroy();
 session_unset();
 header('location:../');
}else{
  $database = new Connection();
  $connect = $database->open();
  try {
 $userId = $_SESSION['userId'];
 $select_myaccounts = "SELECT * FROM users WHERE userId='$userId'";
  $prepare_select_myaccounts = $connect -> prepare($select_myaccounts);
  $prepare_select_myaccounts -> execute();
  $fetch_username = $prepare_select_myaccounts -> fetch(PDO::FETCH_ASSOC);
  $username = $fetch_username['first_name']." ".$fetch_username['last_name'];
   $profilepicture = '';
  if($fetch_username['profilepicture'] != ''){
    $profilepicture = $fetch_username['profilepicture'];
  }
 }catch(PDOException $e){
    $message = $e->getMessage();
    echo $message;
  }
  //close connection
  $database->close();
}

  ?>