<?php

/** Список маршрутов
 * @return array
 */
function getRoutes() {

    $routes =  array(
        'product' => CONTROLLER_DIR . 'products/product.php',
        'products' => CONTROLLER_DIR . 'products/list.php',
        'productsNextShow' => CONTROLLER_DIR . 'products/products_next_show.php',
        'addcart' => CONTROLLER_DIR . 'cart/add.php',
        'cart' => CONTROLLER_DIR . 'cart/cart.php',
        'cartClear' => CONTROLLER_DIR . 'cart/clear.php',
        'cartUpdate' => CONTROLLER_DIR . 'cart/update.php',
        'deleteProductInCart' => CONTROLLER_DIR . 'cart/delete_product.php',
        'userLog' => CONTROLLER_DIR . 'user/log.php',
        'userLogOut' => CONTROLLER_DIR . 'user/out.php',
        'userCabinet' => CONTROLLER_DIR . 'user/cabinet.php',

    );

    return $routes;
}

/**
 * Получить маршрут
 * @param $aliasName
 * @return bool|mixed
 */
function getRoute($aliasName) {
    if (array_key_exists($aliasName, getRoutes())) {
        $r = getRoutes();
        return $r[$aliasName];
    }

    return false;
}



