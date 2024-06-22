<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HVTDT.shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <script src="index.js"></script>
    
</head>
<?php 
    session_start();
    require_once './admin/ketnoi.php';
    if (isset($_POST['add_to_cart'])) {
        // Tạo mảng sản phẩm mới từ dữ liệu POST
        $new_product = array(
            'masp' => $_POST['masp'],
            'tensp' => $_POST['tensp'],
            'gia' => $_POST['gia'],
            'mausac' => $_POST['mausac'],
            'anh' =>  $_POST['anh'],
            'soluong' => $_POST['soluong']
        );

        if (isset($_SESSION['cart'])) {
            $session_array_id = array_column($_SESSION['cart'], "masp");
            if (in_array($_POST['masp'], $session_array_id)) {
                // TH1: Sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($value['masp'] == $_POST['masp']) {
                        $_SESSION['cart'][$key]['soluong'] += $_POST['soluong'];
                        break; // Thoát vòng lặp sau khi tìm thấy và cập nhật sản phẩm
                    }
                }
            } 
            else {
                // TH2: Sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
                $_SESSION['cart'][] = $new_product;
            }
        } else {
            // Giỏ hàng ko tồn tại, tạo giỏ hàng mới và thêm sản phẩm
            $_SESSION['cart'] = array($new_product);
        }
    }
    if(isset($_GET['action'])){
        if($_GET['action'] == "clearall"){
            unset($_SESSION['cart']);
            
        }
        if($_GET['action'] == "remove"){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['masp'] == $_GET['masp']){
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
         header('Location: cart.php');
    }
    global $tong; // luu tong gia tri don hang
     
    function hienThi_left(){
        $sum = 0; global $tong;
        $output = "";
        $output .= "
            <table class = 'table table-bordered table-striped'>
                <tr>
                     <th>Mã sản phẩm</th>
                     <th>Tên sản phẩm</th>
                     <th>Hình ảnh</th>
                     <th>Giá</th>
                     <th>Số lượng</th>
                     <th>Màu</th>
                     <th>Tổng giá tiền</th>
                    <th>Trạng thái</th>
                 </tr>
            
        ";
        if(!empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key => $value){

                 $output .= "
                <tr>
                    <td>".$value['masp']."</td>
                    <td>".$value['tensp']."</td>
                    <td><img src='admin/backend_sanpham/img/".$value['anh']."' alt='".$value['tensp']."' style='width:50px;height:50px;'></td>
                    <td>".number_format($value['gia'])."</td>
                    <td>".$value['soluong']."</td>
                    <td>".$value['mausac']."</td>
                    <td>".number_format($value['gia'] * $value['soluong']). " VND</td>
                    <td> 
                         <a href='cart.php?action=remove&masp=".$value['masp']."'>
                            <button class = 'btn'>Xóa</button>
                        </a>
                    </td>
                 </tr>
                 ";
                 $sum += $value['gia'] * $value['soluong'] ;
            }
            $tong = $sum;
        }
        $output .= "</table>";
        echo $output;
    }   
    function hienThi_right(){
        global $tong;
        $output = "
        <table>
            <tr></b> Tổng giá tiền</b></tr>
            <tr>".number_format($tong)." VNĐ</tr>
            <tr>
                <a href ='cart.php?action=clearall'>
                    <button class ='btn btn-warning' '> Xóa toàn bộ giỏ hàng</button>
                </a>
            </tr>
            <tr>
                <a href ='cart.php'>
                    <button class ='btn btn-warning' '> Mua hàng</button>
                    </a>           
                </tr>
        </table>
        ";
        echo $output;
        
    }
?>

<body>

    <! -- Đây là logo menu và other -->
    <header style="background-color: rgb(253, 252, 252);" >
        <div class="logo">
            <a href="index.html">
                <img src="img/logo.png" alt="HVTD Logo">
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
                <a href="Dangnhap.html"><i class="fas fa-user black"></i></a>
            </li>
            </ul>
        </div>
    </header>

    <br>
    <section class="cart">
      
        
        <div class="container">
            <div class="cart-content row">
                <div class="cart-content-left">
                    <div class="container-fluid" style="justify-content: center!important;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="text-center" style="text-align: center;">GIỎ HÀNG</h2>  
                                            <?php hienThi_left(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                <div class="cart-content-right">
                    <?php hienThi_right()?>
                </div>
            </div>
        </div>
    </section>
 


    <br>
    <br>
    <br>
    
    <hr>
    <br>
    <br>
    <br>
    <!-- phần foooter -->
    <footer>

        <div class="container">
            <div class="footer_content">
                <img src="img/logo-footer.png" alt="">
                <img src="img/dmca_protected_16_120.png" alt="">
                <img src="img/img-congthuong.png" alt="">
                <br>
                <div class="icon">
                    <li><i class='bx bxl-facebook-circle'></i></li>
                    <li><i class='bx bxl-google'></i></li>               
                    <li><i class='bx bxl-instagram'></i></li>
                    <li><i class='bx bxl-pinterest' ></i></li>
                    <li><i class='bx bxl-youtube' ></i></li>
                </div>
                <div class="hotline">HOTLINE:0123456789</div>
               
            </div>
            <div class="footer_content">
                <h3>Giới thiệu</h3>
                <ul>
                    <li><a href="gioithieu.html">Về HVTDT </a></li>
                    <li><a href="">Tuyển dụng</a></li>
                    
                </ul>
            </div>
            <div class="footer_content">
                <h3>Dịch Vụ Khách Hàng</h3>
                <li><a href="chinhsachdieukhoan.html">Chính sách điểu khoản </a></li>
                <li><a href="huongdanmuahang.html">Hướng dẫn mua hàng</a></li>
                <li><a href="chinhsachthanhtoan.html">Chính sách thanh toán</a></li>
                <li><a href="chinhsachdoitra.html">Chính sách đổi trả</a></li>
                <li><a href="chinhsachbaohanh.html">Chính sách bảo hành</a></li>
                <li><a href="chinhsachgiaohang.html">Chính sách giao nhận vận chuyển</a></li>
                <li><a href="chinhsachnhanvien.html">Chính sách trẻ thành viên</a></li>
                <li><a href="hethongcuahang.html">Hệ thống cửa hàng</a></li>
                <li><a href="QnA.html">Q&A</a></li>             
            </div>
            <div class="footer_content">
                 
                <h3>Liên Hệ</h3>
                <ul>
                <li><a href="">Hotline:19001912</a></li>
                <li><a href="">Email:vhtdt12@gmail.com</a></li>
                <li><a href="">Live chat</a></li>
                <li><a href="">Messenger</a></li>
                <li><a href="lienhe.html">Liên Hệ</a></li>
                </ul>
            </div>

            <div class="footer_content">
                <div class="content3">
                   <div class="boder">
                    <h3>Nhận thông tin các <br>chương trình của VHTDT</h3>
                    <input type="text" name="" id="" placeholder="Nhập email" style="border: none; color: black;">
                    <button type="submit" style="color: #6C6D70; border: 1px solid black;">Đăng kí</button>
                    <hr style="width: 70%; color: black;">
                   </div>


                    <h3 style="color: black; float: left; width: 80%  ;" class="h3_1">Download App</h3>
                   <div class="content4">
                    <a href=""><img src="img/appstore.png" alt="" ></a> <br>
                   <a href=""><img src="img/googleplay.png" alt=""></a>
                   <br>
                   </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="bottom_bar" >
           <p> ©IVYmoda All rights reserved</p>
        </div>
    </footer>

    
</body>

</html>
