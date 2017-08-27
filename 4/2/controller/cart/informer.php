<?php
$cart = new Cart('cart');
$cartInformer = array(
    'quantity' => $cart->getQuantity(),
    'sum'      => $cart->getSum(),
);
echo render('cart_informer', array('cartInformer' => $cartInformer));