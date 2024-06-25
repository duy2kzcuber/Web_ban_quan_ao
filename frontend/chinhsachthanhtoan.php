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
  .chinhsachthanhtoan{
    max-width: 1000px; /* Increase the maximum width */
    width: 80%; /* Set a percentage width */
    padding: 0 20px; /* Add padding for spacing */
    margin: 0 auto; /* Center the element horizontally */
}

        .image-container {
            flex: 1;
            text-align: center;
        }
        .text-container {
            flex: 1;
            padding: 0 20px;
            
        }
        .btn{
            width: 120px;
            
        }

  

</style>
<body>
<?php include '../headertrangchu.php';require_once 'ketnoi.php'; ?>
        <!--Day la phan chinh sach thanh toan-->
        <div class="cartegory-top rowe">
            <p><a href="../backend/Trangchu.php">Trang chủ</a></p><span>&#10230;</span><p>Chính sách thanh toán</p>
        </div>
        <div class="banner-item"> <img src="img/cstt.jpg"></div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1 style="text-align: center;">CHÍNH SÁCH THANH TOÁN </h1>
<br><br><br>


<div class="chinhsachthanhtoan">
    <h1>CHÍNH SÁCH THANH TOÁN</h1>
    <p>Có 2 hình thức thanh toán khi mua hàng online tại IVY moda:</p>
    <ul>
        <li><strong>Hình thức thu tiền tận nơi (COD):</strong> Khách hàng sẽ thanh toán tiền khi nhận hàng và thanh toán tiền hàng và cước phí vận chuyển cho nhân viên chuyển phát.</li>
        <li><strong>Thanh toán trực tuyến OnePay:</strong> qua thẻ ATM nội địa hoặc thẻ quốc tế trực tiếp tại website.</li>
    </ul>

    <h2>Câu hỏi thường gặp</h2>
    <h3>Tại sao thẻ tín dụng của tôi có thể bị từ chối?</h3>
    <p>Thẻ tín dụng của quý khách có thể bị từ chối vì bất kỳ lý do nào sau đây:</p>
    <ul>
        <li>Thẻ có thể đã hết hạn. Kiểm tra xem thẻ của quý khách còn hiệu lực không.</li>
        <li>Quý khách có thể đã đạt đến hạn mức tín dụng. Liên hệ với ngân hàng để kiểm tra xem quý khách có vượt quá giới hạn mua hàng được ủy quyền không.</li>
        <li>Quý khách có thể đã nhập thông tin nào đó không chính xác. Kiểm tra xem quý khách đã điền đúng tất cả các trường bắt buộc chưa.</li>
    </ul>

    <h3>Tôi có thể đưa thông tin chi tiết của công ty mình vào hóa đơn không?</h3>
    <p>Có. Chỉ cần nhấp vào tùy chọn doanh nghiệp trong thông tin chi tiết cá nhân rồi điền thông tin thuế mà chúng tôi yêu cầu.</p>

    <h3>Có an toàn khi sử dụng thẻ tín dụng của tôi trên trang web không?</h3>
    <p>Đúng, các dữ liệu được truyền đi bằng cách mã hóa theo giao thức SSL. Đối với việc thanh toán bằng thẻ tín dụng và thẻ ghi nợ, yêu cầu phải nhập số CVV (Card Verification Value, Mã Xác thực Thẻ), là mã số in trên thẻ được sử dụng như một biện pháp bảo mật trong các giao dịch thương mại điện tử.</p>
        </div>




        <br><br><br>
        <div class="container">
            <div class="image-container">
                <img src="img/hdmh.jpg" alt="IVY moda">
            </div>
            <div class="text-container">
                <h2>Đồng hành cùng IVY moda</h2>
                <p>Cảm ơn bạn đã yêu thích sản phẩm và đồng hành cùng IVY moda.</p>
                <p>Mọi thắc mắc liên quan đến chính sách thanh toán, vui lòng liên hệ theo số thông tin bên dưới:</p>
                <p>Hotline: 0372751413</p>
                <button type="button" class="btn">GỌI NGAY: 0372751413</button>
            </div>
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