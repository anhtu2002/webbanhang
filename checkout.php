<?php
session_start();
require_once './utils/utility.php';
require_once './database/dbhelper.php';

$userId = getSession('user')['id'];

if (isset($_GET['buy'])) {
    $buy = $_GET['buy'];

    $sql = "SELECT * FROM products WHERE id = '$buy'";
    $product = executeResult($sql);
    foreach ($product as $pro);


    $num = 1;
    $price = $pro['price'];

    $sql1 = "INSERT INTO order_details(order_id, product_id, num, price)
                VALUES ('$userId', '$buy', '$num', '$price')";
    execute($sql1);


    echo '<script>alert("Đặt hàng thành công")
    window.location.href = "notification.php";</script>';
}
