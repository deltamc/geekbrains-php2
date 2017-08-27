<?php

$cart = new Cart('cart');
$cart->clear();

header("Location: /?page=cart");


