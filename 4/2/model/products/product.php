<?php



/**
 * массив с товарами
 * @return array
 */
function getProducts($start = 0, $show =15) {
    $start = (int) $start;
    $show   = (int) $show;

    $sql = "SELECT *, `products`.`id` as `pid`
            FROM products
              LEFT JOIN images ON `product_id` = `products`.`id` AND `preview` =1 LIMIT {$start}, {$show}";
    return getAssocResultAll($sql);
}

function getProductById($id) {
    $id = (int) $id;
    $out = array();

    $sql = "SELECT * FROM `products` WHERE id='{$id}'";
    $product = getAssocResultAll($sql);

    if(empty($product)) return array();

    $out = array(
        'id'                => $product[0]['id'],
        'name'              => $product[0]['name'],
        'price'             => $product[0]['price'],
        'short_description' => $product[0]['short_description'],
        'description'       => $product[0]['description'],
    );

    $sql = "SELECT * FROM `images` WHERE `product_id`='{$id}' ORDER BY `preview` DESC";
    $images = getAssocResultAll($sql);

    $out['images'] = $images;

    return $out;
}

function saveComment($comment, $productId) {

    $productId = (int) $productId;
    $comment = escapeString(trim($comment));
    $comment = htmlspecialchars($comment);
    $sql = "INSERT INTO `comments` (`text`, `product_id`) VALUES ('{$comment}', '{$productId}');";
    executeQuery($sql);
}

function getComments($productId) {
    $productId = (int) $productId;
    $sql = "SELECT * FROM `comments` WHERE product_id={$productId}";
    return getAssocResultAll($sql);
}

function numberOfProducts() {
    $sql = "SELECT count(*) as `count` FROM `products`";
    $result = getAssocResultOne($sql);

    return $result['count'];
}