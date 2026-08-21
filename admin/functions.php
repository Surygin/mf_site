<?php 

#проверка на совпадение по двум полям в таблице пользователей
function autorization_user($email, $psw){
  global $pdo;
  $sql = $pdo->query("SELECT * FROM `users` WHERE `email` = '$email' AND `psw` = '$psw' ")->fetchAll(PDO::FETCH_ASSOC);
  return $sql[0]['id'];
};