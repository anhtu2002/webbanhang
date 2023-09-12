<?php

// include './database/dbhelper.php';

function isLogin()
{
    if (validateToken() != null) {
        return true;
    }
    return false;
}

function validateToken()
{
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }

    $token = '';
    if (isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $sql = "SELECT * FROM users WHERE token = '$token'";
        $data = executeResult($sql);
        if ($data != null && count($data) > 0) {
            $_SESSION['user'] = $data[0];
            return $data[0];
        }
    }
    return null;
}
function fixSqlInjection($str)
{
    $str = str_replace('\'', '\\\'', $str);
    return $str;
}

function getGet($key)
{
    $value = '';
    if (isset($_GET[$key])) {
        $value = fixSqlInjection($_GET[$key]);
    }
    return $value;
}
function getPost($key)
{
    $value = '';
    if (isset($_POST[$key])) {
        $value = fixSqlInjection($_POST[$key]);
    }
    return $value;
}

function getCookie($key)
{
    $value = '';
    if (isset($_COOKIE[$key])) {
        $value = $_COOKIE[$key];
    }
    return $value;
}

function getSession($key)
{
    $value = '';
    if (isset($_SESSION[$key])) {
        $value = $_SESSION[$key];
    }
    return $value;
}

function getPwdSecurity($pwd)
{
    return md5(md5($pwd) . MD5_PRIVATE_KEY);
}
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ', $char = '.')
    {
        if (!empty($number)) {
            return number_format($number, 0, ',', $char) . "{$suffix}";
        }
    }
}
function stripVN($str)
{
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);

    $str = preg_replace('/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $str);
    $str = preg_replace('/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/', 'E', $str);
    $str = preg_replace('/(Ì|Í|Ị|Ỉ|Ĩ)/', 'I', $str);
    $str = preg_replace('/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/', 'O', $str);
    $str = preg_replace('/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/', 'U', $str);
    $str = preg_replace('/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/', 'Y', $str);
    $str = preg_replace('/(Đ)/', 'D', $str);
    return $str;
}
