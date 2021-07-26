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
  <link rel="stylesheet" href="css/print.css">
  <script src="https://use.fontawesome.com/26aceaceb0.js"></script>
  <title>Создать пароль | BelDum</title>
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
            <div class="collapse navbar-collapse" id="responsive-menu">
             </div>
        </div>
  </div>
<div class="container">
  <div class="row auth-row">
    <div class="col-md-5"></div>
      <div class="col-md-3 auth_vvod">
      <h3 class="auth-title">Создать пароль</h3>
      <form method="POST" action="addpass.php">
        <label for="password">Пароль</label>
        <input name="password" id="password-input" type="password" placeholder="Введите пароль" class="form-control" required>
        <label><input type="checkbox" class="password-checkbox"> Показать пароль</label>
        <br>
        <input type="submit" class="btn btn-primary btn-auth" value="Зашифровать"></input>
      </form>
      <?php
        $password = $_POST['password'];
          echo '<p class="form-info">'.md5($password).'</p>';
      ?>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
    <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/viewpass.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <script>
      $(function(){
          $('[data-toggle="tooltip"]').tooltip();
          $('[data-toggle="popover"]').popover();
      });
    </script>
  </body>
</html>



