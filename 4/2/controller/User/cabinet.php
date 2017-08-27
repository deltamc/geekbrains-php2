<?php
include CONTROLLER_DIR . 'cart/informer.php';
include CONTROLLER_DIR . 'user/informer.php';

$user = new User('user');

echo render('user_cabinet', array('isLogin'=>$user->isLogin()));