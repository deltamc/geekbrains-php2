<?php

if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', realpath(__DIR__ . '/../'));
}

if (!defined('PUBLIC_DIR')) {
    define('PUBLIC_DIR', ROOT_DIR . '/public/');
}

if (!defined('ENGINE_DIR')) {
    define('ENGINE_DIR', ROOT_DIR . '/engine/');
}

if (!defined('CONFIG_DIR')) {
    define('CONFIG_DIR', ROOT_DIR . '/config/');
}

if (!defined('UPLOAD_DIR')) {
    define('UPLOAD_DIR', PUBLIC_DIR . '/upload/');
}

if (!defined('TUMB_DIR')) {
    define('TUMB_DIR', PUBLIC_DIR . '/upload/tumb/');
}

if (!defined('TEMPLATES_DIR')) {
    define('TEMPLATES_DIR', ROOT_DIR . '/templates/');
}


define('CONTROLLER_DIR', ROOT_DIR . '/controller/');
define('MODEL_DIR', ROOT_DIR . '/model/');

define('SHOW_PRODUCT_ON_PAGE', 15);

// DB connection param
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'geekshop');

