<?php
    session_start();
    require_once('ketnoi.php'); // Đảm bảo file kết nối đến cơ sở dữ liệu

    function saveCartToCookies() {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        $cart_serialized = json_encode($cart);
        setcookie('cart', $cart_serialized, time() + (86400 * 30), '/');
        session_regenerate_id(true);
    }

    // Tính tổng tiền của giỏ hàng
    function calculateTotalAmount() {
        $totalAmount = 0;
        $shippingFee = 50000;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product) {
                $totalAmount += ($product['gia'] * $product['soluong']);
            }
            $totalAmount+= $shippingFee;
        }
        return $totalAmount;
    }

    // Kiểm tra xem session matk đã tồn tại (người dùng đã đăng nhập)
    if (isset($_SESSION['matk'])) {
        $matk = $_SESSION['matk'];
         // Lấy thông tin của người dùng từ cơ sở dữ liệu
         $query_user = "SELECT * FROM TaiKhoan WHERE matk = '$matk'";
         $result_user = mysqli_query($conn, $query_user);
         if ($result_user && mysqli_num_rows($result_user) > 0) {
             $row_user = mysqli_fetch_assoc($result_user);
             $tenkh = $row_user['tenkh'];
             $sdt = $row_user['sdt'];
             $dc = $row_user['dc'];
         } else {
             die('Error: Không tìm thấy thông tin người dùng.');
         }
       
        // Xử lý khi người dùng submit form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $tenkh = $_POST['tenkh'];
            $sdt = $_POST['sdt'];
            $dc = $_POST['dc'];
            $pttt= $_POST['pttt'];
        
            $totalAmount = calculateTotalAmount();
            // Insert đơn hàng vào bảng Orders
            $query_order = "INSERT INTO Orders (user_id, ten_khach_hang, so_dien_thoai, dia_chi, ngay_dat_hang, ngay_nhan_hang,trangthai, pttt, tongtien)
                            VALUES ('$matk', '$tenkh', '$sdt', '$dc', NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY),'Chờ xác nhận', '$pttt', '$totalAmount')";

            mysqli_query($conn, $query_order);
            $order_id = mysqli_insert_id($conn);
    $_SESSION['order_id'] = $order_id;

            
            // Lặp qua giỏ hàng và lưu vào bảng OrderDetails
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $product) {
                    $product_id = $product['product_id'];
                    $sl = mysqli_real_escape_string($conn, $product['soluong']);
                    $size = mysqli_real_escape_string($conn, $product['size']); 
                    $shippingFee = 50000;

                    // Query để lấy thông tin sản phẩm từ bảng product
                    $query_product = "SELECT p.masp, p.tensp, p.gia 
                                    FROM Product p
                                    WHERE p.masp = '$product_id'";
                    $result_product = mysqli_query($conn, $query_product);

                    if ($result_product && mysqli_num_rows($result_product) > 0) {
                        $row = mysqli_fetch_assoc($result_product);
                        $masp = $row['masp'];
                        $tensp = $row['tensp'];
                        $dongia = $row['gia'];
                    } else {
                        die('Error: Không tìm thấy thông tin sản phẩm.');
                    }

                    $thanhtien = ($sl * $dongia) ;

                    // Insert vào bảng OrderDetails với thông tin tensize
                    $query_order_detail = "INSERT INTO OrderDetails (order_id, masp, tensp, size, sl, dongia, thanhtien)
                                        VALUES ('$order_id', '$masp', '$tensp', '$size', '$sl', '$dongia', '$thanhtien')";

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
        $tenkh = '';
        $sdt = '';
        $dc = '';
        // Xử lý khi người dùng chưa đăng nhập (user_id sẽ là NULL)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $tenkh = $_POST['tenkh'];
            $sdt = $_POST['sdt'];
            $dc = $_POST['dc'];
            $pttt= $_POST['pttt'];
            $shippingFee=50000;
            $totalAmount = calculateTotalAmount();

            // Insert đơn hàng vào bảng Orders với user_id là NULL
            $query_order = "INSERT INTO Orders (user_id, ten_khach_hang, so_dien_thoai, dia_chi, ngay_dat_hang, ngay_nhan_hang, trangthai ,pttt, tongtien)
                            VALUES (NULL, '$tenkh', '$sdt', '$dc', NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY), 'Chờ xác nhận','$pttt', '$totalAmount')";
            mysqli_query($conn, $query_order);
            $order_id = mysqli_insert_id($conn);
    // Lưu order_id vào session
    $_SESSION['order_id'] = $order_id;

           // Lặp qua giỏ hàng và lưu vào bảng OrderDetails
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product) {
                $product_id = $product['product_id'];
                $sl = mysqli_real_escape_string($conn, $product['soluong']);
                $size = mysqli_real_escape_string($conn, $product['size']); 
               

                // Query để lấy thông tin sản phẩm từ bảng product
                $query_product = "SELECT p.masp, p.tensp, p.gia 
                                FROM Product p
                               
                                WHERE p.masp = '$product_id'";
                $result_product = mysqli_query($conn, $query_product);

                if ($result_product && mysqli_num_rows($result_product) > 0) {
                    $row = mysqli_fetch_assoc($result_product);
                    $masp = $row['masp'];
                    $tensp = $row['tensp'];
                 
                    $dongia = $row['gia'];
                } else {
                    die('Error: Không tìm thấy thông tin sản phẩm.');
                }

                $thanhtien = $sl*$dongia;

                // Insert vào bảng OrderDetails với thông tin tensize
                $query_order_detail = "INSERT INTO OrderDetails (order_id, masp, tensp, size, sl, dongia, thanhtien)
                                    VALUES ('$order_id', '$masp', '$tensp', '$size', '$sl', '$dongia', '$thanhtien')";

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
            header("Location:donhang.php?order_id=$order_id");
            exit();
        }
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng</title>
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
            flex-wrap: wrap;
            gap: 20px;
        }
        .box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .left, .right {
            flex: 1;
            min-width: 300px;
        }
        .box h1, .box h2, .box h3 {
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
        .btn1, button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #40cb81;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .btn1:hover, button:hover {
            background-color: #bf3ec8;
        }
        .cart-container {
            display: none;
        }
        .cart-details {
            width: 100%;
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
        }
        .cart-details img {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }
        .cart-details .quantity-input {
            width: 50px;
            text-align: center;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <form method="post" action="thanhtoan.php">
        <div class="container">
            <div class="left">
                <!-- Customer Information Box -->
                <div class="box">
                    <h2>Thông Tin Khách Hàng</h2>
                    <label for="hoten">Họ tên:</label>
                    <input type="text" id="hoten" name="tenkh" value="<?php echo $tenkh; ?>" placeholder="Nhập họ tên" required>
                    <label for="SDT">Số điện thoại:</label>
                    <input type="text" id="SDT" name="sdt" value="<?php echo $sdt; ?>" placeholder="Nhập số điện thoại" required>
                    <label for="address">Địa chỉ:</label>
                    <textarea id="address" name="dc" placeholder="Nhập địa chỉ" rows="4" required><?php echo $dc; ?></textarea>
                </div>
                <!-- Payment Information Box -->
                <div class="box">
                    <h2>Thông Tin Thanh Toán</h2>
                    <label for="payment-method">Phương Thức Thanh Toán:</label>
                    <select id="payment-method" name="pttt" onchange="togglePaymentMethod(this.value)" required>
                        <option value="">Chọn phương thức thanh toán</option>
                        <option value="online-payment">Thanh Toán Online</option>
                        <option value="cod">Thanh Toán Khi Nhận Hàng</option>
                    </select>
                    <div id="qr-code" style="display: none;">
                        <h3>Quét mã QR để thanh toán</h3>
                        <img src="img/qrr.jpg" alt="QR Code" width="200">
                        <p>Cảm ơn bạn đã mua hàng!</p>
                    </div>
                </div>
            </div>
            <div class="right">
                <!-- Toggle Cart Button and Cart Details -->
                <button type="button" class="btn1" onclick="toggleCart()">Hiển thị/Ẩn giỏ hàng</button>
                <div class="cart-details" id="cart-details">
                    <h2>Giỏ hàng của bạn</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Size</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display cart items dynamically
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $product) {
                                    echo "<tr>";
                                    echo "<td>";
                                    if (!empty($product['anh'])) {
                                        echo "<img src='../admin/backend_sanpham/img/{$product['anh']}' alt='Product'>";
                                    }
                                    echo "{$product['tensp']}</td>";
                                    echo "<td>{$product['soluong']}</td>";
                                    echo "<td>{$product['size']}</td>";
                                    echo "<td>" . number_format($product['gia'] * $product['soluong']) . "đ</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Giỏ hàng của bạn đang trống.</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Phí giao hàng:</td>
                                <td>
                                    50,000đ
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Tổng tiền thanh toán:</td>
                                <td>
                                    <?php
                                    // Display total amount dynamically
                                    if (!empty($_SESSION['cart'])) {
                                        $totalAmount = 0;
                                        foreach ($_SESSION['cart'] as $product) {
                                            $totalAmount += $product['gia'] * $product['soluong'];
                                        }
                                        $totalAmount+=50000;
                                        echo number_format($totalAmount ) . 'đ';
                                    } else {
                                        echo '0đ';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- Order Button -->
                <button type="submit">Đặt hàng</button>
            </div>
        </div>
    </form>
    <script>
        // JavaScript function to toggle payment method display
        function togglePaymentMethod(paymentMethod) {
            var qrCodeDiv = document.getElementById('qr-code');
            if (paymentMethod === 'online-payment') {
                qrCodeDiv.style.display = 'block';
            } else {
                qrCodeDiv.style.display = 'none';
            }
        }

        // JavaScript function to toggle cart visibility
        function toggleCart() {
            var cartDetails = document.getElementById('cart-details');
            if (cartDetails.style.display === 'none' || cartDetails.style.display === '') {
                cartDetails.style.display = 'block';
            } else {
                cartDetails.style.display = 'none';
            }
        }
    </script>
</body>
</html>
