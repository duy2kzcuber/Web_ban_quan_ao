
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đơn hàng của khách</title>
<style>
  /* Reset CSS */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  /* CSS cho form và các mục đơn hàng */
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .order-container {
    width: 80%; /* Độ rộng của phần container */
    background-color: #f9f9f9; /* Màu nền */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    overflow: hidden; /* Tránh nội dung rò rỉ */
    padding: 20px;
    margin: auto; /* Để căn giữa nội dung */
    text-align: center; /* Căn giữa nội dung trong container */
  }

  .order-item {
    display: flex;
    padding: 15px;
    border-bottom: 1px solid #eee;
    align-items: center; /* Căn các phần tử trong order-item theo chiều dọc */
  }

  .order-item:last-child {
    border-bottom: none; /* Không có đường viền dưới cùng */
  }

  .image-container {
    flex: 0 0 100px; /* Kích thước cố định cho hình ảnh */
    margin-right: 15px;
    overflow: hidden; /* Giữ cho hình ảnh không tràn ra */
  }

  .image-container img {
    width: 100%;
    height: auto;
    border-radius: 4px;
  }

  .details {
    flex: 1; /* Phần còn lại của đơn hàng */
    text-align: left; /* Căn trái nội dung trong details */
  }

  .details h3 {
    margin-bottom: 5px;
    font-size: 18px;
    color: #333;
  }

  .details p {
    margin-bottom: 8px;
    color: #666;
  }

  .status {
    display: flex;
    align-items: center;
    justify-content: center; /* Căn giữa phần status */
    flex-direction: column; /* Để các phần tử trong status sắp xếp theo chiều dọc */
  }

  .status-text {
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
  }

  .cancel-btn {
    background-color: #ff5252;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .cancel-btn:hover {
    background-color: #e04141; /* Màu khi di chuột qua */
  }

  .continue-shopping-btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
  }

  .continue-shopping-btn:hover {
    background-color: #0056b3; /* Màu khi di chuột qua */
  }

  /* Phần thông tin khách hàng */
  .customer-info {
    margin-top: 30px;
    text-align: left;
  }

  .customer-info h4 {
    margin-bottom: 10px;
    font-size: 16px;
    color: #333;
  }

  .customer-info p {
    margin-bottom: 8px;
    color: #666;
  }
</style>
</head>
<body>

<div class="order-container">
  <img src="../backend/img/logo.png" alt="Logo DolaStyle" style=" width: 250px; margin-bottom: 20px;">

  <div>
    <p>Cảm ơn bạn đã đặt hàng!</p>
    <pd>Nhân viên sẽ gọi điện đến số điện thoại để xác nhận <strong>142342545</strong>. Vui lòng kiểm tra điện thoại của bạn.</p>
  </div>
  <div class="customer-info">
    <h4>Thông tin mua hàng</h4>
    <p><strong>Tên khách hàng:</strong> Phạm Tuệ</p>
    <p><strong>Số điện thoại:</strong> +84832403597</p>
    <p><strong>Địa chỉ</strong>abc</p>
  </div>

  <div class="customer-info">
    <h4>Địa chỉ nhận hàng</h4>
    <p><strong>Tên người nhận:</strong> Phạm Tuệ</p>
    <p><strong>Số điện thoại:</strong> +84832403597</p>
    <p><strong>Địa chỉ chi tiết:</strong> Xã Ea Tiêu, Huyện Cư Kuin, Đắk Lắk</p>
  </div>

  <div class="order-item">
    <div class="image-container">
      <img src="product1.jpg" alt="Product 1">
    </div>
    <div class="details">
      <h3>ĐẦM THUN TAY LOE CUT OUT</h3>
      <p>Màu sắc: Xanh nhạt / Size: S</p>
      <p>Giá sản phẩm: 299.000đ</p>
      <p>Phí vận chuyển: 40.000đ</p>
      <p><strong>Tổng cộng: 339.000đ</strong></p>
    </div>
   
    
  <button type="button" class="continue-shopping-btn">Tiếp tục mua hàng</button>
</div>

</body>
</html>
