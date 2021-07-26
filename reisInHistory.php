<?php
  session_start();
  if (!$_SESSION['user']){
    header('location: index.php');
  }
  include 'db_connect.php';
  $id = $_GET['reis'];
    $sql = "UPDATE reis SET `Del` = 0 WHERE `id` = '$id'";
    $query = mysqli_query($connect, $sql);
    header('Location: otchet.php');
?>