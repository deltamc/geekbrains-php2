<?php

require_once MODEL_DIR.'products/product.php';

include CONTROLLER_DIR . 'cart/informer.php';
include CONTROLLER_DIR . 'user/informer.php';

$products = getProducts(0, SHOW_PRODUCT_ON_PAGE);

$productsContent =  render('productsList', array('products' => $products));
echo  render('productsWrap', array('products' => $productsContent));


echo render('nextButton');






