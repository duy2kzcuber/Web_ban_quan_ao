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
<?php include '../headertrangchu.php'; ?>


    <! -- Đây là phần ảnh chạy dưới logo,other và menu -->
    <div style="margin-top:0px ;" class="slide-show">
        <div class="list-image">
            <img src="img/show1.webp" alt="Image 4">
            <img src="img/show2.webp" alt="Image 5">
            <img src="img/6.jpg" alt="Image 6">
            <img src="img/7.jpg" alt="Image 7">
        </div>
        
    </div>
    <! -- Đây là Flashsale -->
    <section style="margin-bottom: 50px;" class="home-new-prod">

<div class="head">
    <h1>FLASH SALE GIỜ VÀNG - DUY NHẤT TẠI ONLINE</h1>
    <div class="box"><p>00</p></div>  <p>:</p>
    <div class="box"><p id="hours">00</p></div>  <p>:</p>
    <div class="box"><p id="minutes">00</p></div>  <p>:</p>
    <div class="box"><p id="seconds">00</p></div>
</div>

<?php
// Kết nối cơ sở dữ liệu
require_once 'ketnoi.php';

// Câu lệnh truy vấn để lấy các sản phẩm có danhmuccha là SALE và lấy tendm của danhmuccha đó
$lietke_sql = "
    SELECT p.*, d.tendm
    FROM product p
    JOIN danhmuc d ON p.madm = d.madm
    WHERE d.danhmuccha = 'SALE'
    ORDER BY p.masp, p.tensp
";

// Thực thi câu lệnh truy vấn
$result = mysqli_query($conn, $lietke_sql);

// Lấy tất cả dữ liệu vào mảng
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Hàm lấy một đoạn sản phẩm
function getProductChunk($products, $start, $length = 5) {
    return array_slice($products, $start, $length);
}
?>

<div class="table">
<?php foreach (getProductChunk($products, 0, 5) as $r) { ?>
    <div class="content">
        <ul>
            <li>
                <div class="image-wrapper">
                    <img src="../admin/backend_sanpham/img/<?php echo $r['anh']; ?>" alt="">
                    <img id="moda-img2" class="img2" src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>" alt="">
                    <div class="sale-icon"><?php echo $r['tendm']; ?></div>
                </div>
            </li>
            <li class="description">
                <a href="product.php?masp=<?php echo $r['masp']; ?>" class="product-name"><?php echo $r['tensp']; ?></a>
                <a href="product.php?masp=<?php echo $r['masp']; ?>" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>
            </li> 
            <li><?php echo number_format($r['gia']); ?>đ</li>
        </ul>
    </div>
<?php } ?>
</div>
</section>



<! -- Đây là new arrival -->
<section style="margin-bottom: 50px" class="home-new-prod">
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
            <?php
            $query_girls = "SELECT p.*, d.tendm
                            FROM product p
                            JOIN danhmuc d ON p.madm = d.madm
                            WHERE d.danhmuccha = 'NỮ'
                            LIMIT 5";
            $result_girls = mysqli_query($conn, $query_girls);
            while ($r = mysqli_fetch_assoc($result_girls)) {
            ?>
                <div class="moda-item">
                    <ul>
                        <li>
                            <div class="image-wrapper">
                                <img src="../admin/backend_sanpham/img/<?php echo $r['anh']; ?>" alt="">
                                <img class="img2" src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>" alt="">
                            </div>
                        </li>
                        <li class="description">
                            <a href="product.php?masp=<?php echo $r['masp']; ?>" class="product-name"><?php echo $r['tensp']; ?></a>
                            <a href="product.php?masp=<?php echo $r['masp']; ?>" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>
                        </li>
                        <li><?php echo number_format($r['gia']); ?>đ</li>
                    </ul>
                </div>
            <?php } ?>
        </div>

        <div class="men hidden">
            <?php
            // Query to fetch 5 products from category with danhmuccha 'NAM'
            $query_mens = "SELECT p.*, d.tendm
                           FROM product p
                           JOIN danhmuc d ON p.madm = d.madm
                           WHERE d.danhmuccha = 'NAM'
                           LIMIT 5";
            $result_mens = mysqli_query($conn, $query_mens);
            while ($r = mysqli_fetch_assoc($result_mens)) {
            ?>
                <div class="men-item">
                    <ul>
                        <li>
                            <div class="image-wrapper">
                                <img src="../admin/backend_sanpham/img/<?php echo $r['anh']; ?>" alt="">
                                <img class="img2" src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>" alt="">
                            </div>
                        </li>
                        <li class="description">
                            <a href="product.php?masp=<?php echo $r['masp']; ?>" class="product-name"><?php echo $r['tensp']; ?></a>
                            <a href="product.php?masp=<?php echo $r['masp']; ?>" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>
                        </li>
                        <li><?php echo number_format($r['gia']); ?>đ</li>
                    </ul>
                </div>
            <?php } ?>
        </div>

        <div class="kids hidden">
            <?php
            $query_kids = "SELECT p.*, d.tendm
                           FROM product p
                           JOIN danhmuc d ON p.madm = d.madm
                           WHERE d.danhmuccha = 'TRẺ EM'
                           LIMIT 5";
            $result_kids = mysqli_query($conn, $query_kids);
            while ($r = mysqli_fetch_assoc($result_kids)) {
            ?>
                <div class="kids-item">
                    <ul>
                        <li>
                            <div class="image-wrapper">
                                <img src="../admin/backend_sanpham/img/<?php echo $r['anh']; ?>" alt="">
                                <img class="img2" src="../admin/backend_sanpham/anhmota/<?php echo $r['anhmt1']; ?>" alt="">
                            </div>
                        </li>
                        <li class="description">
                            <a href="product.php?masp=<?php echo $r['masp']; ?>" class="product-name"><?php echo $r['tensp']; ?></a>
                            <a href="product.php?masp=<?php echo $r['masp']; ?>" class="cart-icon"><i class="fa-solid fa-cart-shopping icon-white"></i></a>
                        </li>
                        <li><?php echo number_format($r['gia']); ?>đ</li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
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
    <?php include '../footertrangchu.php'; ?>

    
</body>

</html>
