<?php
header("content-type: text/html; charset=UTF-8");

require_once '../config/main.php';
require_once ENGINE_DIR . 'render.php';
require_once ENGINE_DIR . 'db.php';

require_once '../config/router.php';

require_once MODEL_DIR.'cart/cart.php';
require_once MODEL_DIR.'user/user.php';

session_start();

$page = '';

if (isset($_GET['page']) && $_GET['page']) {
    $page = preg_replace('/[^a-z]/i', '', $_GET['page']);
    $page = getRoute($page);
    if (!$page) {
        $page = getRoute( 'products');
    }
} else {
    $page = getRoute( 'products');
}

if ($page && file_exists($page)) {
    include $page;
} else {
    header('Location: /');
}