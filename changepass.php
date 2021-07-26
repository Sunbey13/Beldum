<?php
session_start();
if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';

$old_password = md5($_POST['old_password']);
$fnew_password = md5($_POST['fnew_password']);
$snew_password = md5($_POST['snew_password']);
$login = $_SESSION['user']['login'];
$sql = "SELECT * FROM `users` WHERE `password` = '$old_password' AND `login` = '$login'";
$query = mysqli_query($connect, $sql);
$row = mysqli_num_rows($query);
if ($row > 0){
    if($fnew_password === $snew_password){
        if($old_password != $snew_password){
        $sql_1 = "UPDATE `users` SET `password` = '$snew_password' WHERE `password` = '$old_password' AND `login` = '$login'";
        $query_1 = mysqli_query($connect, $sql_1);
        $_SESSION['msg_succes'] = 'Пароль успешно изменен!';
        header('Location: main.php');
        } else {
            $_SESSION['msg_copy'] = 'Старый и новый пароли совпадают';
            header('Location: main.php');
        }
    } else {
        //Новые пароли не совпадают
        $_SESSION['msg_copy'] = 'Значение нового пароля в обеих полях не совпадает';
        header('Location: main.php');
    }
} else{
    $_SESSION['msg_copy'] = 'Старый пароль не верный';
    header('Location: main.php');
}
?>