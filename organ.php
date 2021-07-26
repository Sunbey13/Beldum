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
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/26aceaceb0.js"></script>
  <title>Организации | BelDum</title>
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
                          <li><a href="avto.php" target="_blank">Авто <i class="fa fa-truck"></i></a></li>
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
<h4 class="put-list">Список организаций для осуществления перевозок</h4>
<a href="#myModal-org" class="btn btn-primary" data-toggle="modal">Добавить организацию</a>
<a href="#myModal-adr" class="btn btn-primary" data-toggle="modal">Добавить адрес</a>
<div class="org-table">
<table class="table simple-table">
<tr>
<td class="table-head">Название организации</td>
<td class="table-head">Специализация</td>
<td class="table-head">Адрес</td>
<td class="table-head"></td>
<td class="table-head non-print"></td>
</tr>
<?php
  $sql = "SELECT `id`, `Name_org`, `Spec` FROM `organ` ORDER BY `Name_org` ASC";
  $res = mysqli_query($connect, $sql);
  $row = mysqli_num_rows($res);
  while ($row = mysqli_fetch_array($res)){
    $id = $row['id'];
    $sql_1 = "SELECT `Address` FROM organ_adres WHERE Organ_id = $id";
    $res_1 = mysqli_query($connect, $sql_1);
    $row_1 = mysqli_num_rows($res_1);
    echo "<tr>\n";
    echo "<td>".$row['Name_org']."</td>\n";
    echo "<td>".$row['Spec']."</td>\n";
    while ($row_1 = mysqli_fetch_array($res_1)){
      echo "<td>".$row_1['Address']."</td>\n";
    }
    echo "<td><a class=\"red-link\" href=\"delOrg.php?org=".$row['id']."\"><i class=\"fa fa-trash\"></i></a></td>";
    echo "</tr>\n";
  }
?>
</table>
</div>
                                    <!-- Организация -->
<div id="myModal-org" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Добавить организацию</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <form action="addOrg.php" method="POST">
      <div class="modal-body">
        <input type="text" name="Name_org" class="form-control" placeholder="Введите название организации" required><br>
        <input type="text" name="Spec" class="form-control" placeholder="Введите специализацию организации" required>
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
        <input type="submit" name="addOrg" value="Добавить" class="btn btn-primary">
      </div>
      </form>
    </div>
  </div>
</div>
                                       <!-- Адрес -->
<div id="myModal-adr" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Добавить адрес</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <form action="addAdr.php" method="POST">
      <div class="modal-body">
        <select class="form-control" name="Organ_id">
        <option value="Выберите организацию">Выберите организацию</option>
        <?php
        include 'db_connect.php';
        $sql = "SELECT id, Name_org FROM organ ORDER BY `Name_org` ASC";
        $res = mysqli_query($connect, $sql);
        $row = mysqli_num_rows($res);
        while ($row = mysqli_fetch_array($res)){
        echo "<option value=\"".$row['id']."\">".$row['Name_org']."</option>";
        }
        ?>
        </select>
        <br>
        <input type="text" name="Address" class="form-control" placeholder="Введите адрес организации" required><br>
        <select class="form-control" name="Sector">
          <option value="Выберите сектор">Выберите сектор</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
        <input type="submit" name="addAdr" value="Добавить" class="btn btn-primary">
      </div>
      </form>
    </div>
  </div>
</div>
<hr>
<?php include "footer.php" ?>
</div><!-- container -->
  <script src="js/modal.js"></script>
  <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
  <script src="js/viewpass.js"></script>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <!-- Скрипт, привязывающий событие click, открывающее модальное окно, к элементам, имеющим класс .btn -->
</body>
</html>