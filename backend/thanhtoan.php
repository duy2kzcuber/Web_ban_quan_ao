<?php
session_start();
require_once('ketnoi.php'); // Đảm bảo file kết nối đến cơ sở dữ liệu

function saveCartToCookies() {
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $cart_serialized = json_encode($cart);
    setcookie('cart', $cart_serialized, time() + (86400 * 30), '/');
    session_regenerate_id(true);
}

// Kiểm tra xem session matk đã tồn tại (người dùng đã đăng nhập)
if (isset($_SESSION['matk'])) {
    $matk = $_SESSION['matk'];
    
    // Xử lý khi người dùng submit form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy thông tin từ form
        $tenkh = mysqli_real_escape_string($conn, $_POST['tenkh']);
        $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);
        $tinh = mysqli_real_escape_string($conn, $_POST['tinh']);
        $huyen = mysqli_real_escape_string($conn, $_POST['huyen']);
        $xa = mysqli_real_escape_string($conn, $_POST['xa']);
        $dc = mysqli_real_escape_string($conn, $_POST['dc']);
        $pttt = mysqli_real_escape_string($conn, $_POST['pttt']);
        $totalAmount = isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 0;

        // Insert đơn hàng vào bảng Orders
        $query_order = "INSERT INTO Orders (user_id, ten_khach_hang, so_dien_thoai, tinh, huyen, xa, dia_chi, tongtien, pttt, ngay_dat_hang)
                        VALUES ('$matk', '$tenkh', '$sdt', '$tinh', '$huyen', '$xa', '$dc', $totalAmount, '$pttt', NOW())";
        mysqli_query($conn, $query_order);
        $order_id = mysqli_insert_id($conn);

        // Lặp qua giỏ hàng và lưu vào bảng OrderDetails
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $product) {
                $product_id = mysqli_real_escape_string($conn, $product['product_id']);

                // Query để lấy thông tin sản phẩm từ bảng product
                $query_product = "SELECT masp, tensp, gia FROM product WHERE masp = '$product_id'";
                $result_product = mysqli_query($conn, $query_product);
                if ($result_product && mysqli_num_rows($result_product) > 0) {
                    $row = mysqli_fetch_assoc($result_product);
                    $masp = mysqli_real_escape_string($conn, $row['masp']);
                    $tensp = mysqli_real_escape_string($conn, $row['tensp']);
                    $dongia = mysqli_real_escape_string($conn, $row['gia']);
                } else {
                    // Xử lý nếu không tìm thấy thông tin sản phẩm
                    die('Error: Không tìm thấy thông tin sản phẩm.');
                }

                $sl = mysqli_real_escape_string($conn, $product['soluong']);
                $thanhtien = $sl * $dongia;

                // Insert vào bảng OrderDetails
                $query_order_detail = "INSERT INTO OrderDetails (order_id, masp, tensp, sl, dongia, thanhtien)
                                       VALUES ('$order_id', '$masp', '$tensp', '$sl', '$dongia', '$thanhtien')";
                $result = mysqli_query($conn, $query_order_detail);
                if (!$result) {
                    die('Error: ' . mysqli_error($conn)); // Xử lý lỗi khi câu lệnh SQL thất bại
                }
            }
        }

        // Xóa giỏ hàng và lưu vào cookies
        unset($_SESSION['cart']);
        saveCartToCookies();

        // Chuyển hướng đến trang xác nhận đơn hàng
        header("Location: donhang.php");
        exit();
    }
} else {
    // Xử lý khi người dùng chưa đăng nhập (user_id sẽ là NULL)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy thông tin từ form
        $tenkh = mysqli_real_escape_string($conn, $_POST['tenkh']);
        $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);
        $tinh = mysqli_real_escape_string($conn, $_POST['tinh']);
        $huyen = mysqli_real_escape_string($conn, $_POST['huyen']);
        $xa = mysqli_real_escape_string($conn, $_POST['xa']);
        $dc = mysqli_real_escape_string($conn, $_POST['dc']);
        $pttt = mysqli_real_escape_string($conn, $_POST['pttt']);
        $totalAmount = isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 0;

        // Insert đơn hàng vào bảng Orders với user_id là NULL
        $query_order = "INSERT INTO Orders (user_id, ten_khach_hang, so_dien_thoai, tinh, huyen, xa, dia_chi, tongtien, pttt, ngay_dat_hang)
                        VALUES (NULL, '$tenkh', '$sdt', '$tinh', '$huyen', '$xa', '$dc', $totalAmount, '$pttt', NOW())";
        mysqli_query($conn, $query_order);
        $order_id = mysqli_insert_id($conn);

        // Lặp qua giỏ hàng và lưu vào bảng OrderDetails
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $product) {
                $product_id = mysqli_real_escape_string($conn, $product['product_id']);

                // Query để lấy thông tin sản phẩm từ bảng product
                $query_product = "SELECT masp, tensp, gia FROM product WHERE masp = '$product_id'";
                $result_product = mysqli_query($conn, $query_product);
                if ($result_product && mysqli_num_rows($result_product) > 0) {
                    $row = mysqli_fetch_assoc($result_product);
                    $masp = mysqli_real_escape_string($conn, $row['masp']);
                    $tensp = mysqli_real_escape_string($conn, $row['tensp']);
                    $dongia = mysqli_real_escape_string($conn, $row['gia']);
                } else {
                    die('Error: Không tìm thấy thông tin sản phẩm.');
                }

                $sl = mysqli_real_escape_string($conn, $product['soluong']);
                $thanhtien = $sl * $dongia;

                // Insert vào bảng OrderDetails
                $query_order_detail = "INSERT INTO OrderDetails (order_id, masp, tensp, sl, dongia, thanhtien)
                                       VALUES ('$order_id', '$masp', '$tensp', '$sl', '$dongia', '$thanhtien')";
                $result = mysqli_query($conn, $query_order_detail);
                if (!$result) {
                    die('Error: ' . mysqli_error($conn)); 
                }
            }
        }

        // Xóa giỏ hàng và lưu vào cookies
        unset($_SESSION['cart']);
        saveCartToCookies();

        // Chuyển hướng đến trang xác nhận đơn hàng
        header("Location: donhang.php");
        exit();
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .left, .right {
            flex: 1;
            min-width: 300px;
        }
        .box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .box h2, .box h3 {
            margin-top: 0;
        }
        .box label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .box input, .box select, .box textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .box textarea {
            resize: vertical;
        }
        .btn1 button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #40cb81;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .btn1 button:hover {
            background-color: #bf3ec8;
        }
        .cart-details {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .cart-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-details th, .cart-details td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .cart-details th {
            background-color: #f9f9f9;
            text-align: left;
        }
        .cart-details img {
            width: 80px;
            height: auto;
            margin-right: 10px;
            vertical-align: middle;
        }
        .summary-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .summary-box h3 {
            margin-top: 0;
        }
        .summary-box p {
            margin-bottom: 10px;
        }
        .summary-box .total {
            font-weight: bold;
        }
        #qr-code {
            display: none;
            text-align: center;
        }
        #qr-code img {
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <div class="box">
            <h2>Thông Tin Khách Hàng</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="tenkh">Họ tên:</label>
                <input type="text" id="tenkh" name="tenkh" placeholder="Nhập họ tên" required>
                
                <label for="sdt">Số điện thoại:</label>
                <input type="text" id="sdt" name="sdt" placeholder="Nhập số điện thoại" required>
                
                <label for="tinh">Tỉnh/Thành phố:</label>
                <input type="text" id="tinh" name="tinh" placeholder="Nhập tỉnh/thành phố" required>
                
                <label for="huyen">Quận/Huyện:</label>
                <input type="text" id="huyen" name="huyen" placeholder="Nhập quận/huyện" required>
                
                <label for="xa">Phường/Xã:</label>
                <input type="text" id="xa" name="xa" placeholder="Nhập phường/xã" required>
                
                <label for="dc">Địa chỉ:</label>
                <textarea id="dc" name="dc" placeholder="Nhập địa chỉ" rows="4" required></textarea>
                
                <div class="box">
                    <h2>Thông Tin Thanh Toán</h2>
                    <label for="pttt">Phương Thức Thanh Toán:</label>
                    <select id="pttt" name="pttt" onchange="togglePaymentMethod(this.value)" required>
                        <option value="">Chọn phương thức thanh toán</option>
                        <option value="thanhtoanonline">Thanh Toán Online</option>
                        <option value="thanhtoankhinhanhang">Thanh Toán Khi Nhận Hàng</option>
                    </select>
                    <div id="qr-code">
                        <h3>Quét mã QR để thanh toán</h3>
                        <img src="img/qrr.jpg" alt="QR Code">
                        <p>Cảm ơn bạn đã mua hàng!</p>
                    </div>
                </div>
                
                <div class="btn1">
                    <button type="submit">Xác nhận đơn hàng</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="right">
        <!-- Cart details section -->
        <div class="cart-details">
            <h2>Giỏ hàng của bạn</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Size</th>
                        <th>Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalAmount = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $key => $product) {
                            $subtotal = floatval($product['gia']) * intval($product['soluong']);
                            $totalAmount += $subtotal;
                            $_SESSION['totalAmount'] = $totalAmount;
                    ?>
                            <tr>
                                <td>
                                    <img src="../admin/backend_sanpham/img/<?php echo $product['anh']; ?>" alt="Product">
                                    <p><?php echo $product['tensp']; ?></p>
                                </td>
                                <td><?php echo $product['soluong']; ?></td>
                                <td><?php echo $product['size']; ?></td>
                                <td><?php echo number_format($subtotal) . 'đ'; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="4">Giỏ hàng của bạn đang trống.</td></tr>';
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Tổng tiền hàng:</td>
                        <td><?php echo number_format($totalAmount) . 'đ'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Tổng tiền thanh toán:</td>
                        <td><?php echo number_format($totalAmount) . 'đ'; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <!-- Summary box section -->
        <div class="summary-box">
            <h3>Tóm tắt đơn hàng</h3>
            <p>Tiền hàng: <?php echo number_format($totalAmount) . 'đ'; ?></p>
            <p>Phí vận chuyển: 0đ</p>
            <p class="total">Tổng cộng: <?php echo number_format($totalAmount) . 'đ'; ?></p>
        </div>
    </div>
</div>

<script>
    function togglePaymentMethod(paymentMethod) {
        var qrCodeSection = document.getElementById("qr-code");
        if (paymentMethod === "thanhtoanonline") {
            qrCodeSection.style.display = "            block";
        } else {
            qrCodeSection.style.display = "none";
        }
    }
</script>

</body>
</html>

