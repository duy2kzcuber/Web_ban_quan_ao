<?php
// Bắt đầu session nếu chưa tồn tại
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kết nối CSDL
require_once 'ketnoi.php';

// Khai báo hàm lấy danh mục sản phẩm
function fetchCategories($conn) {
    $query_categories = "SELECT * FROM danhmuc";
    $result_categories = mysqli_query($conn, $query_categories);
    $categories = array();
    while ($category = mysqli_fetch_assoc($result_categories)) {
        $categories[$category['danhmuccha']][] = $category;
    }
    return $categories;
}
?>

<header style="background-color: rgb(253, 252, 252);">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="HVTD Logo">
        </a>
    </div>
    <div class="menu">
        <ul>
            <?php
            // Sử dụng hàm lấy danh mục sản phẩm
            $categories = fetchCategories($conn);

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
                    <li><a href="../frontend/tuvansize.php">Tư vấn size</a></li>
                    <li><a href="../frontend/chinhsachdieukhoan.php">Chính sách điều khoản</a></li>
                    <li><a href="../frontend/huongdanmuahang.php">Hướng dẫn mua hàng</a></li>
                    <li><a href="../frontend/chinhsachthanhtoan.php">Chính sách thanh toán</a></li>
                    <li><a href="../frontend/chinhsachdoitra.php">Chính sách đổi trả</a></li>
                    <li><a href="../frontend/chinhsachbaohanh.php">Chính sách bảo hành</a></li>
                    <li><a href="../frontend/chinhsachgiaohang.php">Chính sách giao nhận vận chuyển</a></li>
                    <li><a href="../frontend/hethongcuahang.php">Hệ thống cửa hàng </a></li>
                </ul>
            </li>
            <li class="menu-item">
                <a>VỀ CHÚNG TÔI</a>
                <ul class="sub-menu">
                    
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
                <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
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
                    <li><a href="../backend/timkiemdonhang.php"><i class="fa-solid fa-right-to-bracket"></i> Tra cứu đơn hàng</a></li>
                </ul>
            </li>
            <li>
            <a href="../backend/ThongTin.php"><i class="fas fa-user black"></i></a>
            </li>
        </ul>
    </div>
</header>
