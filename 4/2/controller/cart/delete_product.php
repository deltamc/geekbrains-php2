<?php

$cart = new Cart('cart');

$id = (int) $_GET['id'];


$cart->delete($id);

header("Location: /?page=cart");


