<?php
include '../inc/inc.db.php';
$database = new Connection();
$connect = $database->open();

$searchPrefix = '250789';

$query = "SELECT phonenumber FROM users WHERE phonenumber LIKE :prefix";
$stmt = $connect->prepare($query);
$likeParam = $searchPrefix . '%';
$stmt->bindParam(':prefix', $likeParam);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($results);

$database->close();
?>
