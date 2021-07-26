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
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/26aceaceb0.js"></script>
  <title>Главная | Beldum</title>
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
        if($_SESSION['msg_copy']){
          echo '<p class="form-info">'.$_SESSION['msg_copy'].'</p><br>';
        }unset($_SESSION['msg_copy']);

        if($_SESSION['msg_succes']){
          echo '<p class="form-info-success">'.$_SESSION['msg_succes'].'</p><br>';
        }unset($_SESSION['msg_succes']);

        if($_SESSION['msgReis']){
          echo '<p class="form-info">'.$_SESSION['msgReis'].'</p><br>';
        }unset($_SESSION['msgReis']);

        if($_SESSION['nonChoise']){
          echo '<p class="form-info">'.$_SESSION['nonChoise'].'</p><br>';
        }unset($_SESSION['nonChoise']);

        if($_SESSION['nonInfoDost']){
          echo '<p class="form-info">'.$_SESSION['nonInfoDost'].'</p><br>';
        }unset($_SESSION['nonInfoDost']);

        if($_SESSION['nonInfoOtpr']){
          echo '<p class="form-info">'.$_SESSION['nonInfoOtpr'].'</p><br>';
        }unset($_SESSION['nonInfoOtpr']);

        if($_SESSION['weight_dost']){
          echo '<p class="form-info">'.$_SESSION['weight_dost'].'</p><br>';
        }unset($_SESSION['weight_dost']);

        if($_SESSION['weight_otpr']){
          echo '<p class="form-info">'.$_SESSION['weight_otpr'].'</p><br>';
        }unset($_SESSION['weight_otpr']);
      ?>
  <div>
    <div class="sec">
      <img src="image/map.jpg" alt="" class="img-responsive img-rounded example_beauty">
       <span class="sec_1">   
                    <?php $i = 0;
                    $sql = "SELECT Sector_id, Sector FROM reis JOIN organ_adres ON reis.sector_id = organ_adres.id WHERE Sector = 1 AND Del = 1";
                    $res = mysqli_query($connect, $sql);
                    $i = mysqli_num_rows($res);
                    echo $i;
                    ?>
        </span>
        <span class="sec_2">
                    <?php $i = 0;
                    $sql = "SELECT Sector_id, Sector FROM reis JOIN organ_adres ON reis.sector_id = organ_adres.id WHERE Sector = 2 AND Del = 1";
                    $res = mysqli_query($connect, $sql);
                    $i = mysqli_num_rows($res);
                    echo $i;
                    ?>     
        </span>
        <span class="sec_3">
                    <?php $i = 0;
                    $sql = "SELECT Sector_id, Sector FROM reis JOIN organ_adres ON reis.sector_id = organ_adres.id WHERE Sector = 3 AND Del = 1";
                    $res = mysqli_query($connect, $sql);
                    $i = mysqli_num_rows($res);
                    echo $i;
                    ?>
        </span>
        <span class="sec_4">
                    <?php $i = 0;
                    $sql = "SELECT Sector_id, Sector FROM reis JOIN organ_adres ON reis.sector_id = organ_adres.id WHERE Sector = 4 AND Del = 1";
                    $res = mysqli_query($connect, $sql);
                    $i = mysqli_num_rows($res);
                    echo $i;
                    ?>
        </span>
        <span class="sec_5">
                    <?php $i = 0;
                    $sql = "SELECT Sector_id, Sector FROM reis JOIN organ_adres ON reis.sector_id = organ_adres.id WHERE Sector = 5 AND Del = 1";
                    $res = mysqli_query($connect, $sql);
                    $i = mysqli_num_rows($res);
                    echo $i;
                    ?>
        </span> 
    </div>
  </div>
    <div class="row form_vvod">
      <form action="addReis.php" method="POST">
        <div class="col-md-4">
          <h4>Выберите дату:</h4>
            <input type="date" class="form-control" name="Date">
          <h4>Выберите огранизацию:</h4>
          <select id="List1" class="form-control" name="Organ">
          <option value="Выберите организацию">Выберите организацию</option>
          <?php
            include 'db_connect.php';
            $sql = "SELECT * FROM organ ORDER BY Name_org ASC";
            $res = mysqli_query($connect, $sql);
            $row = mysqli_num_rows($res);
            while ($row = mysqli_fetch_array($res)){
            echo "<option value=\"".$row['id']."\">".$row['Name_org']."</option>";
            }
          ?>
          </select>
          <h4>Выберите водителя:</h4>
          <select name="Voditel_id" class="form-control" required>
          <option value="Выберите водителя">Выберите водителя</option>
          <?php
            $sql = "SELECT `id`, `FIO` FROM `voditel` ORDER BY `FIO` ASC";
            $res = mysqli_query($connect, $sql);
            $row = mysqli_num_rows($res);
            while ($row = mysqli_fetch_array($res)){
              echo "<option value=\"".$row['id']."\">".$row['FIO']."</option>";
            }
          ?>
          </select>
          <div class="form-group">
             <h4>Примечания:</h4>
              <textarea class="form-control" rows="4" placeholder="Введите текст примечания" name="Prim"></textarea>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3">
          <label class="checkbox inline">
            <input type="hidden" value="NULL" name="Privezti">
            <input type="checkbox"  data-toggle="toggle" data-off="Привезти" data-on="<i class='fa fa-truck'></i>"  value="1" name="Privezti" data-size="mini">
          </label>
          <h4>Введите параметры товара для доставки:</h4>
            <input class="form-control" type="text" placeholder="Введите наименование товара" name="Name_tov_dost"><br>
            <input class="form-control" type="text" placeholder="Введите вес товара, кг" name="Weight_tov_dost">      
          <h4>Куратор:</h4>
            <input class="form-control" type="text" placeholder="ФИО" name="Kurator_dost"><br>
            <input class="form-control" type="text" placeholder="Номер телефона" name="Kurator_dost_tel">
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3">
          <label class="checkbox inline">
            <input type="hidden" value="NULL" name="Otvezti">
            <input type="checkbox" unchecked data-toggle="toggle" data-on="<i class='fa fa-truck'></i>" data-off="Отвезти" value="0" name="Otvezti" data-size="mini">
          </label>
          <h4>Введите параметры товара для отгрузки:</h4>
            <input class="form-control" type="text" placeholder="Введите наименование товара" name="Name_tov_otpr"><br>
            <input class="form-control" type="text" placeholder="Введите вес товара, кг" name="Weight_tov_otpr">
          <h4>Куратор:</h4>
              <input class="form-control" type="text" placeholder="ФИО" name="Kurator_otpr"><br>
              <input class="form-control" type="text" placeholder="Номер телефона" name="Kurator_otpr_tel">
              <div class="vvod-btn">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-del">Очистить</button>
                <input type="submit" class="btn btn-primary" value="Отправить">
              </div>
        </div>
      </form>
      <div class="modal fade" id="modal-del">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                    <div class="modal-header">
                          <button class="close" type="button" data-dismiss="modal"><i class="fa fa-close"></i></button>
                          <h4 class="modal-title">Подтвердите действие:</h4>
                    </div>
                    <div class="modal-body">
                      <p>Вы действительно хотите отправить все записи в историю?</p>
                    </div>
                    <div class="modal-footer">
                            <div class="row">
                                 <div class="col-md-8"></div>
                                 <div class="col-md-2">
                                  <form action="del.php">
                                  <input type="submit" name="del" value="Отправить" class="btn btn-danger">
                                  </form></div>
                                 <div class="col-md-2"><button class="btn btn-success" type="button" data-dismiss="modal">Отмена</button>
                                 </div>
                            </div>
                    </div>
            </div>
        </div>
      </div>
      </div><!-- form vvod -->
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
</body>
</html>
