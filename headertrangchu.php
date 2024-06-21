<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="./index.js"></script>
</head>
<body>

<header style="background-color: rgb(253, 252, 252);">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="HVTD Logo">
        </a>
    </div>
    <div class="menu">
        <ul>
            <?php
            require_once 'ketnoi.php';

            // Fetch categories
            $query_categories = "SELECT * FROM danhmuc";
            $result_categories = mysqli_query($conn, $query_categories);
            $categories = array();
            while ($cartegory = mysqli_fetch_assoc($result_categories)) {
                $categories[$cartegory['danhmuccha']][] = $cartegory;
            }

            foreach ($categories as $main_category_name => $subcategories) {
                echo '<li class="menu-item"><a href="cartegory.php?tendm=' . urlencode($main_category_name) . '">' . $main_category_name . '</a>';
                if (!empty($subcategories)) {
                    echo '<ul class="sub-menu">';
                    foreach ($subcategories as $subcategory) {
                        echo '<li><a href="cartegory.php?tendm=' . urlencode($subcategory['tendm']) . '">' . $subcategory['tendm'] . '</a></li>';
                    }
                    echo '</ul>';
                }
                echo '</li>';
            }
            ?>
            <li class="menu-item">
                <a>THÔNG TIN</a>
                <ul class="sub-menu">
                    <li><a href="tuvansize.html">Tư vấn size</a></li>
                    <li><a href="chinhsachdieukhoan.html">Chính sách điều khoản</a></li>
                    <li><a href="huongdanmuahang.html">Hướng dẫn mua hàng</a></li>
                    <li><a href="chinhsachthanhtoan.html">Chính sách thanh toán</a></li>
                    <li><a href="chinhsachdoitra.html">Chính sách đổi trả</a></li>
                    <li><a href="chinhsachbaohanh.html">Chính sách bảo hành</a></li>
                    <li><a href="chinhsachgiaohang.html">Chính sách giao nhận vận chuyển</a></li>
                    <li><a href="hethongcuahang.html">Hệ thống cửa hàng </a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="others">
        <ul>
            <li class="example">
                <input type="text" placeholder="Tìm kiếm.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </li>
            <li>
                <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
            </li>
            <li class="menu-item" id="phone-menu">
                <a href="contact.html" id="contact-icon">
                    <i class="fas fa-phone"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="#"><i class="fa-solid fa-phone-volume"></i> 0372751413</a></li>
                    <li><a href="#"><i class="fa-brands fa-rocketchat"></i> Live Chat</a></li>
                    <li><a href="https://www.facebook.com/"><i class="fa-brands fa-signal-messenger"></i> Messenger</a></li>
                    <li><a href="https://mail.google.com/mail/u/0/#inbox"><i class="fa-solid fa-envelope"></i> Email</a></li>
                    <li><a href="#"><i class="fa-solid fa-right-to-bracket"></i> Tra cứu đơn hàng</a></li>
                </ul>
            </li>
            <li>
                <a href="Dangnhap.html"><i class="fas fa-user black"></i></a>
            </li>
        </ul>
    </div>
</header>
</body>
</html>
