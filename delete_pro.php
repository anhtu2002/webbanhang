<?php
require_once './utils/utility.php';
require_once './database/dbhelper.php';
header('Location: banhang.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM order_details WHERE product_id = $id";
    execute($sql1);
    $sql = "DELETE FROM products WHERE id = $id";
    execute($sql);
}