<?php
  session_start();
  if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
$id = $_GET['org'];
if($id){
$sql_1 = "DELETE FROM organ_adres WHERE `Organ_id` = '$id'";
$query_1 = mysqli_query($connect, $sql_1);    
$sql = "DELETE FROM organ WHERE `id` = '$id'";
$query = mysqli_query($connect, $sql);
header('Location: organ.php');
}
?>