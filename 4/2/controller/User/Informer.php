<?php
$user = new User('user');

$userInfo = $user->getUser();

echo render('user_informer', array('user'=>$userInfo));