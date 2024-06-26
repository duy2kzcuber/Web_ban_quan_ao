<?php
session_start();
require_once 'ketnoi.php';

// Hàm lấy giỏ hàng từ database
function loadCartItemsFromDatabase($user_id) {
    $conn = mysqli_connect("localhost", "root", "", "shopthoitrang");
    $cart_items = array();

    $sql = "SELECT ci.*, p.tensp, p.gia, p.anh 
            FROM CartItems ci
            JOIN product p ON ci.product_id = p.masp
            WHERE ci.user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cart_items[] = array(
                'product_id' => $row['product_id'], 
                'tensp' => $row['tensp'],
                'gia' => $row['gia'],
                'soluong' => $row['quantity'],
                'anh' => $row['anh'],
                'size' => $row['size']
            );
        }
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    return $cart_items;
}

// Xử lý xóa mục giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];

    // Xóa mục khỏi session giỏ hàng
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id && $item['size'] == $size) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        // Đặt lại các chỉ số của mảng giỏ hàng
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Nếu người dùng đã đăng nhập, xóa mục khỏi database
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $user_id = $_SESSION['matk'];
        $conn = mysqli_connect("localhost", "root", "", "shopthoitrang");
        $sql = "DELETE FROM CartItems WHERE user_id = '$user_id' AND product_id = '$product_id' AND size = '$size'";
        if (!mysqli_query($conn, $sql)) {
            echo "Lỗi: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    header("Location: /THOITRANG_VHTDT/backend/cart.php");
}

// Xử lý tăng/giảm số lượng sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];

    if (isset($_POST['increase'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id && $item['size'] == $size) {
                $_SESSION['cart'][$key]['soluong'] += 1;
                break;
            }
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $user_id = $_SESSION['matk'];
            $conn = mysqli_connect("localhost", "root", "", "shopthoitrang");
            $sql = "UPDATE CartItems SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id' AND size = '$size'";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
        }
    }

    if (isset($_POST['decrease'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id && $item['size'] == $size) {
                if ($_SESSION['cart'][$key]['soluong'] > 1) {
                    $_SESSION['cart'][$key]['soluong'] -= 1;
                }
                break;
            }
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $user_id = $_SESSION['matk'];
            $conn = mysqli_connect("localhost", "root", "", "shopthoitrang");
            $sql = "UPDATE CartItems SET quantity = quantity - 1 WHERE user_id = '$user_id' AND product_id = '$product_id' AND size = '$size' AND quantity > 1";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
        }
    }
    header("Location: /THOITRANG_VHTDT/backend/cart.php");
}

// Lấy giỏ hàng từ database nếu người dùng đã đăng nhập
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $user_id = $_SESSION['matk'];
    $_SESSION['cart'] = loadCartItemsFromDatabase($user_id);
}

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
        .cart-content form button {
            background-color: #f5ff55;
            border: none;
            cursor: pointer;
        }
        .cart-content form button:hover {
            background-color: #e0e0e0;
        }
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
                            $totalAmount = 0;
                            $totalItems = 0;
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $key => $product) {
                                    $gia_san_pham = isset($product['gia']) ? $product['gia'] : 0;
                                    $so_luong = isset($product['soluong']) ? $product['soluong'] : 0;

                                    $subtotal = floatval($gia_san_pham) * intval($so_luong);
                                    $totalAmount += $subtotal;
                                    $totalItems += intval($so_luong);
                            ?>
                                <tr>
                                    <td>
                                        <img src="../admin/backend_sanpham/img/<?php echo $product['anh']; ?>" alt="">
                                    </td>
                                    <td><?php echo $product['tensp']; ?></td>
                                    <td><?php echo $product['size']; ?></td>
                                    <td><?php echo number_format(floatval($gia_san_pham)) . 'đ'; ?></td>
                                    <td>
                                        <form method="post" action="cart.php" style="display: flex; align-items: center;">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <input type="hidden" name="size" value="<?php echo $product['size']; ?>">
                                            <button type="submit" name="decrease" style="margin-right: 5px;">-</button>
                                            <input type="number" name="soluong" value="<?php echo $product['soluong']; ?>" min="1" readonly style="width: 50px; text-align: center;">
                                            <button type="submit" name="increase" style="margin-left: 5px;">+</button>
                                        </form>
                                    </td>
                                    <td><?php echo number_format($subtotal) . 'đ'; ?></td>
                                    <td>
                                        <form method="post" action="cart.php">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <input type="hidden" name="size" value="<?php echo $product['size']; ?>">
                                            <button type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
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
                        <button><a href="cartegory.php">TIẾP TỤC MUA SẮM</a></button>
                        <button><a href="thanhtoan.php">THANH TOÁN</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../footertrangchu.php'; ?>
</body>
</html>
