<?php


$cart = new Cart('cart');

echo render('cart', array('items'=>$cart->get(), 'sum'=> $cart->getSum()));