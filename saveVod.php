<?php
  session_start();
  if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
if(!empty($_POST['id'])){
    $id = $_POST['id'];
    $vod_fio = $_POST['Вод_фио_ред'];
    $vod_date = $_POST['Вод_др_ред'];
    $vod_tel = $_POST['Вод_тел_ред'];
    $vod_adres = $_POST['Вод_адрес_ред'];
    $category = $_POST['Категория_ред'];
    $prim = $_POST['Вод_доп_ред'];

  if($vod_date > '1900-01-01'){
        $sql = "UPDATE voditel SET `FIO` = '$vod_fio', `Date_b` = '$vod_date', `Phone` = '$vod_tel', `Address` = '$vod_adres', `Category` = '$category', `Prim` = '$prim' WHERE `id`='$id'";
        $query = mysqli_query($connect, $sql);
        header('Location: voditel.php');
  } else {
    $_SESSION['vod_dr'] = 'Дата рождения не может быть раньше 01.01.1900';
    header('Location: voditel.php');
  }
} else {
    echo "<h1>Ошибка сохранения данных</h1>";
}
?>