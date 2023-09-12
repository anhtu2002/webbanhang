<?php
require_once './utils/utility.php';
require_once './database/dbhelper.php';
header('Location: cart.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM cart WHERE id_cart = $id";
    execute($sql);
}
