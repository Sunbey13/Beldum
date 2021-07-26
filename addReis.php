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
  <title>Подтвердить рейс | BelDum</title>
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
    $Date = $_POST['Date'];
    $Organ = $_POST['Organ'];
    $Voditel_id = $_POST['Voditel_id'];
    $Prim = $_POST['Prim'];
    $Privezti = $_POST['Privezti'];
    $Name_tov_dost = $_POST['Name_tov_dost'];
    $Weight_tov_dost = $_POST['Weight_tov_dost'];
    $Kurator_dost = $_POST['Kurator_dost'];
    $Kurator_dost_tel = $_POST['Kurator_dost_tel'];
    $Otvezti = $_POST['Otvezti'];
    $Name_tov_otpr = $_POST['Name_tov_otpr'];
    $Weight_tov_otpr = $_POST['Weight_tov_otpr'];
    $Kurator_otpr = $_POST['Kurator_otpr'];
    $Kurator_otpr_tel = $_POST['Kurator_otpr_tel'];
        $sql_org = "SELECT `id`, `Name_org` FROM organ WHERE `id` = '$Organ'";
        $query_org = mysqli_query($connect, $sql_org);
        $row_org = mysqli_fetch_array($query_org);
        $Org_id = $row_org['id'];
if ($Privezti != 'NULL' or $Otvezti != 'NULL'){
    if($Organ != "Выберите организацию" and $Voditel_id != "Выберите водителя"){
        echo "<div class=\"row form_vvod reis-info\">";//открываем див
            echo "<form action=\"saveReis.php\" method=\"POST\">";//открываем форму
                echo "<div class=\"col-md-4\">";
                    echo "<h4>Дата:</h4>";
                    echo "<input type=\"date\" class=\"form-control text-form\" name=\"Date\" value=\"".$Date."\">";
                    echo "<h4>Организация:</h4>";
                    echo "<select class=\"form-control text-form\" name=\"Organ\">";
                    echo "<option value=\"".$row_org['id']."\">".$row_org['Name_org']."</option>";
                    echo "</select>";
                    echo "<h4>Адрес:</h4>";
                    echo "<select class=\"form-control\" name=\"Sector\">";
                        $sql_address = "SELECT `id`, `Address` FROM organ_adres WHERE Organ_id = '$Org_id'";
                        $res_address = mysqli_query($connect, $sql_address);
                        $row_address = mysqli_num_rows($res_address);
                        while ($row_address = mysqli_fetch_array($res_address)){
                            echo "<option value=\"".$row_address['id']."\">".$row_address['Address']."</option>";
                        }
                    echo "</select>";
                    echo "<h4>Водитель:</h4>";
                    echo "<select name=\"Voditel_id\" class=\"form-control text-form\">";
                        $sql_vod = "SELECT `FIO` FROM voditel WHERE `id` = '$Voditel_id'";
                        $res_vod = mysqli_query($connect, $sql_vod);
                        $row_vod = mysqli_fetch_array($res_vod);
                    echo "<option value=\"".$Voditel_id."\">".$row_vod['FIO']."</option>";
                    echo "</select>";
                    echo "<div class=\"form-group\">";
                        if (!empty($Prim)){
                            echo "<h4>Примечания:</h4>";
                            echo "<textarea class=\"form-control text-form\" rows=\"4\" name=\"Prim\">".$Prim."</textarea>";
                        }
                    echo "</div>";//form-group
                echo "</div>";//col-md-3
                if($Privezti != 'NULL'){
                    if(!empty($Name_tov_dost) and !empty($Weight_tov_dost) and !empty($Kurator_dost)){
                      if($Weight_tov_dost > 0 and $Weight_tov_dost <=450000){
                        echo "<div class=\"col-md-4\">";
                        echo "<input type=\"hidden\" value=\"".$Privezti."\" name=\"Privezti\">";
                        echo "<h4>Товар доставки:</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Name_tov_dost\" value=\"".$Name_tov_dost."\">";
                        echo "<h4>Вес товара доставки (Кг):</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Weight_tov_dost\" value=\"".$Weight_tov_dost."\">";
                        echo "<h4>Куратор:</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Kurator_dost\" value=\"".$Kurator_dost."\">";
                        echo "<h4>Контактный телефон куратора:</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Kurator_dost_tel\" value=\"".$Kurator_dost_tel."\">";
                    echo "</div>";//col-md-4
                      }else{
                        $_SESSION['weight_dost'] = 'Вес товара доставки не может быть меньше 0 и больше 450 000кг';
                        header('Location: main.php');
                      }
                    } else {
                    $_SESSION['nonInfoDost'] = 'Недостаточно информации о товаре доставки';
                    header('Location: main.php');
                    }
                echo "<div class=\"col-md-1\"></div>";
                }
                if($Otvezti != 'NULL'){
                    if (!empty($Name_tov_otpr) and !empty($Weight_tov_otpr)){
                      if($Weight_tov_otpr > 0 and $Weight_tov_otpr <=450000){
                        echo "<div class=\"col-md-4\">";
                        echo "<input type=\"hidden\" value=\"".$Otvezti."\" name=\"Otvezti\">";
                        echo "<h4>Товар отправления:</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Name_tov_otpr\" value=\"".$Name_tov_otpr."\">";
                        echo "<h4>Вес товара отправления (Кг):</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Weight_tov_otpr\" value=\"".$Weight_tov_otpr."\">";
                        echo "<h4>Куратор:</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Kurator_otpr\" value=\"".$Kurator_otpr."\">";
                        echo "<h4>Контактный телефон куратора:</h4>";
                        echo "<input class=\"form-control text-form\" type=\"text\" name=\"Kurator_otpr_tel\" value=\"".$Kurator_otpr_tel."\">";
                    echo "</div>";//col-md-4
                      } else {
                        $_SESSION['weight_otpr'] = 'Вес товара отправления не может быть меньше 0 и больше 450 000кг';
                    header('Location: main.php');
                      }
                    } else {
                    $_SESSION['nonInfoOtpr'] = 'Недостаточно информации о товаре отправления';
                    header('Location: main.php');
                    }
                } 
                echo "</div>";
                echo "<div class=\"btns-add-reis\">";
                echo "<a href=\"main.php\" class=\"btn btn-danger\">Назад</a> ";
                echo "<input type=\"submit\" value=\"Подтвердить\" class=\"btn btn-primary\">";
                echo "</div>";
            echo "</form>";
    } else {
    $_SESSION['msgReis'] = 'Указанной информации не достаточно для формирования рейса';
    header('Location: main.php');
    }
} else {
    $_SESSION['nonChoise'] = 'Не выбран ни один из типов перевозок';
    header('Location: main.php');
}
?>
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
