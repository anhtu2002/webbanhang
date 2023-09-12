<?php
session_start();
$title = 'Đặt hàng';
require_once './utils/utility.php';
require_once './database/dbhelper.php';
if (isLogin() == false) {
    header('Location: index.php');
    die();
}
$userId = getSession('user')['id'];
include_once 'layouts/header.php';
$cart = [];
if (!empty($_GET)) {
    $cart = [];
    $buy = getGet('buy');
    $sql = "SELECT * FROM products WHERE id = '$buy'";
    $product = executeResult($sql, true);
    if ($product == null || count($product) == 0) {
        echo "<script>
        window.location.href = 'index.php';
        alert('Sản phẩm không tồn tại!');
        </script>";
        die();
    }
    $product['num'] = 1;
    $cart[] = $product;
} else {
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    if ($cart == null || count($cart) == 0) {
        header('Location: index.php');
        die();
    }
}
if (!empty($_POST)) {
    $full_name = getPost('full_name');
    $phone_number = getPost('phone_number');
    $email = getSession('user')['email'];
    $address = getPost('address');
    $order_date = date('Y-m-d H:i:s');


    $sql = "INSERT INTO orders (full_name, phone_number, email, address, order_date, customer_id)
            values ('$full_name', '$phone_number', '$email', '$address', '$order_date', '$userId')";
    execute($sql);

    $sql = "SELECT * FROM orders WHERE order_date = '$order_date'";
    $order = executeResult($sql, true);
    $order_id = $order['id'];

    foreach ($cart as $item) {
        $product_id = $item['id'];
        $num = $item['num'];
        $price = $item['price'];

        $sql = "INSERT INTO order_details(order_id, product_id, num, price)
                VALUES ('$order_id', '$product_id', '$num', '$price')";
        execute($sql);
    }
    unset($_SESSION['cart']);
    echo "<script>
    window.location.href = 'index.php';
    alert('Chúc mừng bạn đã đặt hàng thành công');
    </script>";
}
?>

<div class="container">
    <div class="grid">
        <div class="grid__row">
            <div class="checkout-form" id="new_adress" hidden>
                <form id="" action="" method=" POST">
                    <h4 class="input-name">Họ và tên:</h4>
                    <input required="true" type="text" name="full_name" class="form-checkout"
                        placeholder="Không quá 150 ký tự">
                    <h4 class="input-name">Số điện thoại:</h4>
                    <input required="true" type="text" maxlength="11" name="phone_number" class="form-checkout"
                        placeholder="">
                    <h4 class="input-name">Địa chỉ:</h4>
                    <input required="true" type="text" name="address" class="form-checkout" placeholder="">
                    <div>
                        <button type="submit" class="btn add-btn hoanthanh-btn" style="margin-left: 0; 
                            background-color: var(--primary-color); min-width: 300px; margin: 1.5rem 0; ">Đặt
                            hàng</button>

                        <h3 id="bt_old" onclick="show()" style="padding: 10px; margin-bottom: 10px">Địa chỉ đã
                            có
                        </h3>
                    </div>
                </form>
            </div>
            <div class="checkout-form" id="old_adress" hidden>
                <form id="" action="" method="POST">
                    <h4 class="input-name">Họ và tên:</h4>
                    <input disabled required="true" type="text" name="full_name" class="form-checkout"
                        placeholder="Không quá 150 ký tự">
                    <h4 class="input-name">Số điện thoại:</h4>
                    <input disabled required="true" type="text" maxlength="11" name="phone_number" class="form-checkout"
                        placeholder="">
                    <h4 class="input-name">Địa chỉ:</h4>
                    <input disabled required="true" type="text" name="address" class="form-checkout" placeholder="">
                    <div>
                        <button type="submit" class="btn add-btn hoanthanh-btn" style="margin-left: 0; 
                            background-color: var(--primary-color); min-width: 300px; margin: 1.5rem 0; ">Đặt
                            hàng</button>
                        <h3 id="bt_new" onclick="show()" style="padding: 10px; margin-bottom: 10px">Thêm địa
                            chỉ
                        </h3>
                    </div>
                </form>
            </div>
            <div class="cart">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $cart = [];
                        // if(empty($_GET)) {
                        //     if(isset($_SESSION['cart'])) {
                        //         $cart = $_SESSION['cart'];
                        //     }
                        // }
                        $count = 1;
                        $total = 0;
                        if (count($cart) < 1) {
                            echo '<h1>Bạn chưa lựa chọn sản phẩm nào</h1>';
                        } else {
                            foreach ($cart as $item) {
                                $total += $item['num'] * $item['price'];
                                echo '
        <tr>
        <td>' .
                                    $count++ .
                                    '</td>
        <td><img height = "100" width = "auto" src = "' .
                                    $item['image'] .
                                    '"</td>
        <td>' .
                                    $item['name'] .
                                    '</td>
        <td>' .
                                    currency_format($item['price']) .
                                    '</td>
        <td>' .
                                    $item['num'] .
                                    '</td>
        <td>' .
                                    currency_format($item['num'] * $item['price']) .
                                    '</td>
    </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <h2 style="color: red;">Tổng: <?= currency_format(
                                                    $total
                                                ) ?></h2>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function deleteItem(id) {
    $.post('api/api-sanpham.php', {
        'action': 'delete',
        'id': id
    }, function(data) {
        // location.reload();
    })
}
var old_adress = document.getElementById("old_adress");
var new_adress = document.getElementById("new_adress");
var bt_new = document.getElementById("bt_new");
var bt_old = document.getElementById("bt_old");
new_adress.classList.add("open");

function show() {
    bt_new.addEventListener("click", function() {
        old_adress.classList.remove("open");
        new_adress.classList.add("open");
    });

    bt_old.addEventListener("click", function() {
        old_adress.classList.add("open");
        new_adress.classList.remove("open");
    });
}
</script>

<?php include_once 'layouts/footer.php'; ?>
<style>
h3:hover {
    cursor: pointer;
}

h3 {
    padding: 10px;
    background-color: aqua;
    text-align: center;
}
</style>