<?php

    session_start();

    include ('db-connect.php');
    include ('functions.php');
    include ('tools/tools.php');
    
    $login = $_POST['login'];
    $psw   = $_POST['psw'];
    
    //var_dump($_POST);
    
    if(autorization_user($login, $psw)){
        $_SESSION['user_id'] = $login;
        header('Location: index.php');
    }
    
    header('Location: index.php');