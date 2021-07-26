<?php
session_start();
if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
if(isset($_POST['addAdr']))
{
    $Address = $_POST['Address'];
    $Sector = $_POST['Sector'];
    $Organ_id = $_POST['Organ_id'];
   $sql = "INSERT INTO  organ_adres(id, Address, Sector, Organ_id) VALUES(NULL, '$Address', '$Sector', '$Organ_id')";
   $result = mysqli_query($connect, $sql);
   mysqli_close($connect);
   header('Location: organ.php');
}
?>