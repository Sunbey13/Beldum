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
  <title>Отчет | BelDum</title>
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
<h4 class="put-list">Обобщенный путевой лист</h4>
<table class="table simple-table">
<tr>
<td class="table-head">№</td>
<td class="table-head">Дата</td>
<td class="table-head">Водитель</td>
<td class="table-head">Организация</td>
<td class="table-head">Адрес</td>
<td class="table-head">Тип перевозки</td>
<td class="table-head">Товар</td>
<td class="table-head">Вес</td>
<td class="table-head">Тип перевозки</td>
<td class="table-head">Товар</td>
<td class="table-head">Вес</td>
<td class="table-head"></td>
</tr>
<?php
$sql = "SELECT `reis`.`id`, `reis`.`Date`, `voditel`.`FIO`, `organ_adres`.`Address`, `organ`.`Name_org` FROM voditel 
        JOIN reis ON `reis`.`voditel_id`=`voditel`.`id` 
        JOIN organ_adres ON `reis`.`Sector_id` = `organ_adres`.`id`
        JOIN organ ON `organ_adres`.`Organ_id` = `organ`.`id`
        WHERE `Del` = 1";
$query = mysqli_query($connect, $sql);
$row = mysqli_num_rows($query);
while ($row = mysqli_fetch_array($query)){
  $reis_id = $row['id'];
  echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['Date']."</td>";
    echo "<td>".$row['FIO']."</td>";
    echo "<td>".$row['Name_org']."</td>";
    echo "<td>".$row['Address']."</td>";
    $sql_1 = "SELECT `Tovar_name`, `Weight`, `dostOtpr` FROM dost_otpr JOIN tovar ON `dost_otpr`.`tovar_id`=`tovar`.`id` WHERE reis_id = '$reis_id'";
    $query_1 = mysqli_query($connect, $sql_1);
    $row_1 = mysqli_num_rows($query_1);
    while($row_1 = mysqli_fetch_array($query_1)){
      $reis_type = $row_1['dostOtpr'];
      if($reis_type == 1){
        echo "<td>Привезти</td>";
      } else {
        echo "<td>Отвезти</td>";
      }
      echo "<td>".$row_1['Tovar_name']."</td>";
      echo "<td>".$row_1['Weight'].", Кг</td>";
    }
  echo "<td><a class=\"archive-link\" href=\"reisInHistory.php?reis=".$row['id']."\"><i class=\"fa fa-archive\"></i></a></td>";
  echo "</tr>";
}
?>
<table>
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
    <script>
      $(function(){
          $('[data-toggle="tooltip"]').tooltip();
          $('[data-toggle="popover"]').popover();
      });
    </script>
  </body>
</html>
