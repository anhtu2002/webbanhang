<?php
session_start();
$title = 'Chi tiết sản phẩm';
require_once './utils/utility.php';
require_once './database/dbhelper.php';
include_once 'layouts/header.php';


$seller = '';
$productId = '';
if (!empty($_GET)) {
    $productId = getGet('id');
    $sql = "SELECT * FROM products WHERE id = '$productId'";
    $thisProduct = executeResult($sql, true);
    $sql = 'SELECT * FROM users WHERE id = ' . $thisProduct['seller_id'];
    $seller = executeResult($sql, true);
}
?>
<div class="container">

    <div class="grid">
        <div class="product-detail">
            <div class="this-product__img" style="background-image: url(<?= $thisProduct['image'] ?>); 
                    background-size: contain; background-repeat: no-repeat;">
            </div>
            <div class="this-product__info">
                <span class="this-product__name"><?= $thisProduct['name'] ?></span>
                <div class="this-product__price"><?= currency_format(
                                                        $thisProduct['price']
                                                    ) ?></div>
                <div id="add_cart" class="btn add-btn" onclick="addToCart(<?= $productId ?>)"
                    style="background-color: green;">Thêm
                    vào giỏ hàng</div>
                <div class="btn buy-btn" onclick="buyNow(<?= $productId ?>)">Mua ngay</div>
                <div class="this-product__seller">
                    <span>
                        Người bán:
                        <?= $seller['email'] ?>
                    </span>
                    <span>
                        Ngày đăng: <?= $thisProduct['created_date'] ?>
                    </span>
                    <?php if ($thisProduct['updated_date'] != null) {
                        echo '<span>Ngày cập nhật: ';
                        echo $thisProduct['updated_date'] . '</span>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="this-product_des" id="result" style="word-wrap: break-word;">
            <div class="this-product_des-header">Mô tả sản phẩm</div>
            <div class="this-product_des-body">
                <pre>
                            <p style="white-space: pre-wrap;"><?= $thisProduct['description'] ?></p>
                        </pre>
            </div>
        </div>
    </div>
    <?php
    include_once 'layouts/modal.php';
    $isLogin = 'false';
    if (isLogin()) {
        $isLogin = 'true';
    }
    echo "
        <script>
        var isLogin = '$isLogin';
        </script>";
    ?>
</div>
<?php
if (isLogin() == true) {
    global $userId;
    $userId = $_SESSION['user']['id'];
}
?>


<div>
    <form id="hidden_form" method="POST" action="" enctype="multipart/form-data" style="display: none;">

        <input value="<?php echo $productId ?> " name="proid">
        <input value="<?php echo $userId ?>" name="userid">
        <input value="1" name="sl">

    </form>
</div>

<script type="text/javascript">
var a = document.getElementById('add_cart');
a.addEventListener('click', function() {
    // Gửi biểu mẫu khi nút được ấn
    document.getElementById('hidden_form').submit();
});

function addToCart(id) {

    if (isLogin == 'false') {
        alert("Cần đăng nhập trước!");
        return;
    } else {

        $.post('api/api-sanpham.php', {
            'action': 'add',
            'id': id
        }, function(data) {
            if (data != "" && data != null) {
                alert(data);
            } else {
                location.reload();
            }
        })
    }

}

function buyNow(id) {
    $.post("api/api-sanpham.php", {
        'action': 'buy',
        'id': id
    }, function(data) {
        if (data != "" && data != null) {
            alert(data);
        } else {
            location.href = "checkout.php?buy=" + id
        }
    })
}
</script>

<?php include_once 'layouts/footer.php'; ?>
<?php
if (!empty($_POST)) {
    $product_Id = getPost('proid');
    $user_id = getPost('userid');
    $sl = getPost('sl');


    $sql = "INSERT INTO cart(product_id,user_id,num) VAlUE ('$product_Id','$user_id','$sl')";

    execute($sql);
}

?>