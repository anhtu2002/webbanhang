<?php
session_start();
require_once './utils/utility.php';
require_once './database/dbhelper.php';

$user = validateToken();
if ($user != null) {
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    die();
}

$email = $password = '';

$email = getPost('email');
$password = getPost('password');

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$data = executeResult($sql);

if ($data != null && count($data) > 0) {
    // setcookie('login', 'true', time() + 24*60*60, "/");

    $token = getPwdSecurity(time() . $data[0]['id']);
    setcookie('token', $token, time() + 24 * 60 * 60, '/');
    $sql = "UPDATE users SET token = '$token' WHERE id = " . $data[0]['id'];
    execute($sql);
    echo 'success';
    die();
} else {
    echo 'Tài khoản hoặc mật khẩu không chính xác;';
}
