<?php
session_start();
include './database/dbhelper.php';
include './utils/utility.php';

if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $sql = "UPDATE users SET token = '' WHERE token = '$token'";
    execute($sql);
}
setcookie('token', '', time() - 10, '/');
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
session_destroy();
