<?php

require_once MODEL_DIR.'products/product.php';

include CONTROLLER_DIR . 'cart/informer.php';
include CONTROLLER_DIR . 'user/informer.php';

$id = (int) $_GET['id'];

$product = getProductById($id);

if(empty($product)) {
    render('404');
    exit;
}
echo render('product', $product);




if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['comment'])
    && trim($_POST['comment']) !== '') {


    saveComment($_POST['comment'], $id);
}

$comments = getComments($id);
echo render('comment', array('comments' => $comments));



//






