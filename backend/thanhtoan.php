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
    </style>
</head>
<body>
    <form action="">
        <div class="container">
            <div class="left">
                <div class="box">
                    <h2>Thông Tin Khách Hàng</h2>
                    <label for="hoten">Họ tên:</label>
                    <input type="text" id="hoten" name="tenkh" placeholder="Nhập họ tên">
                    <label for="SDT">Số điện thoại:</label>
                    <input type="text" id="SDT" name="sdt" placeholder="Nhập SDT">
                    <label for="tinh">Tỉnh/Thành phố:</label>
                    <select id="tinh" name="tinh">
                        <option value="">Chọn tỉnh/thành phố</option>
                        <option value="tinh1">Hà Nội</option>
                        <option value="tinh2">TP. Hồ Chí Minh</option>
                        <option value="tinh3">Thái Bình</option>
                        <option value="tinh4">Đắk Lắk</option>
                    </select>
                    <label for="huyen">Quận/Huyện:</label>
                    <select id="huyen" name="huyen">
                        <option value="">Chọn quận/huyện</option>
                    </select>
                    <label for="xa">Phường/Xã:</label>
                    <select id="xa" name="xa">
                        <option value="">Chọn phường/xã</option>
                    </select>
                    <label for="address">Địa chỉ:</label>
                    <textarea id="address" name="dc" placeholder="Nhập địa chỉ" rows="4"></textarea>
                </div>
                <div class="box">
                    <h2>Thông Tin Thanh Toán</h2>
                    <label for="payment-method">Phương Thức Thanh Toán:</label>
                    <select id="payment-method" name="payment-method" onchange="togglePaymentMethod(this.value)" required>
                        <option value="">Chọn phương thức thanh toán</option>
                        <option value="credit-card">Thẻ Tín Dụng</option>
                        <option value="bank-transfer">Chuyển Khoản Ngân Hàng</option>
                        <option value="cod">Thanh Toán Khi Nhận Hàng</option>
                    </select>
                    <div id="credit-card-info" style="display: none;">
                        <label for="card-name">Tên trên Thẻ:</label>
                        <input type="text" id="card-name" name="card-name">
                        <label for="card-number">Số Thẻ:</label>
                        <input type="text" id="card-number" name="card-number">
                        <label for="exp-month">Tháng Hết Hạn:</label>
                        <input type="text" id="exp-month" name="exp-month">
                        <label for="exp-year">Năm Hết Hạn:</label>
                        <input type="text" id="exp-year" name="exp-year">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv">
                    </div>
                    <div id="bank-transfer-info" style="display: none;">
                        <label for="bank-account-name">Tên Tài Khoản:</label>
                        <input type="text" id="bank-account-name" name="bank-account-name">
                        <label for="bank-account-number">Số Tài Khoản:</label>
                        <input type="text" id="bank-account-number" name="bank-account-number">
                        <label for="bank-name">Tên Ngân Hàng:</label>
                        <input type="text" id="bank-name" name="bank-name">
                        <label for="bank-routing-number">Số Thẻ Ngân Hàng:</label>
                        <input type="text" id="bank-routing-number" name="bank-routing-number">
                    </div>
                </div>
            </div>
            <div class="right">
                <button class="btn1" onclick="toggleCartDetails()" type="button">Hiển Thị Sản Phẩm</button>
                <div class="cart-container" id="cart-container">
                    <div class="cart-details">
                        <h2>Giỏ hàng của bạn</h2>
                        <table>
                            <tr>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Tổng Tiền</th>
                            </tr>
                            <tr>
                                <td>
                                    <img src="https://via.placeholder.com/100" alt="Sản phẩm">
                                    <p>Đầm xoè thắt dây eo</p>
                                    <p>Màu sắc: Họa tiết Size: L</p>
                                    <p>Vàng bò</p>
                                </td>
                                <td>
                                    <input type="text" class="quantity-input" value="1" readonly>
                                </td>
                                <td>1.272.000đ</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>
                                    <img src="https://via.placeholder.com/100" alt="Sản phẩm">
                                    <p>Đầm xoè thắt dây eo</p>
                                    <p>Màu sắc: Họa tiết Size: L</p>
                                    <p>Vàng b
                                    </td>
                                <td>
                                    <input type="text" class="quantity-input" value="1" readonly>
                                </td>
                                <td>1.272.000đ</td>
                            </tr>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="summary-box">
                    <h3>Tóm tắt đơn hàng</h3>
                    <p>Tiền hàng: 1.272.000đ</p>
                    <p>Phí vận chuyển: 38.000đ</p>
                    <p class="total">Tiền thanh toán: 1.310.000đ</p>
                    <a href="donhang.php" class="btn1">Đặt Hàng</a>

                </div>
            </div>
        </div>
    </form>
    <script>
        var tinhThanhPhoData = {
            "tinh1": {
                "name": "Hà Nội",
                "huyen": {
                    "quan1": {
                        "name": "Quận Ba Đình",
                        "xa": {
                            "phuong1": "Phường Trúc Bạch",
                            "phuong2": "Phường Ngọc Hà"
                        }
                    },
                    "quan2": {
                        "name": "Quận Hoàn Kiếm",
                        "xa": {
                            "phuong3": "Phường Phúc Tân",
                            "phuong4": "Phường Đồng Xuân"
                        }
                    },
                    "quan3": {
                        "name": "Quận Hai Bà Trưng",
                        "xa": {
                            "phuong5": "Phường Bách Khoa",
                            "phuong6": "Phường Thanh Lương"
                        }
                    },
                    "quan4": {
                        "name": "Quận Đống Đa",
                        "xa": {
                            "phuong7": "Phường Cát Linh",
                            "phuong8": "Phường Khâm Thiên"
                        }
                    }
                }
            },
            "tinh2": {
                "name": "TP. Hồ Chí Minh",
                "huyen": {
                    "quan5": {
                        "name": "Quận 1",
                        "xa": {
                            "phuong9": "Phường Tân Định",
                            "phuong10": "Phường Bến Nghé"
                        }
                    },
                    "quan6": {
                        "name": "Quận 2",
                        "xa": {
                            "phuong11": "Phường Thảo Điền",
                            "phuong12": "Phường An Phú"
                        }
                    },
                    "quan7": {
                        "name": "Quận 5",
                        "xa": {
                            "phuong13": "Phường 15",
                            "phuong14": "Phường 10"
                        }
                    },
                    "quan8": {
                        "name": "Quận Bình Thạnh",
                        "xa": {
                            "phuong15": "Phường 11",
                            "phuong16": "Phường 13"
                        }
                    }
                }
            },
            "tinh3": {
                "name": "Thái Bình",
                "huyen": {
                    "huyen1": {
                        "name": "Huyện Quỳnh Phụ",
                        "xa": {
                            "xa1": "Thị trấn Quỳnh Lưu",
                            "xa2": "Xã Quỳnh Lập"
                        }
                    },
                    "huyen2": {
                        "name": "Huyện Kiến Xương",
                        "xa": {
                            "xa3": "Thị trấn Kiến Thụy",
                            "xa4": "Xã Kiến Trung"
                        }
                    },
                    "huyen3": {
                        "name": "Huyện Vũ Thư",
                        "xa": {
                            "xa5": "Thị trấn Đông Hưng",
                            "xa6": "Xã Vũ Đông"
                        }
                    }
                }
            },
            "tinh4": {
                "name": "Đắk Lắk",
                "huyen": {
                    "huyen4": {
                        "name": "Thành phố Buôn Ma Thuột",
                        "xa": {
                            "xa7": "Phường Thắng Lợi",
                            "xa8": "Phường Tân Lập"
                        }
                    },
                    "huyen5": {
                        "name": "Huyện Krông Buk",
                        "xa": {
                            "xa9": "Thị trấn Buôn Trấp",
                            "xa10": "Xã Ea Tu"
                        }
                    },
                    "huyen6": {
                        "name": "Huyện Ea Kar",
                        "xa": {
                            "xa11": "Thị trấn Ea Kar",
                            "xa12": "Xã Ea Kao"
                        }
                    }
                }
            }
        };

        var tinhSelect = document.getElementById('tinh');
        var huyenSelect = document.getElementById('huyen');
        var xaSelect = document.getElementById('xa');

        // Clear existing options in select elements
        function clearSelectOptions(selectElement) {
            selectElement.innerHTML = '<option value="">Chọn tỉnh/thành phố</option>';
        }

        // Load province data into tinhSelect
        function loadTinhThanhPho() {
            clearSelectOptions(tinhSelect);
            for (var tinh in tinhThanhPhoData) {
                var option = document.createElement('option');
                option.value = tinh;
                option.textContent = tinhThanhPhoData[tinh].name;
                tinhSelect.appendChild(option);
            }
        }

        // Load district data into huyenSelect based on selected province
        function loadQuanHuyen(selectedTinh) {
            clearSelectOptions(huyenSelect);
            xaSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

            if (selectedTinh !== '') {
                var huyenData = tinhThanhPhoData[selectedTinh].huyen;
                for (var huyen in huyenData) {
                    var option = document.createElement('option');
                    option.value = huyen;
                    option.textContent = huyenData[huyen].name;
                    huyenSelect.appendChild(option);
                }
            }
        }

        // Load ward data into xaSelect based on selected district
        function loadPhuongXa(selectedTinh, selectedHuyen) {
            xaSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

            if (selectedTinh !== '' && selectedHuyen !== '') {
                var xaData = tinhThanhPhoData[selectedTinh].huyen[selectedHuyen].xa;
                for (var xa in xaData) {
                    var option = document.createElement('option');
                    option.value = xa;
                    option.textContent = xaData[xa];
                    xaSelect.appendChild(option);
                }
            }
        }

        // Event listener for province dropdown change
        tinhSelect.addEventListener('change', function() {
            var selectedTinh = this.value;
            loadQuanHuyen(selectedTinh);
        });

        // Event listener for district dropdown change
        huyenSelect.addEventListener('change', function() {
            var selectedTinh = tinhSelect.value;
            var selectedHuyen = this.value;
            loadPhuongXa(selectedTinh, selectedHuyen);
        });

        // Function to toggle payment method fields visibility
        function togglePaymentMethod(method) {
            var creditCardInfo = document.getElementById('credit-card-info');
            var bankTransferInfo = document.getElementById('bank-transfer-info');

            creditCardInfo.style.display = 'none';
            bankTransferInfo.style.display = 'none';

            if (method === 'credit-card') {
                creditCardInfo.style.display = 'block';
            } else if (method === 'bank-transfer') {
                bankTransferInfo.style.display = 'block';
            }
        }

        // Function to toggle cart details visibility
        function toggleCartDetails() {
            var cartContainer = document.getElementById('cart-container');
            if (cartContainer.style.display === 'none') {
                cartContainer.style.display = 'block';
            } else {
                cartContainer.style.display = 'none';
            }
        }

        // Initialize the province dropdown on page load
        loadTinhThanhPho();
    </script>
</body>
</html>
