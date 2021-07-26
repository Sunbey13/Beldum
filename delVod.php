<?php
  session_start();
  if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
$id = $_GET['voditel'];
if($id){
$sql = "DELETE FROM voditel WHERE `id` = '$id'";
$query = mysqli_query($connect, $sql);
header('location: voditel.php');
}
?>