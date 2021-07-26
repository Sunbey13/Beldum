<?php
session_start();
if (!$_SESSION['user']){
  header('location: index.php');
}
include 'db_connect.php';
error_reporting(E_ERROR);
if(isset($_POST['addAvto']))
{
    $Mark = $_POST['Mark'];
    $Model = $_POST['Model'];
    $Weight_gruz = $_POST['Weight_gruz'];
    $number = $_POST['number'];
    $Height = $_POST['Height'];
    $Width = $_POST['Width'];
    $Type = $_POST['Type'];
    $Voditel_id = $_POST['Voditel_id'];
   if(!$connect){
      echo ('unable to connect to database');
   }
   else {
   if ($Weight_gruz > 0 and $Width > 0 and $Height >0){
      if($Width < 25 and $Height < 25){
         if($Weight_gruz < 450000){
            $sql = "INSERT INTO avto(`id`, `Mark`, `Model`, `Weight_gruz`, `Reg_number`, `Height`, `Width`, `Type`, `Voditel_id`) VALUES(NULL, '$Mark', '$Model', '$Weight_gruz', '$number', '$Height', '$Width', '$Type', '$Voditel_id')";
            $result = mysqli_query($connect,$sql);
            mysqli_close($connect);
            header('Location: avto.php');
            } else {
               $_SESSION['avto_weight_max'] = 'Грузоподъемность не может быть больше 450 000кг';
               header('Location: avto.php');
            }
      } else {
         $_SESSION['avto_width'] = 'Высота и ширина кузова не могут быть больше 25м';
         header('Location: avto.php');
      }
   } else {
      $_SESSION['avto_weight'] = 'Грузоподъемность, ширина, высота авто не могут быть меньше или равны нулю';
      header('Location: avto.php');
   }
   }
}
?>