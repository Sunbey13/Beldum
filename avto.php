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
  <title>Авто | BelDum</title>
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
  <?php
  if($_SESSION['avto_weight']){
          echo '<p class="form-info">'.$_SESSION['avto_weight'].'</p><br>';
        }unset($_SESSION['avto_weight']);

  if($_SESSION['avto_weight_max']){
          echo '<p class="form-info">'.$_SESSION['avto_weight_max'].'</p><br>';
        }unset($_SESSION['avto_weight_max']); 

  if($_SESSION['avto_width']){
          echo '<p class="form-info">'.$_SESSION['avto_width'].'</p><br>';
        }unset($_SESSION['avto_width']);
  ?>
  <h4 class="put-list">Доступные для перевозок авто</h4>
    <a href="#myModal-avto" class="btn btn-primary" data-toggle="modal">Добавить авто</a>
    <div id="myModal-avto" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Заголовок модального окна -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Добавить авто</h4>
          </div>
          <!-- Основное содержимое модального окна -->
          <form action="addAvto.php" method="POST">
          <div class="modal-body">
            <h4>Марка:</h4>
            <input class="form-control" type="text" placeholder="Введите марку авто" name="Mark" required>
            <h4>Модель:</h4>
            <input type="text" class="form-control" name="Model" placeholder="Введите модель авто" required>
            <h4>Регистрационный номер:</h4>
            <input type="text" class="form-control" name="number" placeholder="Введите регистрационный номер" required>
            <h4>Тип кузова:</h4>
            <select class="form-control" name="Type">
            <option value="Выберите тип кузова">Выберите тип кузова</option>
            <option value="Седан">Седан</option>
            <option value="Хэтчбэк">Хэтчбэк</option>
            <option value="Лифтбэк">Лифтбэк</option>
            <option value="Универсал">Универсал</option>
            <option value="Фургон">Фургон</option>
            <option value="Фургон">Тягач</option>
            <option value="Купе">Купе</option>
            <option value="Лимузин">Лимузин</option>
            <option value="Хардтоп">Хардтоп</option>
            <option value="Кабриолет">Кабриолет</option>
            <option value="Родстер">Родстер</option>
            <option value="Пикап">Пикап</option>
            <option value="Ландо">Ландо</option>
            </select>
            <h4>Ширина кузова:</h4>
            <input type="text" class="form-control" name="Width" placeholder="Введите ширину кузова, м" required>
            <h4>Высота кузова:</h4>
            <input type="text" class="form-control" name="Height" placeholder="Введите высоту кузова, м" required>
            <h4>Водитель:</h4>
            <select class="form-control" name="Voditel_id">
            <option value="Выберите водителя">Выберите водителя</option>
            <?php
              include 'db_connect.php';
              $sql = "SELECT `id`, `FIO` FROM `voditel` ORDER BY `FIO` ASC";
              $res = mysqli_query($connect, $sql);
              $row = mysqli_num_rows($res);
              while ($row = mysqli_fetch_array($res)){
                echo "<option value=\"".$row['id']."\">".$row['FIO']."</option>";
              }
            ?>
            </select>
            <h4>Грузоподъемность:</h4>
            <input class="form-control" type="text" placeholder="Грузоподъемность, кг" name="Weight_gruz" required>
          </div>
          <!-- Футер модального окна -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            <input type="submit" name="addAvto" value="Добавить" class="btn btn-primary">
          </div>
          </form>
        </div>
      </div>
    </div>
  <div class="org-table">
    <table class="table simple-table">
      <tr>
        <td class="table-head">Марка</td>
        <td class="table-head">Модель</td>
        <td class="table-head">Грузоподъемность</td>
        <td class="table-head">Регистрационный номер</td>
        <td class="table-head">Высота кузова</td>
        <td class="table-head">Ширина кузова</td>
        <td class="table-head">Тип кузова</td>
        <td class="table-head">Водитель</td>
        <td class="table-head non-print">Ред.</td>
        <td class="table-head non-print">Дел.</td>
      </tr>
      <?php
      $sql = "SELECT * FROM voditel join avto on voditel.id=avto.voditel_id";
      $res = mysqli_query($connect, $sql);
      $row = mysqli_num_rows($res);
      while ($row = mysqli_fetch_array($res)){
        echo "<tr>\n";
        echo "<td>".$row['Mark']."</td>\n";
        echo "<td>".$row['Model']."</td>\n";
        echo "<td>".$row['Weight_gruz'].", кг</td>\n";
        echo "<td>".$row['Reg_number']."</td>\n";
        echo "<td>".$row['Height'].", м</td>\n";
        echo "<td>".$row['Width'].", м</td>\n";
        echo "<td>".$row['Type']."</td>\n";
        echo "<td>".$row['FIO']."</td>\n";
        echo "<td><a class=\"red-link\" href=\"editAvto.php?avto=".$row['id']."\"><i class=\"fa fa-pencil\"></i></a></td>";
        echo "<td><a class=\"red-link\" href=\"delAvto.php?avto=".$row['id']."\"><i class=\"fa fa-trash\"></i></a></td>";
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
