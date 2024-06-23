<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Your custom CSS file -->
    <style>
        /* Custom CSS for cart page */
    </style>
</head>
<body>
    <!-- Header -->
    <?php include '../headertrangchu.php'; ?>

    <section class="cart">
        <div class="container">
            <div class="cart-content">
                <div class="cart-content-left">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_SESSION['cart'])) {
                                $totalAmount = 0;
                                $totalItems = 0;
                                foreach ($_SESSION['cart'] as $key => $product) {
                                    // Calculate subtotal for each product
                                    $subtotal = floatval($product['gia']) * intval($product['soluong']);
                                    $totalAmount += $subtotal;
                                    $totalItems += intval($product['soluong']);
                            ?>
                                <tr>
                                    <td>
                                        <img src="../admin/backend_sanpham/img/<?php echo $product['anh']; ?>" alt="">
                                    </td>
                                    <td><?php echo $product['tensp']; ?></td>
                                    <td><?php echo $product['size']; ?></td>
                                    <td><?php echo number_format(floatval($product['gia'])) . 'đ'; ?></td>
                                    <td>
                                        <form action="capnhatgiohang.php" method="post">
                                            <input type="hidden" name="key" value="<?php echo $key; ?>">
                                            <input type="number" name="soluong" value="<?php echo intval($product['soluong']); ?>" min="1">
                                            <button type="submit">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td><?php echo number_format($subtotal) . 'đ'; ?></td>
                                    <td><a href="xoacard.php?key=<?php echo $key; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="7">Giỏ hàng của bạn đang trống.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                        </tr>
                        <tr>
                            <td>TỔNG SẢN PHẨM</td>
                            <td><?php echo isset($_SESSION['cart']) ? $totalItems : '0'; ?></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td><?php echo isset($_SESSION['cart']) ? number_format($totalAmount) . 'đ' : '0đ'; ?></td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH</td>
                            <td style="color: black; font-weight: bold;"><?php echo isset($_SESSION['cart']) ? number_format($totalAmount) . 'đ' : '0đ'; ?></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-button">
                        <button><a href="category.html">TIẾP TỤC MUA SẮM</a></button>
                        <button><a href="checkout.php">THANH TOÁN</a></button>
                    </div>
                    <div class="cart-content-right-dangnhap">
                        <p>Tài khoản IVY</p>
                        <p>Hãy <a href="">Đăng nhập</a> tài khoản của bạn để tích điểm thành viên</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../footertrangchu.php'; ?>
</body>
</html>
