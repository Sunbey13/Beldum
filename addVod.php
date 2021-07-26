<?php
session_start();
if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
    $vod_fio = $_POST['Вод_фио'];
    $vod_dr = $_POST['Вод_др'];
    $vod_tel = $_POST['Вод_тел'];
    $vod_address = $_POST['Вод_адрес'];
    $category = $_POST['Категория'];
    $vod_dop = $_POST['Вод_доп'];
      if($vod_dr > '1900-01-01'){
            $sql = "INSERT INTO voditel(id, FIO, Date_b, Address, Category, Phone, Prim) VALUES(NULL, '$vod_fio', '$vod_dr', '$vod_address', '$category', '$vod_tel', '$vod_dop')";
            $result = mysqli_query($connect,$sql);
            mysqli_close($connect);
            header('Location: voditel.php');
      } else {
               $_SESSION['vod_dr'] = 'Дата рождения не может быть раньше 01.01.1900';
               header('Location: voditel.php');
      }
?>