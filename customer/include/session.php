<?php 
include '../../inc/inc.db.php'; 
if (empty($_SESSION['userId']) OR $_SESSION['access_id'] != 2 OR isset($_GET['logout'])) {
 session_destroy();
 session_unset();
 header('location:../');
} ?>