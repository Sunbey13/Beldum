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
    $id = $_GET['avto'];
    if($id){
    $sql = "SELECT * FROM `avto` WHERE `id` = '$id'";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($query);
    } else {echo "<h4>Параметр ID не был передан.</h4>"; die;}
?>
   <form action="saveAvto.php" method="POST">
            <input type="hidden" value="<?php echo $id ?>" name="id">
            <h4>Марка:</h4>
            <input class="form-control" type="text" placeholder="Введите марку авто" name="Mark" required value="<?php echo $row['Mark'] ?>">
            <h4>Модель:</h4>
            <input type="text" class="form-control" name="Model" placeholder="Введите модель авто" required value="<?php echo $row['Model'] ?>">
            <h4>Регистрационный номер:</h4>
            <input type="text" class="form-control" name="Reg_number" placeholder="Введите регистрационный номер" required value="<?php echo $row['Reg_number'] ?>">
            <h4>Тип кузова:</h4>
            <select class="form-control" name="Type" >
                <option value="<?php echo $row['Type'] ?>"><?php echo $row['Type'] ?></option>
                <option value="Седан">Седан</option>
                <option value="Хэтчбэк">Хэтчбэк</option>
                <option value="Лифтбэк">Лифтбэк</option>
                <option value="Универсал">Универсал</option>
                <option value="Фургон">Фургон</option>
                <option value="Купе">Купе</option>
                <option value="Лимузин">Лимузин</option>
                <option value="Хардтоп">Хардтоп</option>
                <option value="Кабриолет">Кабриолет</option>
                <option value="Родстер">Родстер</option>
                <option value="Пикап">Пикап</option>
                <option value="Ландо">Ландо</option>
            </select>
            <h4>Ширина кузова:</h4>
            <input type="text" class="form-control" name="Width" placeholder="Введите ширину кузова" required value="<?php echo $row['Width'] ?>">
            <h4>Высота кузова:</h4>
            <input type="text" class="form-control" name="Height" placeholder="Введите высоту" required value="<?php echo $row['Height'] ?>">
            <h4>Грузоподъемность:</h4>
            <input class="form-control" type="text" placeholder="Грузоподъемность, кг" name="Weight_gruz" required value="<?php echo $row['Weight_gruz'] ?>">
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
