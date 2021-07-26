<?php
  session_start();
  if ($_SESSION['user']){
    header('location: main.php');
  }
  include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="image/BD.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/map.css">
  <script src="https://use.fontawesome.com/26aceaceb0.js"></script>
  <title>BelDum | Авторизация</title>
</head>
<body>
<div class="navbar navbar-default navbar-static-top">
      <div class="container">
          <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu" name="login">
                <span class="sr-only">Открыть навигацию</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand logot" href="main.php"><img src="image/logo.png"></a>
          </div>
      </div>
</div>
<div class="container">
  <div class="row auth-row">
    <div class="col-md-5"></div>
      <div class="col-md-3 auth_vvod">
      <h3 class="auth-title">Авторизация</h3>
      <form method="POST" action="signin.php">
        <label for="login">Логин</label>
        <input name="login" type="text" placeholder="Введите логин" class="form-control" required>
        <br>
        <label for="password">Пароль</label>
        <input name="password" id="password-input" type="password" placeholder="Введите пароль" class="form-control" required>
        <label><input type="checkbox" class="password-checkbox"> Показать пароль</label>
        <br>
        <input type="submit" class="btn btn-primary btn-auth" value="Войти"></input>
      </form>
      <?php
        if($_SESSION['msg']){
          echo '<p class="form-info">'.$_SESSION['msg'].'</p>';
        }unset($_SESSION['msg']);
      ?>
    </div>
    <div class="col-md-4"></div>
  </div>
<footer id="footer" class="footer-index">
<hr>  
  <div class="row">
          <div class="col-xs-8">
              <ul class="list-unstyled list-inline pull-left">
                  <li><a href="mailto:dmitriybelousov33@gmail.com" target="_blank"><i class="fa fa-question"></i> Связь с поддержкой</a></li> 
              </ul>
          </div>
          <div class="col-xs-4">
              <p class="text-muted pull-right"> © Дмитрий Белоусов - 2020 </p>
          </div>
      </div>
</footer>
</div>
<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="js/viewpass.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>
