<?php
session_start();
$title = 'Bán hàng';
require_once './utils/utility.php';
require_once './database/dbhelper.php';
if (isLogin() == false) {
    header('Location: main.php');
    die();
}
include_once './layouts/header.php';
$userId = getSession('user')['id'];
if (!empty($_POST)) {
    $productImg = '';
    if (isset($_FILES['image'])) {
        $errors = [];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $exploded = explode('.', $_FILES['image']['name']);
        $last_element = end($exploded);
        $file_ext = strtolower($last_element);
        $expensions = ['jpg', 'png'];

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = 'Chỉ hỗ trợ upload file JPG hoặc PNG.';
        }
        if ($file_size > 2097152) {
            $errors[] = 'Kích thước file không được lớn hơn 2MB';
        }
        if (empty($errors) == true) {
            $randomName =
                substr(getPwdSecurity(time() . $file_name), 0, 8) .
                '.' .
                $file_ext;
            move_uploaded_file($file_tmp, 'images/' . $randomName);
            $productImg = './images/' . $randomName;
            $date = date('Y/m/d');
            $productName = getPost('name');
            $productCategory = getPost('category');
            $productDes = getPost('description');
            $productPrice = getPost('price');

            $productPrice = str_ireplace([','], '', $productPrice);
            $productPrice = (int) $productPrice;

            if ($productName != null && $productPrice != null) {
                $sql = "INSERT INTO products(name, price, description, image, created_date, seller_id, category_id)
                   VALUE ('$productName','$productPrice','$productDes','$productImg','$date','$userId','$productCategory')";
                execute($sql);
            }
        } else {
            echo "<script>alert('$errors[0]')</script>";
        }
    }
}
?>
<div class="container">
    <div class="grid">
        <div class="grid__row">
            <div class="sell-form">
                <form action="" method="POST" accept=".jpg, .png" enctype="multipart/form-data">
                    <div>
                        <h4 class="input-name">Ảnh sản phẩm:</h4>
                    </div>
                    <input required="true" type="file" name="image" />
                    <div>
                        <h4 class="input-name">Tên sản phẩm:</h4>
                        <input required="true" type="text" name="name" placeholder="Không quá 150 ký tự"
                            style="width: 100%;">
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
                        <textarea name="description" cols="120" rows="8"></textarea>
                    </div>
                    <div>
                        <h4 class="input-name">Giá bán:</h4>
                        <input required="true" type="text" name="price" id="currency-field" data-type="currency"
                            maxlength="11">
                    </div>
                    <button type="submit" class="btn" style="margin-left: 0;">Đăng bán</button>
                </form>
            </div>
            <div class="selling">
                <div class="selling-header">Sản phẩm đang bán</div>
                <div class="selling-body">
                    <table class="table table-bordered" style="max-width: 1200px;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá bán</th>
                                <th width="60px"></th>
                                <th width="60px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM products WHERE seller_id = '$userId'";
                            $sellingList = executeResult($sql);
                            $index = 1;
                            foreach ($sellingList as $selling) {
                                echo '<tr>
                <td>' .
                                    $index++ .
                                    '</td>
                <td><img height = "100" width = "auto" src = "' .
                                    $selling['image'] .
                                    '"</td>
                <td>' .
                                    $selling['name'] .
                                    '</td>
                <td>' .
                                    currency_format($selling['price'], '', ',') .
                                    '</td>
                <td><button class="btn btn-warning" 
                onclick=\'window.open("edit.php?id=' .
                                    $selling['id'] .
                                    '","_self")\'>
                Edit</button></td>
                <td><a onclick="return confirm_delete()" href="delete_pro.php?id=' .
                                    $selling['id'] .
                                    '"><button class="btn btn-danger" h>
                                        Delete</button></a></td>
            </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include_once 'layouts/footer.php'; ?>

<script type="text/javascript">
$("input[data-type='currency']").on({
    keyup: function() {
        formatCurrency($(this));
    },
});

function deleteProduct() {
    option = confirm('Bạn muốn xóa sản phẩm này?')
    if (!option) {
        return;
    }

}

function confirm_delete() {
    return confirm("Bạn muốn hủy đơn hàng này?")
}
</script>