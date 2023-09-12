<?php
session_start();

$title = 'Trang chủ';
require_once './utils/utility.php';
require_once './database/dbhelper.php';
include_once './layouts/header.php';

$productList = [];
$search = '';
$sql = '';
$from = 0;
$sql = 'SELECT * FROM products LIMIT 12';
$productList = executeResult($sql);
if (!empty($_GET)) {
    if (isset($_GET['category'])) {
        $category_id = getGet('category');
        $sql = "SELECT * FROM products WHERE category_id = $category_id";
        $productList = executeResult($sql);
    } elseif (isset($_GET['search'])) {
        $search = '%' . getGet('search') . '%';
        $sql = "SELECT * FROM products WHERE name LIKE '$search' OR description LIKE '$search'";
        $productList = executeResult($sql);
    }

    if (isset($_GET['sort'])) {
        $sort = getGet('sort');
        switch ($sort) {
            case 'name':
                usort($productList, function ($item1, $item2) {
                    return stripVN($item1['name']) <=> stripVN($item2['name']);
                });
                break;
            case 'price':
                usort($productList, function ($item1, $item2) {
                    return $item1['price'] <=> $item2['price'];
                });
                break;
            case 'date':
                usort($productList, function ($item1, $item2) {
                    return $item1['created_date'] <=> $item2['created_date'];
                });
                break;
        }
    }
}
?>

<div class="container">
    <div class="grid product">
        <div class="catergory">
            <div class="category-header">
                Danh Mục
            </div>
            <div class="category-list">

                <?php
                $sql = 'SELECT * FROM category';
                $categoryList = executeResult($sql);
                foreach ($categoryList as $categoryItem) {
                    echo '
            <a href="?category=' .
                        $categoryItem['id'] .
                        '" class="category-item">
                <div class="category-item__img" style = "background-image: url(' .
                        $categoryItem['image'] .
                        ')"></div>
                <div class="category-item__name">' .
                        $categoryItem['name'] .
                        '</div>
            </a>';
                }
                ?>
            </div>
        </div>
        <div class="sort">
            <h4 style="display: inline">Sắp xếp theo:</h4>
            <a href="<?php if (empty($_GET)) {
                            echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" .
                                '?sort=name';
                        } elseif (!isset($_GET['sort'])) {
                            echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" .
                                '&sort=name';
                        } elseif (getGet('sort') != '' && getGet('sort') != 'name') {
                            $query = $_GET;
                            $query['sort'] = 'name';
                            $query_result = http_build_query($query);
                            echo $_SERVER['PHP_SELF'] . '?' . $query_result;
                        } ?>" class="btn btn-sort" style="<?php if (getGet('sort') == 'name') {
                                                                echo 'background-color: #359eff; color: #fff;';
                                                            } ?>">Tên sản phẩm</a>
            <a href="<?php sortBy(
                            'price'
                        ); ?>" class="btn btn-sort" style="<?php if (
                                                                getGet('sort') == 'price'
                                                            ) {
                                                                echo 'background-color: #359eff; color: #fff;';
                                                            } ?>">Giá bán</a>
            <a href="<?php sortBy(
                            'date'
                        ); ?>" class="btn btn-sort" style="<?php if (
                                                                getGet('sort') == 'date'
                                                            ) {
                                                                echo 'background-color: #359eff; color: #fff;';
                                                            } ?>">Ngày bán</a>
        </div>
        <div class="grid__row" id="product">
            <?php
            if (count($productList) == 0) {
                echo '<h4 style = " width: 100%; text-align: center;">Không tìm thấy kết quả phù hợp</h4>';
            }
            foreach ($productList as $product) {
                echo '<div class="grid__column-2">
                <a class="product-item" href="sanpham.php?id=' .
                    $product['id'] .
                    '">
                <div class="product-item__img" style="background-image: url(' .
                    $product['image'] .
                    ')"></div>
                <h4 class="product-item__name">' .
                    $product['name'] .
                    '</h4>
                <h5 class="product-item__price">' .
                    currency_format($product['price']) .
                    '</h5>
                </a>
                </div>';
            }
            ?>
        </div>
        <div class="page-list">
            <?php for (
                $i = 1;
                $i <= sizeof($productList) / 12 + 1;
                $i++
            ) {
                echo "<div class=page-num id='page$i' onclick='goToPage($i)'>$i</div>";
            } ?>
        </div>
    </div>
</div>

<?php include_once 'layouts/modal.php'; ?>

<?php
include_once 'layouts/footer.php';
function sortBy($name)
{
    if (empty($_GET)) {
        echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" .
            '?sort=' .
            $name;
    } elseif (!isset($_GET['sort'])) {
        echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" .
            '&sort=' .
            $name;
    } elseif (getGet('sort') != '' && getGet('sort') != $name) {
        $query = $_GET;
        $query['sort'] = $name;
        $query_result = http_build_query($query);
        echo $_SERVER['PHP_SELF'] . '?' . $query_result;
    }
}
?>

<script>
    function goToPage(i) {
        $('.page-list .page-num').css("opacity", "1");
        $.get("./api/api-phantrang.php?page=" + i, (data) => {
            $('#product').empty();
            $('#product').append(data);
            $('#page' + i).css("opacity", "0.5")
        });
    }
</script>