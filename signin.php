<?php
session_start();
require_once 'db_connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
if(mysqli_num_rows($check_user) > 0){

    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "login" => $user['login'],
        "id" => $user['id']
    ];

    header('Location: main.php');
} else {
    $_SESSION['msg'] = 'Не верный логин или пароль';
    header('Location: index.php');
}
?>

