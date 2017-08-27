<?php
require_once MODEL_DIR.'user/user.php';

$user = new User('user');

if($user->isLogin()){
    header("Location: /?page=userCabinet");
    exit;
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $result = $user->login($login, $password);

    if ($result){
        header("Location: /?page=userCabinet");
        exit;
    }
    $message = 'Неверный пароль или логин';
}


echo render('login', array('message'=>$message));