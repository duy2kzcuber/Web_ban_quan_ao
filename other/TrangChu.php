<?php
session_start();

$redirectUrl = "Dangnhap.html"; // Default to the login page

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $matk = $_SESSION['matk'];
    $redirectUrl = "../ThongTin/ThongTin.php";
}
else
{
    $redirectUrl = "../DangNhap/DangNhap.php";
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="./index.js"></script>
    
</head>
<body>
    
    <! -- Đây là logo menu và other -->
    <header style="background-color: rgb(253, 252, 252);" >
        <div class="logo">
            <a href="index.html">
                <img src="logo.png" alt="HVTD Logo">
            </a>
        </div>
        <div class="menu">
            <ul>
                <li class="menu-item">
                    <a href="">NAM</a>
                    <ul class="sub-menu">
                        <li><a href="cartegory.html">Hàng mới về</a></li>
                        <li><a href="">Áo</a>
                            <ul>
                                <li><a href="cartegory.html">Áo Sơ Mi Nam</a></li>
                                <li><a href="cartegory.html">Áo Polo Nam</a></li>
                                <li><a href="cartegory.html">Áo Vest Nam</a></li>
                                <li><a href="cartegory.html">Áo Len Nam</a></li>
                                <li><a href="cartegory.html">Áo khoác Nam</a></li>
                                <li><a href="cartegory.html">Áo Bomber Nam</a></li>
                            </ul>
                        </li>
                        <li><a>Quần</a>
                            <ul>
                                <li><a href="cartegory.html">Quần Jean Nam</a></li>
                                <li><a href="cartegory.html">Quần Lửng Nam</a></li>
                                <li><a href="cartegory.html">Quần Bò NAM</a></li>
                                <li><a href="cartegory.html">Quần Short Nam</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a>NỮ</a>
                    <ul class="sub-menu">
                        <li><a href="cartegory.html">Hàng mới về</a></li>
                        <li><a href="cartegory.html">Áo</a>
                            <ul>
                                <li><a href="cartegory.html">Áo Sơ Mi Nữ</a></li>
                                <li><a href="cartegory.html">Áo Polo Nữ </a></li>
                                <li><a href="cartegory.html">Áo Phông Nữ</a></li>
                                <li><a href="cartegory.html">Áo Len Nữ</a></li>
                                <li><a href="cartegory.html">Áo khoác Nữ</a></li>
                                <li><a href="cartegory.html">Áo Dài Nữ</a></li>
                            </ul>
                        </li>
                        <li><a>Quần</a>
                            <ul>
                                <li><a href="cartegory.html">Quần Jean Nữ</a></li>
                                <li><a href="cartegory.html">Quần Ống Rộng Nữ</a></li>
                                <li><a href="cartegory.html">Quần Bò Nữ</a></li>
                                <li><a href="cartegory.html">Quần Short Nữ</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a>TRẺ EM</a>
                    <ul class="sub-menu">
                        <li><a href="cartegory.html">Hàng mới về</a></li>
                        <li><a>Áo</a>
                            <ul>
                                <li><a href="cartegory.html">Áo Thun Trẻ Em</a></li>
                                <li><a href="cartegory.html">Áo Polo Trẻ Em </a></li>
                                <li><a href="cartegory.html">Áo Phông Trẻ Em</a></li>
                                <li><a href="cartegory.html">Áo Hoodie Trẻ Em</a></li>
                                <li><a href="cartegory.html">Áo Sweater Trẻ Em</a></li>
                                <li><a href="cartegory.html">Áo Dài Trẻ Em</a></li>
                            </ul>
                        </li>
                        <li><a>Quần</a>
                            <ul>
                                <li><a href="cartegory.html">Quần Jean Trẻ Em</a></li>
                        
                                <li><a href="cartegory.html">Quần Bò Trẻ Em</a></li>
                                <li><a href="cartegory.html">Quần Short Trẻ Em</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a>SALE</a>
                    <ul class="sub-menu">
                        <li><a href="cartegory.html">SALE 70%</a></li>
                        <li><a href="cartegory.html">SALE 50%</a></li>
                        <li><a href="cartegory.html">SALE 30%</a></li>
                        <li><a href="cartegory.html">SALE 10%</a></li>
                        </ul>
                        </li>
                <li class="menu-item">
                    <a href="">TRANG SỨC </a>
                    <ul class="sub-menu">
                        <li><a href="cartegory.html">Vòng Cổ</a></li>
                        <li><a href="cartegory.html">Bông Tai</a></li>
                        <li><a href="cartegory.html">Vòng Tay</a></li>
                        <li><a href="cartegory.html">Nhẫn</a></li>
                        <li><a href="cartegory.html">Dây chuyền
                        </a></li>
                        </ul>
                        </li>
                <li class="menu-item">
                    <a>COMBO</a>
                    <ul class="sub-menu">
                        <li><a href="cartegory.html">SET NAM ĐI BIỂN</a></li>
                        <li><a href="cartegory.html">SET NỮ PHONG CÁCH</a></li>
                        <li><a href="cartegory.html">SET TRẺ EM BÓNG BẢY</a></li>
                        
                        </ul>
                        </li>
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
               <a href="<?php echo htmlspecialchars($redirectUrl); ?>"><i class="fas fa-user black"></i></a>
            </li>
            </ul>
        </div>
    </header>
   

    
</body>

</html>
