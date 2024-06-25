    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="./index.js"></script>
        <title>Document</title>
    </head>
    <style>
        .page-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
    }

    .page-nav {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .page-nav__item {
        margin: 0 10px;
    }

    .page-nav__link {
        text-decoration: none;
        font-size: 18px;
        color: #000;
    }

    .page-nav__item.active .page-nav__link {
        font-weight: bold;
    }

    .mt-40 {
        margin-top: 40px;
    }

    .row {
        display: flex;
    }

    .col-ds-sidemenu {
        flex: 1;
    }

    .ds__sidemenu {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
    }

    .ds__sidemenu__title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .form-control-icon {
        display: flex;
        align-items: center;
    }

    .form-icon {
        margin-right: 10px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 24px;
        border: 1px solid #ccc;
    }

    .ds__list {
        margin-top: 20px;
    }

    .ds__province {
        margin-bottom: 20px;
    }

    .ds__province h4 {
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
    }

    .ds__item {
        display: block;
        margin-bottom: 10px;
    }

    .ds__item__input {
        display: none;
    }

    .ds__item__label {
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .ds__item__contact-info {
        display: none;
        padding: 10px;
        border: 1px solid #ccc;
        border-top: none;
        border-radius: 0 0 5px 5px;
    }

    .contact__icon {
        margin-right: 5px;
    }

    .hover-overlay:hover {
        text-decoration: underline;
    }


    </style>
    <body>
    <?php include '../headertrangchu.php';require_once 'ketnoi.php'; ?>
            <!--Day la he thong cua hang-->
            <div class="cartegory-top rowe">
            <p><a href="../backend/Trangchu.php">Trang chủ</a></p><span>&#10230;</span><p>Hệ thống cửa hàng</p>
        </div>
            <div class="banner-item">
                <img src="img/htch.jpg" alt="Banner">
            </div>
            <br><br><br><br><br>
            <h1 style="text-align: center;">HỆ THỐNG CỬA HÀNG</h1>
            <br><br>
            <div class="head">
                <ul style="margin-left: 100px;">
                    <li><a href="#" class="region-link" data-region="mien-bac">MIỀN BẮC</a></li>
                    <li><a href="#" class="region-link" data-region="mien-trung">MIỀN TRUNG</a></li>
                    <li><a href="#" class="region-link" data-region="mien-nam">MIỀN NAM</a></li>
                </ul>
            </div>
            <br><br><br>
            
            <div id="mien-bac" class="ds__sidemenu block-border block-padding">
                <h3 class="ds__sidemenu__title">Cửa hàng Miền Bắc</h3>
                <div class="ds__sidemenu__search">
                    <div class="form-group">
                        <form enctype="application/x-www-form-urlencoded" method="post" action="">
                            <div class="form-control-icon">
                                <div class="form-icon"><span class="icon-ic_search"></span></div>
                                <input id="autocomplete" style="border-radius: 24px;" class="form-control" name="shop_name" type="text" value="" placeholder="Tìm cửa hàng">
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <p>HÀ NỘI</p>
                <br>
                <span class="ds__item__label">VHTDT 186 - 188 Hoàng Quốc Việt, Cổ Nhuế, Cầu Giấy, Hà Nội </span>
                <span class="ds__item__label">VHTDT 163 Cầu Giấy, Phường Quan Hoa, Quận Cầu Giấy, Tp. Hà Nội</span>
                <span class="ds__item__label">VHTDT Tầng 3 - L3 - 01, TTTM Vincom Nguyễn Chí Thanh</span>
                <span class="ds__item__label">VHTDT 41 Thái Hà, Đống Đa, TP. Hà Nội</span>
                <span class="ds__item__label">VHTDT 143 Trần Phú, Hà Đông, TP. Hà Nội</span>
                <span class="ds__item__label">VHTDT (KHO) Số 126 Lê Trọng Tấn, La Khê, Hà Đông, TP. Hà Nội</span>
                <span class="ds__item__label">VHTDT 34 Bà Triệu, Hoàn Kiếm, TP. Hà Nội</span>
                <span class="ds__item__label">VHTDT Ô 18 BT 2 Linh Đàm, phường Hoàng Liệt, quận Hoàng Mai, Hà Nội</span>
                <span class="ds__item__label">VHTDT Tầng 1, 7 - 9 Savico Mall Long Biên, 7-9 Nguyễn Văn Linh, Long Biên, TP. Hà Nội</span>
                <span class="ds__item__label">VHTDT Lô T244 tầng 2 TTTM Aeon Mall Long Biên, Số 27 Đường Cổ Linh, P. Long Biên, Q. Long Biên, TP. Hà Nội</span>
                <br>
                <p>HẢI PHÒNG</p>
                <br>
                <span class="ds__item__label">VHTDT 40 Điện Biên Phủ, Hồng Bàng, Hải Phòng</span>
                <span class="ds__item__label">VHTDT T2-60, TTTM Aeon Lê Chân Hải Phòng, Số 10 Đường Võ Nguyên Giáp, P. Kênh Dương, Q. Lê Chân, TP. Hải Phòng</span>
                <span class="ds__item__label">VHTDT 63a Trần Nguyên Hãn, Lê Chân, Hải Phòng</span>
                <br>
                <p>BẮC GIANG</p>
                <br>
                <span class="ds__item__label">VHTDT 52 - 54 - 56 Đường Hoàng Văn Thụ, Phường Hoàng Văn Thụ, Bắc Giang</span>
                <br>
                <p>HÀ NAM</p>
                <br>
                <span class="ds__item__label">VHTDT 54 Biên Hòa, P Minh Khai, Phủ Lý</span>
                <br>
                <p>HẢI DƯƠNG</p>
                <br>
                <span class="ds__item__label">VHTDT 34 Trần Hưng Đạo, TP. Hải Dương</span>
                <br>
                <p>LẠNG SƠN</p>
                <br>
                <span class="ds__item__label">VHTDT 75 Trần Đăng Ninh, P. Tam Thanh, TP. Lạng Sơn</span>
                <br>
                <p>LÀO CAI</p>
                <br>
                <span class="ds__item__label">VHTDT 213 Hoàng Liên, Phường Cốc Lếu, Thành phố Lào Cai, Lào Cai</span>
                <br>
                <p>NAM ĐỊNH</p>
                <br>
                <span class="ds__item__label">VHTDT 114 - 116 Trần Hưng Đạo, Nam Định, Nam Định</span>
                <br>
                <p>NINH BÌNH</p>
                <br>
                <span class="ds__item__label">VHTDT Số 7 đường Lê Hồng Phong, Phường Vân Giang, TP Ninh Bình, Tỉnh Ninh Bình</span>
                <br>
                <p>PHÚ THỌ</p>
                <br>
                <span class="ds__item__label">VHTDT 2069-2071 Đại Lộ Hùng Vương, Tp Việt Trì, tỉnh Phú Thọ</span>
                <br>
                <p>QUẢNG NINH</p>
                <br>
                <span class="ds__item__label">VHTDT SH18 Trần Hưng Đạo Plaza, TP Hạ Long, Quảng Ninh</span>
                <br>
                <p>SƠN LA</p>
                <br>
                <span class="ds__item__label">VHTDT 97 Trường Chinh, P. Quyết Thắng, TP. Sơn La</span>
                <br>
                <p>THÁI BÌNH</p>
                <br>
                <span class="ds__item__label">VHTDT 404 Lý Bôn (gần bến xe Thái Bình), P. Trần Hưng Đạo, TP. Thái Bình, Thái Bình</span>
                <br>
                <p>THANH HÓA</p>
                <br>
                <span class="ds__item__label">VHTDT Lô A28-A29 Vincom Shophouse Thanh Hóa, Đường Lê Hoàn, Phường Điện Biên, TP Thanh Hóa</span>
                <br>
                <p>TUYÊN QUANG</p>
                <br>
                <span class="ds__item__label">VHTDT 225 đường Quang Trung, phường Tân Quang, TP. Tuyên Quang (Ngã Tư đèn xanh đèn đỏ - DỐC DƯỢC)</span>
                <br>
                <p>VĨNH YÊN</p>
                <br>
                <span class="ds__item__label">VHTDT 189 Mê Linh, P. Liên Bảo, TP. Vĩnh Yên</span>
            </div>
            
            <div id="mien-trung" class="ds__sidemenu block-border block-padding">
                <h3 class="ds__sidemenu__title">Cửa hàng Miền Trung</h3>
                <br>
    <p>ĐÀ NẴNG</p>
    <span class="ds__item__label">VHTDT L3 - 07 Tầng 3, TTTM Vincom Đà Nẵng, 910A Ngô Quyền, An Hải Bắc, Sơn Trà, Đà Nẵng</span>
    <span class="ds__item__label">VHTDT 164 Điện Biên Phủ, Q. Thanh Khê, Đà Nẵng</span>
    <span class="ds__item__label">VHTDT 180 - 182 Nguyễn Văn Linh, Thanh Khê, Đà Nẵng</span>
    <br>
    <p>GIA LAI</p>
    <span class="ds__item__label">VHTDT 199 - 201 Hùng Vương, Phường Hội Thương, TP Pleiku, tỉnh Gia Lai, Việt Nam</span>
    <br>
    <p>HÀ TĨNH</p>
    <span class="ds__item__label">VHTDT 27 Phan Đình Phùng, P. Bắc Hà, TP. Hà Tĩnh</span>
    <br>
    <p>HỘI AN</p>
    <span class="ds__item__label">VHTDT 177 Lý Thường Kiệt, P. Cẩm Phô, TP Hội An, Quảng Nam</span>
    <br>
    <p>HUẾ</p>
    <span class="ds__item__label">VHTDT 78 Bà Triệu, Phường Phú Hội, TP Huế, Tỉnh Thừa Thiên Huế</span>
    <br>
    <p>NGHỆ AN</p>
    <span class="ds__item__label">VHTDT 66 Nguyễn Văn Cừ, TP Vinh, Tỉnh Nghệ An</span>
    <br>
    <p>NHA TRANG</p>
    <span class="ds__item__label">VHTDT 46 - 48 Lý Thánh Tôn, P. Phương Sài, TP. Nha Trang, Khánh Hòa</span>
    <br>
    <p>TUY HÒA</p>
    <span class="ds__item__label">VHTDT L1 06 - 08 Tầng 1, TTTM Vincom Plaza Tuy Hòa, Đường Hùng Vương, Phường 7, Thành Phố Tuy Hòa, Tỉnh Phú Yên</span>
    <br>
    <p>QUY NHƠN</p>
    <span class="ds__item__label">VHTDT 455 - 457 Trần Hưng Đạo, TP. Quy Nhơn, Tỉnh Bình Định</span>
    <br>
    <p>QUẢNG NGÃI</p>
    <span class="ds__item__label">VHTDT số 35 Hùng Vương, Phường Trần Hưng Đạo, TP Quảng Ngãi, Quảng Ngãi</span>

            </div>
            
            <div id="mien-nam" class="ds__sidemenu block-border block-padding">
                <h3 class="ds__sidemenu__title">Cửa hàng Miền Nam</h3>
                <br>
    <p class="city">Hồ Chí Minh</p>
    <span class="ds__item__label">VHTDT 12 - 14 Quang Trung, P10, Gò Vấp, thành phố Hồ Chí Minh</span>
    <span class="ds__item__label">VHTDT (KHO) Số 1/7 đường số 33, Phường An Khánh, TP. Thủ Đức - TP HCM.</span>
    <span class="ds__item__label">VHTDT 142 Võ Thị Sáu, Quận 3, TP.HCM</span>
    <span class="ds__item__label">VHTDT 248 Nguyễn Thị Thập, P. Tân Quy, Quận 7, TP.HCM</span>
    <span class="ds__item__label">VHTDT TTTM Vincom Plaza, 50 Lê Văn Việt, Phường Hiệp Phú, Quận 9, Da Kao, TP.HCM</span>
    <span class="ds__item__label">VHTDT 676 Lũy Bán Bích, Tân Thành, Tân Phú, Thành phố Hồ Chí Minh ĐÂY LÀ MIỀN NAM</span>
    <br>
    <p class="city">An Giang</p>
    <span class="ds__item__label">VHTDT L1 – 04 +05A Vincom Long Xuyên, 1242 Trần Hưng Đạo, P. Mỹ Bình, Tp. Long Xuyên, Long Xuyên, An Giang</span>
    <br>
    <p class="city">Bà Rịa Vũng Tàu</p>
    <span class="ds__item__label">VHTDT 244 Ba Cu, Phường 3, Thành phố Vũng Tầu, Bà Rịa - Vũng Tàu</span>
    <br>
    <p class="city">Bình Dương</p>
    <span class="ds__item__label">VHTDT 315 Đại lộ Bình Dương, Ph. Chánh Nghĩa, TP. Thủ Dầu 1, Bình Dương</span>
    <br>
    <p class="city">Bình Phước</p>
    <span class="ds__item__label">VHTDT 1083 Phú Riềng Đỏ, P. Tân Thiện, Đồng Xoài, Bình Phước</span>
    <br>
    <p class="city">Cần Thơ</p>
    <span class="ds__item__label">VHTDT 126 Đường 30 Tháng 4, Hưng Lợi, Ninh Kiều, Cần Thơ</span>
    <br>
    <p class="city">Đắk Lắk</p>
    <span class="ds__item__label">VHTDT 26-28-30 Phan Chu Trinh - P.Thắng Lợi - TP Buôn Ma Thuột - Đắk Lắk</span>
    <br>
    <p class="city">Đồng Nai</p>
    <span class="ds__item__label">VHTDT (BI1) Tầng L2-10-11, Vincom Plaza Biên Hòa, 1096, Phạm Văn Thuận, P. Tân Mai, Thành phố Biên Hòa, T. Đồng Nai</span>
    <span class="ds__item__label">VHTDT (BI3) 46 Võ Thị Sáu, Khu phố 7, Phường. Thống Nhất, TP. Biên Hòa, Đồng Nai</span>
    <br>
    <p class="city">Đồng Tháp</p>
    <span class="ds__item__label">VHTDT L1 - 09 Vincom Cao Lãnh, 30/4 Phường 1, TP.Cao Lãnh, Đồng Tháp</span>
    <br>
    <p class="city">Sóc Trăng</p>
    <span class="ds__item__label">VHTDT 189 Hùng Vương phường 6 TP Sóc Trăng</span>
    <br>
    <p class="city">Tây Ninh</p>
    <span class="ds__item__label">VHTDT 724 Cách Mạng Tháng Tám, Phường 3, Thành Phố Tây Ninh, Tỉnh Tây Ninh, Tây

            </div>
            
            


            











        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr>
        <br>
        <br>

        <br>
    
        <!--Day la phan lien he khach hang-->
        <?php include '../footertrangchu.php'; ?>
    </body>
    </html>