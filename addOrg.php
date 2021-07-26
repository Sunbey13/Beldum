<?php
session_start();
if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
    $Name_org = $_POST['Name_org'];
    $Spec = $_POST['Spec'];
   $sql = "INSERT INTO  organ(id, Name_org, Spec) VALUES(NULL, '$Name_org', '$Spec')";
   $result = mysqli_query($connect, $sql);
   mysqli_close($connect);
   header('Location: organ.php');
?>