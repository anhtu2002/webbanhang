<?php
require_once './utils/utility.php';
require_once './database/dbhelper.php';

$user = validateToken();
if ($user != null) {
    header('Location: index.php');
    die();
}

$email = $password = $confirmationPassword = '';
$name = getPost('name');
$email = getPost('email');
$password = getPost('password');
$phone = getPost('phone');
$adress = getPost('adress');
$confirmationPassword = getPost('confirmation_password');

$sql = "SELECT * FROM users WHERE email = '$email'";
$data = executeResult($sql);

if ($data == null && count((array)$data) == 0) {
    $sql =
        "INSERT INTO users(email, password)
        VALUE ('" .
        $email .
        "','" .
        $password .
        "')";
    execute($sql);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $data = executeResult($sql);
    foreach ($data as $dt);
    $user_id = $dt['id'];


    $sql1 = "INSERT INTO user_inf(user_id,user_name,user_phone,user_adress)
                   VALUE ('$user_id','$name','$phone','$adress')";
    execute($sql1);
    echo "<script>
        window.location.href = 'index.php';
        alert('Chúc mừng bạn đã đăng ký thành công');
        </script>";
} else {
    echo "<script>
        window.location.href = 'index.php';
        alert('Email đã được đăng ký');
        </script>";
}