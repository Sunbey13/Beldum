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
  <link rel="stylesheet" href="css/print.css">
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
                        <a href="javascript:(print());"><i class="fa fa-print"></i> Печать</a>
                    </li>
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
    if($_SESSION['vod_dr']){
          echo '<p class="form-info">'.$_SESSION['vod_dr'].'</p><br>';
        }unset($_SESSION['vod_dr']);
  ?>
  <h4 class="put-list">Список водителей компании</h4>
  <a href="#myModal-vod" class="btn btn-primary" data-toggle="modal">Добавить водителя</a>
  <div id="myModal-vod" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Заголовок модального окна -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавить водителя</h4>
        </div>
        <!-- Основное содержимое модального окна -->
        <form action="addVod.php" method="POST">
        <div class="modal-body">
          <h4>ФИО:</h4>
          <input class="form-control" type="text" placeholder="Введите ФИО водителя" name="Вод_фио" required>
          <h4>Дата рождения:</h4>
          <input type="date" class="form-control" name="Вод_др" required>
          <h4>Контакты:</h4>
          <input class="form-control" type="text" placeholder="Введите номер телефона" name="Вод_тел" required>
          <h4>Адрес проживания:</h4>
          <input class="form-control" type="text" placeholder="Введите адрес" name="Вод_адрес" required>
          <h4>Категория прав:</h4>
          <input class="form-control" type="text" placeholder="Введите категорию(и) прав" name="Категория" required>
          <h4>Примечания:</h4>
          <textarea class="form-control-vod" rows="1" placeholder="Введите текст примечания" name='Вод_доп'></textarea>
        </div>
        <!-- Футер модального окна -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
          <input type="submit" name="addVod" value="Добавить" class="btn btn-primary">
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="org-table">
    <table class="table simple-table">
      <tr>
        <td class="table-head">ФИО</td>
        <td class="table-head">Дата рождения</td>
        <td class="table-head">Адрес</td>
        <td class="table-head">Категории прав</td>
        <td class="table-head">Телефон</td>
        <td class="table-head">Примечания</td>
        <td class="table-head non-print">Ред.</td>
        <td class="table-head non-print">Дел.</td>
      </tr>
      <?php
        $sql = "SELECT * FROM voditel ORDER BY FIO ASC";
        $res = mysqli_query($connect, $sql);
        $row = mysqli_num_rows($res);
        while ($row = mysqli_fetch_array($res)){
          echo "<tr>\n";
          echo "<td>".$row['FIO']."</td>\n";
          echo "<td>".$row['Date_b']."</td>\n";
          echo "<td>".$row['Address']."</td>\n";
          echo "<td>".$row['Category']."</td>\n";
          echo "<td>".$row['Phone']."</td>\n";
          echo "<td>".$row['Prim']."</td>\n";
          echo "<td><a class=\"red-link\" href=\"editVod.php?voditel=".$row['id']."\"><i class=\"fa fa-pencil\"></i></a></td>";
          echo "<td><a class=\"red-link\" href=\"delVod.php?voditel=".$row['id']."\"><i class=\"fa fa-trash\"></i></a></td>";
          echo "</tr>\n";
        }
      ?>
    </table>
  </div>
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
