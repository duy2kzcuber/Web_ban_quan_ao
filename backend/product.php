<?php
session_start();

// Hàm thêm sản phẩm vào giỏ hàng
function addToCart($product) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Người dùng đã đăng nhập, lưu vào database
        $user_id = $_SESSION['matk'];
        saveCartItemToDatabase($user_id, $product);
    } else {
        // Người dùng chưa đăng nhập, lưu vào session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] === $product['product_id'] && $item['size'] === $product['size']) {
                $_SESSION['cart'][$key]['soluong'] += $product['soluong'];
                return;
            }
        }

        $_SESSION['cart'][] = $product;
        setcookie(session_name(), session_id(), time() + (30 * 24 * 60 * 60), "/");
    }
}

// Hàm kiểm tra số lượng tồn kho
function checkStock($product_id, $size, $quantity) {
    $conn = mysqli_connect("localhost", "root", "", "shopthoitrang");

    $sql = "SELECT soluongsize FROM productsize WHERE masp = '$product_id' AND id = '$size'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    mysqli_close($conn);

    if ($row && $row['soluongsize'] >= $quantity) {
        return true;
    } else {
        return false;
    }
}


// Hàm lưu item vào database
function saveCartItemToDatabase($user_id, $product) {
    $conn = mysqli_connect("localhost", "root", "", "shopthoitrang");

    $product_id = $product['product_id'];
    $quantity = $product['soluong'];
    $tensize = $product['size'];

    

    // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
    $check_sql = "SELECT * FROM CartItems WHERE user_id = '$user_id' AND product_id = '$product_id' AND size = '$tensize'";
    $result_check = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result_check) > 0) {
        // Cập nhật số lượng nếu sản phẩm đã tồn tại
        $update_sql = "UPDATE CartItems SET quantity = quantity + '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id' AND size = '$tensize'";
        mysqli_query($conn, $update_sql);
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $insert_sql = "INSERT INTO CartItems (user_id, product_id, quantity, size) VALUES ('$user_id', '$product_id', '$quantity', '$tensize')";
        mysqli_query($conn, $insert_sql);
    }

    mysqli_close($conn);
}


// Mã xử lý khi người dùng thêm sản phẩm vào giỏ hàng
if (isset($_GET['masp'])) {
    $masp = $_GET['masp'];

    require_once 'ketnoi.php';
    $lietke_sql = "SELECT * FROM product WHERE masp='$masp'";
    $result = mysqli_query($conn, $lietke_sql);

   if ($r = mysqli_fetch_assoc($result)) {
       if (isset($_POST['soluong']) && isset($_POST['size'])) {
        $soluong = $_POST['soluong'];
        $size_id = $_POST['size'];

        // Lấy tên size từ bảng tensize
        $size_sql = "SELECT tensize FROM tensize WHERE id = '$size_id'";
        $size_result = mysqli_query($conn, $size_sql);
        $size_row = mysqli_fetch_assoc($size_result);
        $tensize = $size_row['tensize'];

        // Kiểm tra tồn kho trước khi thêm vào giỏ hàng
        if (checkStock($masp, $size_id, $soluong)) {
            $productToAdd = array(
                'product_id' => $r['masp'],
                'tensp' => $r['tensp'],
                'gia' => $r['gia'],
                'soluong' => $soluong,
                'size' => $tensize, 
                'anh' => $r['anh']
            );

            addToCart($productToAdd);
            if (isset($_POST['mua_hang'])) {
                header("Location: cart.php");
                exit;
            }

            } else {
                echo "Không đủ số lượng sản phẩm với size đã chọn.";
            }
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
                <p><a href="cartegory.php">Quay lại trang sản phẩm</a></p><span>&#10230;</span><?php echo $r['tensp']; ?></p>
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
                            <div style="width: 100px" class="size">
            <?php
            // Truy vấn SQL để lấy danh sách size và số lượng tồn kho từ bảng productsize
            $lietke_size_sql = "SELECT ts.id, ts.tensize, ps.soluongsize 
                                FROM tensize ts
                                LEFT JOIN productsize ps ON ts.id = ps.id 
                                WHERE ps.masp = '$masp'";
            $result_size = mysqli_query($conn, $lietke_size_sql);

            if ($result_size && mysqli_num_rows($result_size) > 0) {
                echo '<select name="size">';
                while ($row_size = mysqli_fetch_assoc($result_size)) {
                    $soluongsize = $row_size['soluongsize'];
                    $tensize = htmlspecialchars($row_size['tensize']);
                    $id = htmlspecialchars($row_size['id']);
                    echo '<option value="' . $id . '">' . $tensize . ' - Số lượng kho: ' . $soluongsize . '</option>';
                }
                echo '</select>';
            } else {
                echo '<p>Sản phẩm này chúng tôi chưa mở bán vui lòng chọn mẫu khác</p>';
            }
            ?>
        </div>
                                
                                
                                <div>
                                    <i class="fa-solid fa-ruler"></i>
                                    <a href="../frontend/tuvansize.php" id="size-chart-link"><u>Bảng Size</u></a>
                                </div>
                        </div>
                        
                        <div class="quantity">
                            <p style="font-weight: bold;">Số lượng mua:</p>
                            <input style="width:70px" type="number" min="1" name="soluong" value="1">
                        </div>
                        <br>
                        <p style="color: red;">Vui lòng chọn size*</p>
                        <br><br>
                        <div class="product-content-right-product-button">
                            <button type="submit" name="mua_hang"><i class="fas fa-shopping-cart"></i> <p>MUA HÀNG</p></button>
                            <button type="submit" name="add_to_cart"><i class="fas fa-shopping-cart"></i> <p>THÊM VÀO GIỎ HÀNG</p></button>
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
            <section class="product">
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

   
<br><br><br>
    <!-- Footer -->
    <?php include '../footertrangchu.php'; ?>
</body>
</html>
