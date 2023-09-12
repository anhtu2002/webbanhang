<?php
session_start();
require_once './utils/utility.php';
require_once './database/dbhelper.php';
if (!empty($_POST)) {
    $userId = $_SESSION['user']['id'];
    $id = getPost('id');
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $product = executeResult($sql, true);
    if ($product['seller_id'] != $userId) {
        echo "<script>
        window.location.href = 'banhang.php';
        alert ('Không thể xóa sản phẩm của người khác') </script>";
        die();
    }

    $sql = "DELETE FROM products WHERE id = '$id'";
    execute($sql);
    header('Location: banhang.php');
}