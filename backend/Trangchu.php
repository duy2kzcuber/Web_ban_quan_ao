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
                <img src="img/logo.png" alt="HVTD Logo">
            </a>
        </div>
        <div class="menu">
            <ul>
            <?php
// Kết nối đến cơ sở dữ liệu
include 'admin/ketnoi.php';

// Truy vấn danh sách các danh mục từ bảng danhmuc
$query = "SELECT * FROM danhmuc";
$result = mysqli_query($conn, $query);

// Tạo mảng để lưu trữ danh mục theo danh mục cha
$categories = array();
while ($category = mysqli_fetch_assoc($result)) {
    $categories[$category['danhmuccha']][] = $category;
}
// Duyệt qua các danh mục cấp 1 (danh mục không có danh mục cha)
foreach ($categories[0] as $main_category) {
    echo '<li class="menu-item">';
    echo '<a href="#">' . $main_category['tendm'] . '</a>';
    
    // Kiểm tra xem danh mục cấp 1 có danh mục con không
    if (isset($categories[$main_category['madm']])) {
        echo '<ul class="sub-menu">';
        
        // Duyệt qua danh mục con của danh mục cấp 1
        foreach ($categories[$main_category['madm']] as $subcategory) {
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
                <a href="DangNhap/DangNhap.php"><i class="fas fa-user black"></i></a>
            </li>
            </ul>
        </div>
    </header>
    <! -- Đây là phần ảnh chạy dưới logo,other và menu -->
    <div style="margin-top:0px ;" class="slide-show">
        <div class="list-image">
            <img src="img/4.jpg" alt="Image 4">
            <img src="img/5.jpg" alt="Image 5">
            <img src="img/6.jpg" alt="Image 6">
            <img src="img/7.jpg" alt="Image 7">
        </div>
        
    </div>
    <! -- Đây là Flashsale -->
    <section style="margin-bottom: 50px;" class="home-new-prod">
    
        <div class="head">
            <h1>FLASH SALE GIỜ VÀNG - DUY NHẤT TẠI ONLINE</h1>
            <div  class="box"><p>00</p></div>  <p>:</p>
            <div  class="box"><p id="hours">00</p></div>  <p>:</p>
            <div class="box"><p id="minutes" >00</p></div>  <p>:</p>
            <div class="box"><p id="seconds" >00</p></div>  
        </div>
        <script src="index.js"></script>
        <div class="table">
            <div  class="content">
               <ul>
                <li>
                <div class="image-wrapper">
                    <img id="moda-img1" src="img/anh1.jpg" alt="">
                    <img id="moda-img2" class="img2" src="img/anh2.jpg" alt="">
                    <div class="sale-icon">-30%</div> 
                </div>
                </li>
                <li class="mau">
                   <span><img src="img/h09.png" alt=""></span>
                </li>
                <li class="description">
                    <a href="product.html" class="product-name">Đầm Dài Phối Túi Kèm Đai</a>
                    <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                </li>
                <li>1.393.000đ</li>
               </ul>
            </div>
            
            <div  class="content ">
                <ul>
                 <li>
                <div class="image-wrapper">
                     <img id="men-img1" src="img/anh3.jpg" alt="">
                     <img id="men-img2" class="img2" src="img/anh4.jpg" alt="">
                     <div class="sale-icon">-30%</div> 
                 </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h66.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Đầm Dài Phối Túi Kèm Đai </a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>1.490.000đ</li>
                </ul>
             </div>
    
             <div  class="content ">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img id="kids-img1" src="img/anh5.jpg" alt="">
                     <img id="kids-img2" class="img2" src="img/anh6.jpg" alt="">
                     <div class="sale-icon">-20%</div> 
                 </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h60.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Lụa Cổ Tàu Trụ </a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>1.650.000đ</li>
                </ul>
             </div>
    
             <!-- Thêm hai phần tử sản phẩm mới -->
             <div  class="content">
                <ul>
                 <li>
                <div class="image-wrapper">
                     <img id="moda-img3" src="img/anh7.jpg" alt="">
                     <img id="moda-img4" class="img2" src="img/anh8.jpg" alt="">
                     <div class="sale-icon">-25%</div> 
                 </div>
                 </li>
                 <li class="mau">
                    <span><img src="h09.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Quần Ống Đứng Phối Đai  </a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>1.190.000đ</li>
                </ul>
             </div>
    
             <div  class="content">
                <ul>
                 <li>
                <div class="image-wrapper">
                     <img id="moda-img5" src="img/anh9.jpg" alt="">
                     <img id="moda-img6" class="img2" src="img/anh10.jpg" alt="">
                     <div class="sale-icon">-15%</div> 
                 </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h09.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Quần Suông Ống Rộng </a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>1.790.000đ</li>
                </ul>
             </div>
        </div>
       </section>


       <! -- Đây là new arrival -->
       <section  style="margin-bottom: 50px" class="home-new-prod">
        <div class="title-section">NEW ARRIVAL</div>
        <br>
        <div class="head">
            <ul>
                <li><a href="#" class="moda-link">VHTDT GIRLS</a></li>
                <li><a href="#" class="men-link">VHTDT MENS</a></li>
                <li><a href="#" class="kids-link">VHTDT KIDS</a></li>
            </ul>
        </div>
        <div class="content">
          <div class="moda">
            <div class="moda-item">
               <ul>
                <li>
                    <div class="image-wrapper">
                    <img src="img/anh1.jpg" alt="">
                    <img class="img2" src="img/anh2.jpg" alt="">
                    </div>
                </li>
                <li class="mau">
                   <span><img src="img/h1.png" alt=""></span>
                </li>
                <li class="description">
                    <a href="product.html" class="product-name">Đầm Voan Hoa Dáng Xòe</a>
                    <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                </li>
                <li>1.490.000đ</li>
               </ul>
            </div>
            <div class="moda-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh3.jpg" alt="">
                     <img class="img2" src="img/anh4.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h2.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Đầm Hoa Xòe Tay Lỡ</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>1.790.000đ</li>
                </ul>
             </div>
    
             <div class="moda-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh5.jpg" alt="">
                     <img class="img2" src="img/anh6.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h3.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Đầm Maxi Họa Tiết
                    </a>
                    <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>1.790.000đ</li>
                </ul>
             </div>
             <div class="moda-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh7.jpg" alt="">
                     <img class="img2" src="img/anh8.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h4.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Đầm Linen Dáng Maxi</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>1.890.000đ</li>
                </ul>
             </div>
             <div class="moda-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh9.jpg" alt="">
                     <img class="img2" src="img/anh10.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h5.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Brume Dress - Đầm Tencel Bèo Nhún</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>2.290.000đ</li>
                </ul>
             </div>
             
           </div> 
           <!-- Đóng div moda -->
           <div class="men hidden">
            <div class="men-item">
               <ul>
                <li>
                    <div class="image-wrapper">
                    <img src="img/anh11.jpg" alt="">
                    <img class="img2" src="img/anh12.jpg" alt="">
                    </div>
                </li>
                <li class="mau">
                   <span><img src="img/h5.png" alt=""></span>
                </li>
                <li class="description">
                    <a href="product.html" class="product-name">Áo Thun Your Dream</a>
                    <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                </li>
                <li>375.000đ</li>
               </ul>
            </div>
            <div class="men-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh13.jpg" alt="">
                     <img class="img2" src="img/anh14.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h5.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Thun Your Dream</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>375.000đ</li>
                </ul>
             </div>
    
             <div class="men-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh15.jpg" alt="">
                     <img class="img2" src="img/anh16.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h1.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Sơ Mi Regular Tay Dài</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 <li>625.000đ</li>
                </ul>
             </div>
             <div class="men-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh17.jpg" alt="">
                     <img class="img2" src="img/anh18.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h3.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Thun Regular In Hình</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>375.000đ</li>
                </ul>
             </div>
             <div class="men-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh19.jpg" alt="">
                     <img class="img2" src="img/anh20.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h2.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Sơ Mi Regular Tay Dài</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>625.000đ</li>
                </ul>
             </div>
             
           </div> 
           <!-- Đóng div men -->
           
           <div class="kids hidden">
            <div class="kids-item">
               <ul>
                <li>
                    <div class="image-wrapper">
                    <img src="img/anh21.jpg" alt="">
                    <img class="img2" src="img/anh22.jpg" alt="">
                    </div>
                </li>
                <li class="mau">
                   <span><img src="img/h1.png" alt=""></span>
                </li>
                <li class="description">
                    <a href="product.html" class="product-name">Áo Thun Your Dream</a>
                    <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                </li>
                <li>375.000đ</li>
               </ul>
            </div>
            <div class="kids-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh23.jpg" alt="">
                     <img class="img2" src="img/anh24.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h1.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Thun Your Dream</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>375.000đ</li>
                </ul>
             </div>
             <div class="kids-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh25.jpg" alt="">
                     <img class="img2" src="img/anh26.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h1.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Thun Your Dream</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>375.000đ</li>
                </ul>
             </div>
             <div class="kids-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/anh27.jpg" alt="">
                     <img class="img2" src="img/anh28.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h1.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Thun Your Dream</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>375.000đ</li>
                </ul>
             </div>
             <div class="kids-item">
                <ul>
                 <li>
                     <div class="image-wrapper">
                     <img src="img/29.jpg" alt="">
                     <img class="img2" src="img/anh30.jpg" alt="">
                     </div>
                 </li>
                 <li class="mau">
                    <span><img src="img/h1.png" alt=""></span>
                 </li>
                 <li class="description">
                     <a href="product.html" class="product-name">Áo Thun Your Dream</a>
                     <a href="product.html" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>

                 </li>
                 <li>375.000đ</li>
                </ul>
             </div>
             
          </div>
        </div>
        <br>
        <button class="show-more">Xem tất cả</button>
       </section>

       <! -- Đây là PHẦN ẢNH Ở DƯỚI -->
       <img>
    <div class="banner-item"> <img src="img/31.jpg"></div>

    <div class = "banner">
        
        <div class = "banner-item" id="banner-1">
            <img src="img/slider1.jpg" alt="Banner 1" class="active">
            <img src="img/slider2.jpg" alt="Banner 2" class="inactive">
        </div>
        <div class = "banner-item" id = "banner-2">
            <img src="img/slider2.jpg" alt="Banner 2" class="active">
            <img src="img/slider1.jpg" alt="Banner 1" class="inactive">
        </div> 
    </div>
    <div class="gallery">
        <div class="gallery">
            <div id="gallery-header" style="font: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, 'sans-serif'">GALLERY</div>
            <div class="gallery-body">
                
                <div class="gal-item"><img src="img/gal1.jpg" alt=""> </div>
                <div class="gal-item"><img src="img/gal2.jpg" alt=""> </div>
                <div class="gal-item"><img src="img/gal3.jpg" alt=""> </div> 
                <div class="gal-item"><img src="img/gal4.jpg" alt=""> </div>
                <div class="gal-item"><img src="img/gal5.jpg" alt=""> </div>
            </div>
        </div>
    </img>
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
