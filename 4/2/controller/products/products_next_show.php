<?php
require_once MODEL_DIR.'products/product.php';

$start = (int) $_GET['start'];

$products = getProducts($start, SHOW_PRODUCT_ON_PAGE);

$last = false;
$count = numberOfProducts();
if ($start + SHOW_PRODUCT_ON_PAGE >= $count) {
    $last = true;
}

$out  = array(
    'content' => render('productsList', array('products' => $products)),
    'last'    => $last
);
echo json_encode($out);
exit();