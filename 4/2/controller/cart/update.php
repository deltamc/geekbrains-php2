<?php
$cart = new Cart('cart');

if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['quantity'])
    && is_array($_POST['quantity'])) {

    foreach ($_POST['quantity'] as $productId => $quantity) {
        $productId = (int) $productId;
        $quantity  = (int) $quantity;

        //если ноль удаляем
        if ($quantity <= 0) {
            $cart->delete($productId);
        } else {
            $cart->updateQuantity($productId, $quantity);
        }
    }

}


header("Location: /?page=cart");


