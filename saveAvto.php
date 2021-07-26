<?php
  session_start();
  if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
if(!empty($_POST['id'])){
    $id = $_POST['id'];
    $Mark = $_POST['Mark'];
    $Model = $_POST['Model'];
    $Reg_number = $_POST['Reg_number'];
    $Type = $_POST['Type'];
    $Width = $_POST['Width'];
    $Height = $_POST['Height'];
    $Weight_gruz = $_POST['Weight_gruz'];
    if($Weight_gruz > 0 and $Width > 0 and $Height >0){
      if($Width < 25 and $Height < 25){
          if($Weight_gruz < 450000){
              $sql = "UPDATE avto SET `Mark` = '$Mark', `Model` = '$Model', `Reg_number` = '$Reg_number', `Type` = '$Type', `Width` = '$Width', `Height` = '$Height', `Weight_gruz` = $Weight_gruz WHERE `id`='$id'";
               $query = mysqli_query($connect, $sql);
              header('Location: avto.php');
          } else {
            $_SESSION['avto_weight_max'] = 'Грузоподъемность не может быть больше 450 000кг';
            header('Location: avto.php');
          }
      } else{
        $_SESSION['avto_width'] = 'Высота и ширина кузова не могут быть больше 25м';
      header('Location: avto.php');
      }
    }else{
      $_SESSION['avto_weight'] = 'Грузоподъемность, ширина, высота авто не могут быть меньше или равны нулю';
      header('Location: avto.php');
    }
} else {
    echo "<h1>Ошибка сохранения данных</h1>";
}
?>