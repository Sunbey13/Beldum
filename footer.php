<?php
session_start();
if (!$_SESSION['user']){
  header('location: index.php');
}
?>
<footer id="footer">
  <div class="row">
          <div class="col-xs-8">
              <ul class="list-unstyled list-inline pull-left">
                  <li><a href="mailto:dmitriybelousov33@gmail.com" target="_blank"><i class="fa fa-question"></i> Связь с поддержкой</a></li> 
                  <li><a href="#myModal-chp" data-toggle="modal"><i class="fa fa-key"></i> Сменить пароль</a></li> 
              </ul>
          </div>
          <div class="col-xs-4">
              <p class="text-muted pull-right"> © Дмитрий Белоусов - 2020 </p>
          </div>
      </div>
    <div id="myModal-chp" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Заголовок модального окна -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Сменить пароль</h4>
          </div>
          <!-- Основное содержимое модального окна -->
          <form action="changepass.php" method="POST">
          <div class="modal-body">
            <h4>Старый пароль:</h4>
            <input class="form-control" type="password" id="old" placeholder="Введите старый пароль" name="old_password" required>
            <label><input type="checkbox" class="password-old-checkbox"> Показать старый пароль</label>
            <h4>Новый пароль:</h4>
            <input type="password" class="form-control" id="new-1" name="fnew_password" placeholder="Введите новый пароль" required>
            <br>
            <input type="password" class="form-control" id="new-2" name="snew_password" placeholder="Повторите пароль" required>
            <label><input type="checkbox" class="password-new-checkbox"> Показать новый пароль</label>
          </div2
          <!-- Футер модального окна -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            <input type="submit" name="change_pass" value="Сменить" class="btn btn-primary">
          </div>
          </form>
        </div>
      </div>
    </div>
</footer>
