<?php
session_start();
if (!$_SESSION['user']){
header('location: index.php');
}
include 'db_connect.php';
    $sql = "UPDATE reis SET `Del` = 0 WHERE `Del` = 1";
    $query = mysqli_query($connect, $sql);
    header('Location: main.php');
?>