<?php
session_start();
require_once('../utils/utility.php');
if (!isLogin()) {
    die();
}
$id = "";
if (!empty($_POST)) {
    require_once('../utils/utility.php');
    require_once('../database/dbhelper.php');
    $action = getPost('action');
    $id = getPost('id');
    switch ($action) {
        case 'add':
            addToCart($id);
            break;
        case 'delete':
            deleteItem($id);
            break;
        case 'buy':
            buyNow($id);
    }
}

function buyNow($id)
{
    $user = getSession('user');
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $product = executeResult($sql, true);
    if ($product['seller_id'] == $user['id']) {
        echo "Không thể mua sản phẩm do chính mình bán";
        return;
    }
}

function addToCart($id)
{

    $token = getCookie('token');
    $sql = "SELECT * FROM users WHERE token = '$token'";
    $user = executeResult($sql, true);

    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }

    $isFind = false;
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            $cart[$i]['num']++;
            $isFind = true;
            break;
        }
    }
    if ($isFind == false) {
        $sql = "SELECT * FROM products WHERE id = '$id'";
        $product = executeResult($sql, true);
        if ($product['seller_id'] == $user['id']) {
            echo "Không thể mua sản phẩm do chính mình bán";
            return;
        }
        $product['num'] = 1;
        $cart[] = $product;
    }
    $_SESSION['cart'] = $cart;
}

function deleteItem($id)
{
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            array_splice($cart, $i, 1);
            break;
        }
    }
    $_SESSION['cart'] = $cart;
}
