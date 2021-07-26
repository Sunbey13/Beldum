<?php
  session_start();
  if (!$_SESSION['user']){
    header('location: index.php');
  }
  include 'db_connect.php';
    $Date = $_POST['Date'];
    $Organ_id = $_POST['Organ'];
    $Sector_id = $_POST['Sector'];
    $Voditel_id = $_POST['Voditel_id'];
    $Prim = $_POST['Prim'];
    $Privezti = $_POST['Privezti'];
    $Name_tov_dost = $_POST['Name_tov_dost'];
    $Weight_tov_dost = $_POST['Weight_tov_dost'];
    $Kurator_dost = $_POST['Kurator_dost'];
    $Kurator_dost_tel = $_POST['Kurator_dost_tel'];
    $Otvezti = $_POST['Otvezti'];
    $Name_tov_otpr = $_POST['Name_tov_otpr'];
    echo $Name_tov_otpr;
    $Weight_tov_otpr = $_POST['Weight_tov_otpr'];
    echo $Weight_tov_otpr;
    $Kurator_otpr = $_POST['Kurator_otpr'];
    $Kurator_otpr_tel = $_POST['Kurator_otpr_tel'];

    // создаем рейс
    $sql_reis = "INSERT INTO reis VALUES(NULL, '$Voditel_id', '$Date', '$Sector_id', '$Prim', 1)";
    $query_reis = mysqli_query($connect, $sql_reis);
    // запоминаем его id
    $sql_max_id = "SELECT MAX(`id`) AS `id` FROM reis";
    $query_max_id = mysqli_query($connect, $sql_max_id);
    $row_max_id = mysqli_fetch_assoc($query_max_id);
    $reis_id = $row_max_id['id'];
    if($Privezti != 'NULL'){
    //добавляем товар доставки
    $sql_tovar_dost = "INSERT INTO tovar VALUES (NULL, '$Weight_tov_dost', '$Name_tov_dost')";
    $query_tov_dost = mysqli_query($connect, $sql_tovar_dost);
    //запоминаем его id
    $sql_max_id_tov = "SELECT MAX(`id`) as `id` FROM tovar";
    $query_max_id_tov= mysqli_query($connect, $sql_max_id_tov);
    $row_max_id_tov = mysqli_fetch_array($query_max_id_tov);
    $max_id_tov = $row_max_id_tov['id'];
    //добавляем его в список доставки/отправки
    $sql_dost = "INSERT INTO dost_otpr VALUES(NULL, '$reis_id', '$max_id_tov', '$Kurator_dost', '$Kurator_dost_tel', '$Privezti')";
    $query_dost = mysqli_query($connect, $sql_dost);
    }
    if($Otvezti != 'NULL'){
    //добавляем товар отправления
    $sql_tovar_otpr = "INSERT INTO tovar VALUES (NULL, '$Weight_tov_otpr', '$Name_tov_otpr')";
    echo $sql_tovar_otpr;
    $query_tov_otpr = mysqli_query($connect, $sql_tovar_otpr);
    //запоминаем его id
    $sql_max_id_tov = "SELECT MAX(`id`) AS `id` FROM tovar";
    $query_max_id_tov= mysqli_query($connect, $sql_max_id_tov);
    $row_max_id_tov = mysqli_fetch_array($query_max_id_tov);
    $max_id_tov = $row_max_id_tov['id'];
    //добавляем его в список доставки/отправки
    $sql_otpr = "INSERT INTO dost_otpr VALUES(NULL, '$reis_id', '$max_id_tov', '$Kurator_otpr', '$Kurator_otpr_tel', '$Otvezti')";
    $query_otpr = mysqli_query($connect, $sql_otpr);
    }
    header('Location: main.php');
?>