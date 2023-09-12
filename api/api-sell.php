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
        case 'accept':
            acceptSell($id);
            break;
        case 'refuse':
            refuseSell($id);
            break;
    }
}
function acceptSell($id)
{
    $sql = "UPDATE order_details SET status = 'accept'
            WHERE id = '$id'";
    execute($sql);
    echo "Đã chấp nhận bán";
}
function refuseSell($id)
{
    $sql = "UPDATE order_details SET status = 'refuse'
            WHERE id = '$id'";
    execute($sql);
    echo "Đã từ chối đơn hàng";
}
