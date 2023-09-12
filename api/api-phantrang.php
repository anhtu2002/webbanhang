<?php
require_once '../database/dbhelper.php';
require_once '../utils/utility.php';

$page = getGet('page');
$limit = ($page - 1) * 12;
$sql = "SELECT * FROM products LIMIT $limit, 12 ";
// echo $sql;

$productList = executeResult($sql);
foreach ($productList as $product) {
    echo '<div class="grid__column-2">
            <a class="product-item" href="sanpham.php?id=' .
        $product['id'] .
        '">
            <div class="product-item__img" style="background-image: url(' .
        $product['image'] .
        ')"></div>
            <h4 class="product-item__name">' .
        $product['name'] .
        '</h4>
            <h5 class="product-item__price">' .
        currency_format($product['price']) .
        '</h5>
            </a>
            </div>';
}
