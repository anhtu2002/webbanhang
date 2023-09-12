<?php
$title = 'Thông báo';
require_once './database/dbhelper.php';
require_once './utils/utility.php';
if (!isLogin()) {
    header('Location: index.php');
    die();
}

include_once './layouts/header.php';

$user = getSession('user');
$user_id = $user['id'];
$user_email = $user['email'];

$sql = "SELECT od.id, uf.user_name, uf.user_phone, uf.user_adress,
        p.name as product_name, od.num, p.id as product_id
 FROM order_details AS od
    INNER JOIN products as p ON p.id = od.product_id
    INNER JOIN user_inf as uf ON uf.user_id = od.order_id
    WHERE p.seller_id = '$user_id' AND od.status is null
";
$sell_notifications = executeResult($sql);

$sql = "SELECT od.id, od.product_id, p.name as product_name, od.price, 
    od.num, p.image, od.status, uf.user_phone, uf.user_adress
    FROM order_details AS od
    INNER JOIN products as p ON p.id = od.product_id
    INNER JOIN user_inf as uf ON uf.user_id = od.order_id
    WHERE uf.user_id = '$user_id'
";
$buy_notifications = executeResult($sql);

$totalNotif = sizeof($sell_notifications) + sizeof($buy_notifications);
?>

<div class="container">
    <div class="grid">
        <div class="sell-notification">
            <h3 class="sell-notification-header" style="text-align: center; 
        margin: 0; color: white;
       height: 2.5rem; line-height: 2.5rem">Đơn hàng đang chờ</h3>
            <?php foreach ($sell_notifications as $notification) {
                $product_id = $notification['product_id'];
                $name = $notification['user_name'];
                echo '<div class="notification-item" id="id' . $notification['id'] . '">';
                echo "
            Người dùng <a href=''>$name</a> muốn mua $notification[num] 
            sản phẩm <a href='sanpham.php?id=$product_id'>$notification[product_name] </a> của bạn, Đồng ý bán?</br>
        ";
                echo '<button class="btn btn-success btn-access-sell" style="height: 2.5rem; 
        display: inline-block; background-color: green; width: 25%; margin-left: 0;"
        onclick="acceptSell(' .
                    $notification['id'] .
                    ')">
        Đồng ý
        </button> 
        <button class="btn btn-danger" style="display: inline-block; width: 25%;"
        onclick="refuseSell(' .
                    $notification['id'] .
                    ')">
        Từ chối
        </button></div>';
            } ?>
        </div>
        <div class="sell-notification buy-notification">
            <h3 class="sell-notification-header" style="text-align: center; 
        margin: 0; color: white; background-color: var(--primary-color);
       height: 2.5rem; line-height: 2.5rem">Đơn hàng đã đặt</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th style="width: 200px">Tên sản phẩm</th>
                        <th>Thông tin người nhận</th>
                        <th>Số lượng</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach ($buy_notifications as $bNotification) {
                        echo '
            <tr>
            <td>' .
                            $stt .
                            '</td>
            <td><img height="100" width="auto" src="' .
                            $bNotification['image'] .
                            '"</td>
            
            <td>' .
                            $bNotification['product_name'] .
                            '</td>
            <td>SĐT: 0' .
                            $bNotification['user_phone'] .
                            '<br>Địa chỉ: ' . $bNotification['user_adress'] . '</td>
            <td>' .
                            $bNotification['num'] .
                            '</td>
            <td>' .
                            currency_format($bNotification['price'] * $bNotification['num']) .
                            '</td>
        ';
                        if ($bNotification['status'] == null) {
                            echo '<td>Đang chờ</td>';
                        } elseif ($bNotification['status'] == 'accept') {
                            echo '<td>Đang vận chuyển</td>';
                        } elseif ($bNotification['status'] == 'refuse') {
                            echo '<td>Bị từ chối</td>';
                        }

                        echo '
            <td>
            <a onclick="return confirm_delete()"  href="delete_sell.php?id=' .
                            $bNotification['id'] .
                            ' "><button class="btn btn-danger">Hủy đơn hàng</button></a></td>';
                        $stt++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
</div>

<script type="text/javascript">
    function confirm_delete() {
        return confirm("Bạn muốn hủy đơn hàng này?")
    }

    function acceptSell(id) {
        if (confirm("Chấp nhận bán?") == true) {
            $.post("api/api-sell.php", {
                'action': 'accept',
                'id': id
            }, function(data) {
                alert(data);
            })
            let text = "#id" + id;
            $(text).remove();
            location.reload;
        } else {
            return;
        }
    }

    function refuseSell(id) {
        if (confirm("Bạn muốn từ chối đơn hàng này?") == true) {
            $.post("api/api-sell.php", {
                'action': 'refuse',
                'id': id
            }, function(data) {
                alert(data);
            })
            let text = "#id" + id;
            $(text).remove();
            location.reload();
        } else {
            return;
        }
    }
</script>
<?php

?>

<?php include_once './layouts/footer.php'; ?>

<style>
    .notification-item {
        padding: 12px 12px;
        padding-bottom: 0;
        background-color: #fff;
        margin-bottom: 12px;
    }

    .sell-notification {
        padding: 1rem 1rem;
        background-color: var(--primary-color);
        margin-bottom: 2rem;
    }

    .buy-notification {
        background-color: #fff;
    }
</style>