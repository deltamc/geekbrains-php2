<?php
require_once MODEL_DIR.'user/user.php';

$user = new User('user');

$user->logOut();
header("Location: /");