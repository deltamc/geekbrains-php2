<?php
require_once 'config.php';
require_once CONTROLLER_DIR . '/Gallery.php';
require_once MODEL_DIR . '/Gallery.php';


require_once 'lib/Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' .
                        DB_HOST . ';charset=utf8', DB_USER, DB_PASSWORD);

} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}

$action     = '';

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'] . 'Action';
} else {
    $action = ACTION_DEFAULT . 'Action';
}

$loader = new Twig_Loader_Filesystem(VIEW_DIR);
$twig   = new Twig_Environment($loader);

$controllerObject = new GalleryController($dbh, $twig);

if (!method_exists($controllerObject, $action)) {
    die("Метод контроллера не найден");
}

try {
    $content = $controllerObject->$action($_REQUEST);

    $vars = array(
        'content' => $content,
    );
    echo $twig->render('base.tmpl', $vars);

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}