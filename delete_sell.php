<?php
require_once './utils/utility.php';
require_once './database/dbhelper.php';
header('Location: notification.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM order_details WHERE id = $id";
    execute($sql);
}