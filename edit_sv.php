<?php
session_start();
require_once './utils/utility.php';
require_once './database/dbhelper.php';






$file_name = "ok";

var_dump(getPost("image"));
$id = getPost('id_pro');
$date = date('Y/m/d');
$productName = getPost('name');
$productDes = getPost('description');
$productImg = 'images/' . $file_name;
$productPrice = getPost('price');
$productPrice = str_ireplace([','], '', $productPrice);
$productPrice = (int) $productPrice;

if ($productName != null && $productPrice != null) {
    if ($productImg != null) {
        $sql = "UPDATE products SET 
        
        image = '$productImg' WHERE id = '$id'";
        execute($sql);
    }
    $sql = "UPDATE products SET 
        name = '$productName', price = '$productPrice', description = '$productDes',
        updated_date = '$date' WHERE id = '$id'";
    execute($sql);
    echo 'success';
    die();
}
$sql1 = "SELECT * FROM products WHERE id = '$id'";
$proinf = executeResult($sql1);
foreach ($proinf as $proInf)
    if ($productImg != $userInf['image'])
        move_uploaded_file($file_tmp, 'images/' . $file_name);
