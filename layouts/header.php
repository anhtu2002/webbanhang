<?php
if (isLogin() == true) {
    global $userId;
    $userId = $_SESSION['user']['id'];

    $sql = "SELECT *  FROM cart WHERE user_id = $userId ";
    $result = executeResult($sql);
    $num = 0;
    if (sizeof($result) > 0) {

        $num = sizeof($result);
    }
}
if (isLogin() == false) {
    $num = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="./assets/js/script.js"></script>
    <link rel="stylesheet" href="./assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>
    <div class="shopi">
        <div class="flex-wrapper">
            <header class="header">
                <div class="grid">
                    <nav class="navbar">
                        <a href="./banhang.php">
                            <i class="fa-solid fa-bars nav--menu"></i>
                        </a>
                        <ul class="navbar-list">
                            <li class="navbar-item navbar-item--separate">
                                <a href="index.php" class="navbar-item-link">Trang chủ</a>
                            </li>
                            <li class="navbar-item navbar-item--separate">
                                <a href="<?php if (isLogin() == true) {
                                                echo 'banhang.php';
                                            } else {
                                                echo '#';
                                            } ?>" class="navbar-item-link js-sell" onclick="sellPage()">Bán hàng</a>
                            </li>
                            <li class="navbar-item navbar-item--separate">
                                <a href="" class="navbar-item-link">Tải ứng dụng</a>
                            </li>

                            <li class="navbar-item">
                                <div>
                                    <span class="no-pointer">Kết nối</span>
                                    <a href="https://www.facebook.com/duy.khuat.79" target="_blank" class="navbar-item-link">
                                        <i class="fab fa-facebook"></i></a>
                                    <a href="https://www.instagram.com/duy.khuat.79/" target="_blank" class="navbar-item-link">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-list">
                            <list class="navbar-item">
                                <a href="notification.php" class="navbar-item-link">
                                    <i class="fa-regular fa-bell"></i>
                                    Thông báo
                                </a>
                            </list>
                            <list class="navbar-item">
                                <a href="https://www.facebook.com/messages/t/100025087453710" target="_blank" class="navbar-item-link">
                                    <i class="fa-regular fa-circle-question"></i>
                                    Hỗ trợ
                                </a>
                            </list>
                            <list class="navbar-item navbar-item--separate navbar--need
                        <?php if (isLogin() == true) {
                            echo 'hide';
                        } ?>">

                            </list>
                            <list class="navbar-item navbar--need">
                                <a href="login.php">
                                    <div class="navbar-item-link navbar-item--strong js-login
                            <?php if (isLogin() == true) {
                                echo 'hide';
                            } ?>">
                                        Đăng nhập
                                    </div>
                                </a>
                            </list>
                            <list class="user-icon js-user-icon navbar--need" style="<?php if (
                                                                                            isLogin() == true
                                                                                        ) {
                                                                                            echo 'display: inline';
                                                                                        } else {
                                                                                            echo 'display: none';
                                                                                        } ?>">
                                <i class="fa-solid fa-user" onclick="showUser()"></i>
                                <div class="user-info js-user-info hide">
                                    <ul class="user-info__list js-user-info">
                                        <li class="user-info__list-item" onclick="window.location.href='user.php'">Xem
                                            thông tin</li>
                                        <li class="user-info__list-item" onclick="window.location.href='change_pass.php'">Đổi mật khẩu</li>
                                        <li class="user-info__list-item"><a href="logout.php" style="text-decoration: none; color: #000;">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </list>

                            <list class="navbar-item">
                                <div class="navbar-item-link navbar-item--strong navbar--need" "
                            <?php if (isLogin() == true) {
                                echo 'display: inline;';
                            } else {
                                echo 'display: none;';
                            } ?>">
                                    <a class="logout" href="logout.php">Đăng xuất</a>
                                </div>
                            </list>
                        </ul>
                    </nav>
                    <div class="header-width-search">
                        <a href="index.php" class="header__logo">
                            <img src="./assets/img/logo.jpg" alt="" class="header--logo__image">
                        </a>

                        <div class="header__search">
                            <form action="index.php" class="header__search-form">
                                <input type="text" class="header__search-input" name="search" placeholder="Nhập để tìm kiếm">
                                <button type="submit" class="btn btn-search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                        <div class="header__cart">
                            <a href="cart.php">
                                <i class="fa-solid fa-cart-shopping">
                                    <?php if ($num != 0) {
                                        echo '<p class="num__product">' . $num . '</p>';
                                    } ?>
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
            </header>