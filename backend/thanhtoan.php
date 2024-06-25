<?php
session_start();

function saveCartToCookies() {
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $cart_serialized = json_encode($cart);
    setcookie('cart', $cart_serialized, time() + (86400 * 30), '/');
    session_regenerate_id(true);
}

if (!isset($_SESSION['cart']) && isset($_COOKIE['cart'])) {
    $_SESSION['cart'] = json_decode($_COOKIE['cart'], true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['cart']);
    saveCartToCookies();
    // Process payment and customer details
    // For simplicity, assume processing here
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
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
        .summary {
            width: 100%;
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
        .summary-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .summary p {
            margin: 0 0 10px;
        }
        .summary .total {
            font-weight: bold;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <div class="box">
            <h2>Thông Tin Khách Hàng</h2>
            <label for="hoten">Họ tên:</label>
            <input type="text" id="hoten" name="tenkh" placeholder="Nhập họ tên" required>
            <label for="SDT">Số điện thoại:</label>
            <input type="text" id="SDT" name="sdt" placeholder="Nhập số điện thoại" required>
            <label for="tinh">Tỉnh/Thành phố:</label>
            <select id="tinh" name="tinh" onchange="loadQuanHuyen(this.value)" required>
                <option value="">Chọn tỉnh/thành phố</option>
                <!-- Options will be populated dynamically using JavaScript -->
            </select>
            <label for="huyen">Quận/Huyện:</label>
            <select id="huyen" name="huyen" onchange="loadPhuongXa(document.getElementById('tinh').value, this.value)" required>
                <option value="">Chọn quận/huyện</option>
                <!-- Options will be populated dynamically using JavaScript -->
            </select>
            <label for="xa">Phường/Xã:</label>
            <select id="xa" name="xa" required>
                <option value="">Chọn phường/xã</option>
                <!-- Options will be populated dynamically using JavaScript -->
            </select>
            <label for="address">Địa chỉ:</label>
            <textarea id="address" name="dc" placeholder="Nhập địa chỉ" rows="4" required></textarea>
        </div>
        <div class="box">
            <h2>Thông Tin Thanh Toán</h2>
            <label for="payment-method">Phương Thức Thanh Toán:</label>
            <select id="payment-method" name="payment-method" onchange="togglePaymentMethod(this.value)" required>
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
        <button class="btn1" onclick="toggleCart()">Hiển thị/Ẩn giỏ hàng</button>
        <div class="cart-details" id="cart-details">
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
                        echo '<tr><td colspan="3">Giỏ hàng của bạn đang trống.</td></tr>';
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Tổng tiền hàng:</td>
                        <td><?php echo number_format($totalAmount) . 'đ'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Tổng tiền thanh toán:</td>
                        <td><?php echo number_format($totalAmount) . 'đ'; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="summary-box">
            <h3>Tóm tắt đơn hàng</h3>
            <p>Tiền hàng: <?php echo number_format($totalAmount) . 'đ'; ?></p>
            <p>Phí vận chuyển: 0đ</p>
            <p class="total">Tổng cộng: <?php echo number_format($totalAmount) . 'đ'; ?></p>
            <button type="submit">Đặt hàng</button>
        </div>
    </div>
</div>
<script>
    var tinhThanhPhoData = {
        "tinh1": {
            "name": "Hà Nội",
            "huyen": {
                "quan1": {
                    "name": "Quận Ba Đình",
                    "xa": {
                        "phuong1": "Phường Cống Vị",
                        "phuong2": "Phường Điện Biên",
                        "phuong3": "Phường Đội Cấn"
                    }
                },
                "quan2": {
                    "name": "Quận Hoàn Kiếm",
                    "xa": {
                        "phuong1": "Phường Chương Dương",
                        "phuong2": "Phường Cửa Đông",
                        "phuong3": "Phường Cửa Nam"
                    }
                }
            }
        },
        "tinh2": {
            "name": "Hồ Chí Minh",
            "huyen": {
                "quan1": {
                    "name": "Quận 1",
                    "xa": {
                        "phuong1": "Phường Bến Nghé",
                        "phuong2": "Phường Bến Thành",
                        "phuong3": "Phường Cô Giang"
                    }
                },
                "quan2": {
                    "name": "Quận 3",
                    "xa": {
                        "phuong1": "Phường 1",
                        "phuong2": "Phường 2",
                        "phuong3": "Phường 3"
                    }
                }
            }
        }
    };

    function loadTinhThanhPho() {
        var tinhSelect = document.getElementById("tinh");
        for (var tinhId in tinhThanhPhoData) {
            var tinh = tinhThanhPhoData[tinhId];
            var option = document.createElement("option");
            option.value = tinhId;
            option.text = tinh.name;
            tinhSelect.appendChild(option);
        }
    }

    function loadQuanHuyen(tinhId) {
        var huyenSelect = document.getElementById("huyen");
        huyenSelect.innerHTML = '<option value="">Chọn quận/huyện</option>';
        var xaSelect = document.getElementById("xa");
        xaSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

        if (tinhId) {
            var huyenData = tinhThanhPhoData[tinhId].huyen;
            for (var huyenId in huyenData) {
                var huyen = huyenData[huyenId];
                var option = document.createElement("option");
                option.value = huyenId;
                option.text = huyen.name;
                huyenSelect.appendChild(option);
            }
        }
    }

    function loadPhuongXa(tinhId, huyenId) {
        var xaSelect = document.getElementById("xa");
        xaSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

        if (tinhId && huyenId) {
            var xaData = tinhThanhPhoData[tinhId].huyen[huyenId].xa;
            for (var xaId in xaData) {
                var xa = xaData[xaId];
                var option = document.createElement("option");
                option.value = xaId;
                option.text = xa;
                xaSelect.appendChild(option);
            }
        }
    }

    function togglePaymentMethod(paymentMethod) {
        var qrCodeSection = document.getElementById("qr-code");
        if (paymentMethod === "online-payment") {
            qrCodeSection.style.display = "block";
        } else {
            qrCodeSection.style.display = "none";
        }
    }

    function toggleCart() {
        var cartDetails = document.getElementById("cart-details");
        if (cartDetails.style.display === "none" || cartDetails.style.display === "") {
            cartDetails.style.display = "block";
        } else {
            cartDetails.style.display = "none";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        loadTinhThanhPho();
    });
</script>
</body>
</html>
