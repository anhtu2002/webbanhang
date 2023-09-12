<?php
session_start();
$title = 'Chỉnh sửa';
require_once './utils/utility.php';
require_once './database/dbhelper.php';
if (isLogin() == false || empty($_GET)) {
    header('Location: main.php');
    die();
}
include_once 'layouts/header.php';
$userId = $_SESSION['user']['id'];
$id = getGet('id');

$sql = "SELECT * FROM products WHERE id = '$id'";
$product = executeResult($sql, true);
if ($product['seller_id'] != $userId) {
    echo "<script>
    window.location.href = 'banhang.php';
    alert ('Không thể chỉnh sửa sản phẩm của người khác') </script>";
    die();
}



if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
    var_dump($_FILES['image']);
    $errors = [];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];



    if ($file_size > 2097152) {
        $errors[] = 'Kích thước file không được lớn hơn 2MB';
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, 'images/' . $file_name);
        $productImg = 'images/' . $file_name;
    } else {
        echo '<script>alert("Chỉ hỗ trợ upload file JPEG hoặc PNG.")</script>';
    }
}
$date = date('Y/m/d');
$productName = getPost('name');
$productDes = getPost('description');
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
    echo "<script>window.location.href = 'banhang.php';
                alert('Cập nhật thành công');</script>";
}
?>
<div class="container">
    <div class="grid">
        <div class="grid__row">
            <div class="sell-form">
                <form id="edit_pro" action="" method="POST" enctype="multipart/form-data">
                    <div>
                        <input name="id_pro" hidden type="text" value="<?php echo $id ?>">
                        <h4 class="input-name">Ảnh:</h4>
                        <img src="<?= $product['image'] ?>" width="300px" height="auto" alt="">
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <div>
                        <h4 class="input-name">Tên sản phẩm:</h4>
                        <input required="true" type="text" name="name" placeholder="Không quá 100 ký tự" value="<?= $product['name'] ?>" style="width: 100%">
                    </div>
                    <div class="sell-category">
                        <h4 class="input-name">Danh mục:</h4>
                        <select name="category">
                            <option value="">---Lựa chọn danh mục---</option>
                            <?php
                            $sql = 'SELECT * FROM category';
                            $categoryList = executeResult($sql);
                            foreach ($categoryList as $categoryItem) {
                                echo '
                                            <option value="' .
                                    $categoryItem['id'] .
                                    '">' .
                                    $categoryItem['name'] .
                                    '</option>
                                        ';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="description">
                        <h4 class="input-name">Mô tả sản phẩm:</h4>
                        <!-- <input type="text" class="description-text" name="description"> -->
                        <textarea name="description" cols="120" rows="8"><?= $product['description'] ?></textarea>
                    </div>
                    <div>
                        <h4 class="input-name">Giá bán:</h4>
                        <input required="true" type="text" name="price" id="priceId" data-type="currency" value=<?= currency_format(
                                                                                                                    $product['price'],
                                                                                                                    '',
                                                                                                                    ','
                                                                                                                ) ?> maxlength="11">
                    </div>
                    <button type="submit" class="btn" style="margin-left: 0;">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once 'layouts/footer.php';

?>

<script type="text/javascript">
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
    });
    // $("#edit_pro").submit(function(e) {
    //     e.preventDefault();

    //     var form = $(this);
    //     var actionUrl = form.attr('action');

    //     $.ajax({
    //         type: "POST",
    //         url: actionUrl,
    //         data: form.serialize(),
    //         success: function(data) {
    //             if (data == "success") {
    //                 location.reload();
    //                 window.location.href = 'banhang.php';
    //             } else alert("data");
    //         }
    //     })
    // })
</script>