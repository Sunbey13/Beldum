<?php
  session_start();
  if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
$id = $_GET['avto'];
if($id){
$sql = "DELETE FROM avto WHERE `id` = '$id'";
$query = mysqli_query($connect, $sql);
header('location: avto.php');
}
?>