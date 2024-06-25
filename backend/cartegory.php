<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HVTD.shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="./index.js"></script>
</head>
<body>

<?php include '../headertrangchu.php'; ?>

<?php
require_once 'ketnoi.php';

// Fetch categories
$query_categories = "SELECT * FROM danhmuc";
$result_categories = mysqli_query($conn, $query_categories);
$categories = array();
while ($category = mysqli_fetch_assoc($result_categories)) {
    $categories[$category['danhmuccha']][] = $category;
}

// Determine the selected category (if any)
$tendm = isset($_GET['tendm']) ? $_GET['tendm'] : null;

// Build query for products based on selected category
if ($tendm) {
    $query_products = "SELECT p.* FROM product p INNER JOIN danhmuc d ON p.madm = d.madm WHERE d.tendm = '$tendm'";
} else {
    $query_products = "SELECT * FROM product";
}

// Determine color filter
$color_filter = isset($_GET['color']) ? $_GET['color'] : null;
if ($color_filter) {
    $query_products .= " AND p.mausac = '$color_filter'";
}

// Sorting and filtering options
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    switch ($sort) {
        case 'newest':
            $query_products .= " ORDER BY ngaytao DESC";
            break;
        case 'price_desc':
            $query_products .= " ORDER BY gia DESC";
            break;
        case 'price_asc':
            $query_products .= " ORDER BY gia ASC";
            break;
        default:
            // Default sorting (could be by masp, tensp, etc.)
            $query_products .= " ORDER BY masp, tensp";
            break;
    }
} else {
    // Default sorting (could be by masp, tensp, etc.)
    $query_products .= " ORDER BY masp, tensp";
}

$result_products = mysqli_query($conn, $query_products);
?>

<section class="cartegory">
    <div class="container">
        <div class="cartegory-top rowe">
            <p><a href="Trangchu.php">Trang chủ</a></p><span>&#10230;</span><p><?php echo $tendm ? $tendm : 'Tất cả sản phẩm'; ?></p>
        </div>
    </div>
    <div class="container">
        <div class="rowe">
            <div class="cartegory-left">
                <div class="filter-section">
                    <h3>BỘ LỌC</h3>
                    <ul>
                        <?php if ($tendm) : ?>
                        <?php endif; ?>
                        <li><a href="cartegory.php<?php echo $tendm ? '?tendm=' . $tendm . '&sort=default' : '?sort=default'; ?>">Mặc định</a></li>
                        <li><a href="cartegory.php<?php echo $tendm ? '?tendm=' . $tendm . '&sort=newest' : '?sort=newest'; ?>">Mới nhất</a></li>
                        <li><a href="cartegory.php<?php echo $tendm ? '?tendm=' . $tendm . '&sort=price_desc' : '?sort=price_desc'; ?>">Giá: cao đến thấp</a></li>
                        <li><a href="cartegory.php<?php echo $tendm ? '?tendm=' . $tendm . '&sort=price_asc' : '?sort=price_asc'; ?>">Giá: thấp đến cao</a></li>
                        <li>
                            <label for="mausac">Màu sắc:</label>
                            <select id="mausac" name="mausac" onchange="filterByColor(this.value)">
                                <option value="">Tất cả màu sắc</option>
                                <?php
                                // Query to get distinct colors from the product table based on selected category
                                $query_colors = "SELECT DISTINCT mausac FROM product";
                                if ($tendm) {
                                    $query_colors = "SELECT DISTINCT mausac FROM product p INNER JOIN danhmuc d ON p.madm = d.madm WHERE d.tendm = '$tendm'";
                                }
                                $result_colors = mysqli_query($conn, $query_colors);
                                while ($color = mysqli_fetch_assoc($result_colors)) {
                                    echo '<option value="' . $color['mausac'] . '">' . $color['mausac'] . '</option>';
                                }
                                ?>
                            </select>
                        </li>
                    </ul>
                </div>
                
            </div>

            <div class="cartegory-right rowe">
                <div class="cartegory-right-content rowe">
                    <?php while ($r = mysqli_fetch_assoc($result_products)) : ?>
                        <div class="cartegory-right-content-item">
                            <ul>
                                <li>
                                    <div class="image-wrapper">
                                        <img src="../admin/backend_sanpham/img/<?php echo $r['anh']; ?>" alt="">
                                        <img class="img2" src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>" alt="">
                                    </div>
                                </li>
                                <li class="description">
                                    <a href="product.php?masp=<?php echo $r['masp']; ?>" class="product-name"><?php echo $r['tensp']; ?></a>
                                    <a href="product.php?masp=<?php echo $r['masp']; ?>" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>
                                </li>
                                <li><?php echo number_format($r['gia']); ?>đ</li>
                            </ul>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="cartegory-right-bottom">
                    <div class="cartegory-right-bottom-item">
                        <ul>
                            <li><a href="#">&laquo;</a></li>
                            <li id="products_active_ts"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                            <li class='last-page'><a href="#">Trang cuối</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../footertrangchu.php'; ?>

<script>
function filterByColor(color) {
    var url = "cartegory.php";
    if (color) {
        url += "?tendm=<?php echo $tendm ? urlencode($tendm) : ''; ?>&color=" + encodeURIComponent(color);
    } else {
        url += "<?php echo $tendm ? '?tendm=' . urlencode($tendm) : ''; ?>";
    }
    window.location.href = url;
}

</script>

</body>
</html>
