<?php
require_once MODEL_DIR.'products/product.php';


$cart = new Cart('cart');

$id = (int) $_GET['id'];

$product = getProductById($id);

if(empty($product)) {
    render('404');
    exit;
}


$img = 'img/notphoto.jpeg';
if (isset($product['images'][0]['image'])) {
    $img = 'upload/tumb/'.$product['images'][0]['image'];
}

$cart->addOrUpdate($id, $product['name'], 1, $product['price'], $img);

header("Location: /?page=product&id=" . $id);


