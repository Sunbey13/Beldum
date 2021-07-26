<?php
  session_start();
  if (!$_SESSION['user']){
  header('location: index.php');
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
  <link href="css/font-awesome.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/26aceaceb0.js"></script>
  <title>Водители | BelDum</title>
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
                <ul class="nav navbar-nav">
                    <li>
                       <a href="otchet.php" target="_blank"><i class="fa fa-folder-open"></i> Отчет</a>
                    </li>
                    <li>
                      <a href="history.php" target="_blank"><i class="fa fa-file-text"></i> История </a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i> Ресурсы<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="voditel.php" target="_blank">Водители <i class="fa fa-group"></i></a></li>
                          <li><a href="avto.php">Авто <i class="fa fa-truck"></i></a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="organ.php" target="_blank"><i class="fa fa-briefcase"></i> Организации</a>
                    </li>
                    <li>
                      <a href="logout.php"><i class="fa fa-user-times"></i> Выйти</a>
                    </li>
                </ul>
             </div>
        </div>
  </div>
  <div class="container">
    <?php
    $id = $_GET['voditel'];
    if($id){
    $sql = "SELECT * FROM `voditel` WHERE `id` = '$id'";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($query);
    } else {echo "<h4>Параметр ID не был передан.</h4>"; die;}
    ?>
    <form action="saveVod.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <h4>ФИО:</h4>
          <input class="form-control" type="text" placeholder="Введите ФИО водителя" name="Вод_фио_ред" required value="<?php echo $row['FIO'] ?>">
          <h4>Дата рождения:</h4>
          <input type="date" class="form-control" name="Вод_др_ред" required value="<?php echo $row['Date_b'] ?>">
          <h4>Контакты:</h4>
          <input class="form-control" type="text" placeholder="Введите номер телефона" name="Вод_тел_ред" required value="<?php echo $row['Phone'] ?>">
          <h4>Адрес проживания:</h4>
          <input class="form-control" type="text" placeholder="Введите адрес" name="Вод_адрес_ред" required value="<?php echo $row['Address'] ?>">
          <h4>Категория прав:</h4>
          <input class="form-control" type="text" placeholder="Введите категорию(и) прав" name="Категория_ред" required value="<?php echo $row['Category'] ?>">
          <h4>Примечания:</h4>
          <textarea class="form-control-vod" rows="1" placeholder="Введите текст примечания" name='Вод_доп_ред' value="<?php echo $row['Prim'] ?>"></textarea>
          <br>
          <input type="submit" class="btn btn-primary save" value="Сохранить">
    </form>
    <hr>
   <?php include "footer.php" ?>
  </div>
  <script src="js/modal.js"></script>
  <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
  <script src="js/viewpass.js"></script>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>
