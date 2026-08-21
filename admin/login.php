<?php 
    session_start();

    include ('db-connect.php');
    include ('functions.php');
    include ('tools/tools.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
  <div class="row">
    <div class="offset-lg-3 col-lg-6 col-12">
      <form action="autorizations.php" method="POST" class="form">
        <h3>Войти в систему</h3>
        <hr>
        <input type="email" class="form-control mb-3" name="login" placeholder="Введите ваш email">
        <input type="password" class="form-control mb-3" name="psw" placeholder="Введите ваш пароль">
        <button class="btn btn-success">Войти</button>
      </form>
    </div>
  </div>
</div>