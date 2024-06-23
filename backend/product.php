<?php
session_start();

// Function to add a product to the session cart
function addToCart($product) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Check if product already exists in cart, update quantity if so
    foreach ($_SESSION['cart'] as $key => $item )  {
        if ($item['masp'] === $product['masp'] && $item['size'] === $product['size']) {
            $_SESSION['cart'][$key]['soluong'] += $product['soluong'];
            return;
        }
    }
    
    // Add new product to cart
    $_SESSION['cart'][] = $product;
}

// Lấy mã sản phẩm từ URL
if (isset($_GET['masp'])) {
    $masp = $_GET['masp'];

    // Kết nối CSDL
    require_once 'ketnoi.php';

    // Lấy thông tin sản phẩm
    $lietke_sql = "SELECT * FROM product WHERE masp='$masp'";
    $result = mysqli_query($conn, $lietke_sql);

    if ($r = mysqli_fetch_assoc($result)) {
        // Xử lý thêm sản phẩm vào giỏ hàng
        if (isset($_POST['soluong'])) {
            $soluong = $_POST['soluong'];
            $size = $_POST['size'];
            
            // Chuẩn bị thông tin sản phẩm để thêm vào giỏ hàng
            $productToAdd = array(
                'masp' => $r['masp'],
                'tensp' => $r['tensp'],
                'gia' => $r['gia'],
                'soluong' => $soluong,
                'size' => $size,
                'anh' => $r['anh']
            );

            // Thêm vào giỏ hàng
            addToCart($productToAdd);

            // Hiển thị thông báo thành công sử dụng SweetAlert2
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Đã thêm vào giỏ hàng!",
                        text: "' . $r['tensp'] . ' đã được thêm vào giỏ hàng của bạn.",
                        confirmButtonText: "OK"
                    });
                  </script>';
        }
    } else {
        echo "Không tìm thấy sản phẩm với mã sản phẩm '$masp'.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - <?php echo $r['tensp']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php include '../headertrangchu.php'; ?>

    <!-- Phần hiển thị sản phẩm -->
    <section class="product">
        <div class="container-product">
            <?php if ($r) { ?>
                <div class="product-top row">
                    <p>Trang chủ</p> <span>&#10230;</span> <p>Nam</p> <span>&#10230;</span> <p>Hàng nam mới về</p> <span>&#10230;</span> <p><?php echo $r['tensp']; ?></p>
                </div>
                <div class="product-content">
                    <div class="product-content-left row">
                        <div class="product-content-left-big-img" onmousemove="zoomImage(event)" onmouseleave="unzoomImage(event)">
                            <img id="mainImage" src="../admin/backend_sanpham/img/<?php echo $r['anh']; ?>" alt="">
                        </div>
                        <div class="product-content-left-small-img">
                            <!-- Small images for changing main image on click -->
                            <img src="../admin/backend_sanpham/img/<?php echo $r['anh']; ?>" alt="" onclick="changeImage('../admin/backend_sanpham/img/<?php echo $r['anh']; ?>')">
                            <img src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>" alt="" onclick="changeImage('../admin/backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>')">
                            <img src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt2']; ?>" alt="" onclick="changeImage('../admin/backend_sanpham/anhmota/<?php echo $r['anhmt2']; ?>')">
                            <img src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt3']; ?>" alt="" onclick="changeImage('../admin/backend_sanpham/anhmota/<?php echo $r['anhmt3']; ?>')">
                        </div>
                    </div>
                    <div class="product-content-right">
                        <div class="product-content-right-product-name">
                            <h1><?php echo $r['tensp']; ?></h1>
                            <br>
                            <p>MSP : <?php echo $r['masp']; ?></p>
                        </div>
                        <div class="product-content-right-product-price">
                            <p><?php echo number_format($r['gia']); ?>đ</p>
                        </div>
                        <div class="product-content-right-product-color">
                            <p><span style="font-weight: bold;">Màu sắc </span>:<?php echo $r['mausac']; ?><span style="color: red;">*</span></p>
                        </div>
                        <div class="product-content-right-product-size">
                            <form action="" method="post">
                                <div class="size">
                                    <?php
                                    $lietke_size_sql = "SELECT * FROM tensize";
                                    $result_size = mysqli_query($conn, $lietke_size_sql); 

                                    // Display sizes if available
                                    if ($result_size && mysqli_num_rows($result_size) > 0) {
                                        echo '<select name="size">';
                                        while ($row_size = mysqli_fetch_assoc($result_size)) {
                                            echo '<option value="' . htmlspecialchars($row_size['tensize']) . '">' . htmlspecialchars($row_size['tensize']) . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo '<p>Không có size nào được tìm thấy.</p>';
                                    }
                                    ?>
                                </div>
                                <div>
                                    <i class="fa-solid fa-ruler"></i>
                                    <a href="https://ivymoda.com/about/tu-van-size" id="size-chart-link"><u>Bảng Size</u></a>
                                </div>
                        </div>
                        
                        <div class="quantity">
                            <p style="font-weight: bold;">Số lượng:</p>
                            <input type="number" min="1" name="soluong" value="1">
                        </div>
                        <br>
                        <p style="color: red;">Vui lòng chọn size*</p>
                        <br><br>
                        <div class="product-content-right-product-button">
                            <button type="button"><i class="fas fa-shopping-cart"></i> <p>MUA HÀNG</p></button>
                            <button type="submit" name="add_to_cart"><i class="fa-solid fa-cart-plus" ></i><p>THÊM VÀO GIỎ HÀNG</p></button></a>
                        </div>
                        </form>
                        <br>
                        <div class="product-content-right-product-icon">
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-phone"></i> <p>Hotline</p>
                            </div>
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-regular fa-comment"></i> <p>Chat</p>
                            </div>
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-envelope"></i> <p>Mail</p>
                            </div>
                        </div>
                        <div class="product-content-right-product-QR">
                            <img src="img/qr.png" alt="">
                        </div>
                        <div class="product-content-right-bottom">
                            <div class="product-content-right-bottom-top"></div>
                        </div>
                        <br><br>
                        <div class="product-detail__tab">
                        <div class="product-detail__tab-header">
                                <div class="tab-item active" onclick="showTabContent('gioi-thieu', event)">
                                    <span>GIỚI THIỆU</span>
                                </div>
                                <div class="tab-item" onclick="showTabContent('chi-tiet-san-pham', event)">
                                    <span>CHI TIẾT SẢN PHẨM</span>
                                </div>
                                <div class="tab-item" onclick="showTabContent('bao-quan', event)">
                                    <span>BẢO QUẢN</span>
                                </div>
                            </div>
                            <div class="product-detail__tab-body">
                                <div id="gioi-thieu" class="tab-content active">
                                    <div class="short-content">
                                        <p><?php echo $r['gioithieu']; ?></p>
                                    </div>
                                    <div class="product-detail-divider">
                                        <span><i class="fa fa-chevron-down" onclick="toggleContent('gioi-thieu')"></i></span>
                                    </div>
                                </div>
                                <div id="chi-tiet-san-pham" class="tab-content">
                                    <p><?php echo $r['ctsp']; ?></p>
                                    <div class="product-detail-divider">
                                        <span><i class="fa fa-chevron-down" onclick="toggleContent('chi-tiet-san-pham')"></i></span>
                                    </div>
                                </div>
                                <div id="bao-quan" class="tab-content">
                                    <p><?php echo $r['baoquan']; ?></p>
                                    <div class="product-detail-divider">
                                        <span><i class="fa fa-chevron-down" onclick="toggleContent('bao-quan')"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <?php

    // Lấy sản phẩm tương tự
    if (isset($r['madm'])) {
        $category = $r['madm'];
        $similarProductsQuery = "SELECT * FROM product WHERE madm='$category' AND masp != '$masp' LIMIT 5";
        $similarProductsResult = mysqli_query($conn, $similarProductsQuery);

        if ($similarProductsResult && mysqli_num_rows($similarProductsResult) > 0) {
?>
            <section class="product" >
                <div class="container-product">
                    <p class="sizegiuaindam">SẢN PHẨM TƯƠNG TỰ</p>
                    <br><br><br>
                    <div class="content">
                        <div class="moda">
                            <?php while ($r = mysqli_fetch_assoc($similarProductsResult)) { ?>
                                <div class="moda-item" style="margin-left:30px">
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
<?php
        } else {
            echo '<p>Không có sản phẩm tương tự.</p>';
        }

        mysqli_free_result($similarProductsResult);
    } else {
        echo "Không tìm thấy 'madm' trong dữ liệu sản phẩm.";
    }

    mysqli_close($conn);
?>

        
    </section>

    <!-- Thông báo thêm vào giỏ hàng thành công -->
    <script>
        function addToCart(productName) {
            Swal.fire({
                icon: 'success',
                title: 'Đã thêm vào giỏ hàng!',
                text: `${productName} đã được thêm vào giỏ hàng của bạn.`,
                confirmButtonText: 'OK'
           
            });
        }
    </script>
<br><br><br>
    <!-- Footer -->
    <?php include '../footertrangchu.php'; ?>
</body>
</html>
