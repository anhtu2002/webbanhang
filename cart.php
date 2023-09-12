<?php
session_start();
$title = 'Giỏ hàng';
require_once './utils/utility.php';
require_once './database/dbhelper.php';
if (isLogin() == false) {
    echo "<script>alert('Vui lòng đăng nhập')</script>";
    header('Location: main.php');
    die();
}
include_once 'layouts/header.php';

?>

<div class="container">
    <div class="grid">
        <div class="grid__row">
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
                            <th width="60px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $total = 0;
                        $userId = $_SESSION['user']['id'];
                        $sql = "SELECT pr.id, pr.image, pr.name,pr.price, cart.num, cart.id_cart
                        FROM products AS pr
                        INNER JOIN cart ON pr.id = cart.product_id
                        WHERE cart.user_id = '$userId' 
                        ";
                        $sell_notifications = executeResult($sql);
                        if (count($sell_notifications) < 1) {
                            echo '<h1>Bạn chưa lựa chọn sản phẩm nào</h1>';
                        } else {

                            foreach ($sell_notifications as $item) {
                                $total += $item['num'] * $item['price'];

                                echo '
                            <tr>
                            <td>' .
                                    $count++ .
                                    '</td>
                            <td>
                            <a class="product-item" href="sanpham.php?id=' .
                                    $item['id'] .
                                    '"><img height = "100" width = "auto" src = "' .
                                    $item['image'] .
                                    '"></a>
                            </td>
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
                            <td> <a href="delete_cart.php?id=' .
                                    $item['id_cart'] .
                                    '"><button class="btn btn-danger" h>
                                        Delete</button></a>
                            </td>
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
<?php
// var_dump($item);
?>

<script type="text/javascript">
function deleteItem(id) {
    option = confirm('Bạn muốn xóa sản phẩm này?')
    if (!option) {
        return;
    }
    $.post('delete_cart.php', {
        'id': id
    }, function(data) {
        location.reload();
    })

}
</script>


<?php include_once 'layouts/footer.php'; ?>