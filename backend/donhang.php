<?php
session_start();
require_once('ketnoi.php'); // Đảm bảo file kết nối đến cơ sở dữ liệu

$order = [];
$user_info = [];
$receiver_info = [];

// Kiểm tra phiên đăng nhập
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Truy vấn thông tin từ bảng TaiKhoan
    $query_user_info = "SELECT * FROM TaiKhoan WHERE matk = '$user_id'";
    $result_user_info = mysqli_query($conn, $query_user_info);

    if ($result_user_info && mysqli_num_rows($result_user_info) > 0) {
        $user_info = mysqli_fetch_assoc($result_user_info);
    } else {
        die('Error: Không tìm thấy thông tin người dùng.');
    }

    // Truy vấn thông tin đơn hàng từ bảng Orders
    $query_order = "SELECT * FROM Orders WHERE user_id = '$user_id'";
    $result_order = mysqli_query($conn, $query_order);
    if ($result_order && mysqli_num_rows($result_order) > 0) {
        $order = mysqli_fetch_assoc($result_order);
        // Đặt thông tin người nhận
        $receiver_info = $order;
    } else {
        die('Error: Không tìm thấy thông tin đơn hàng.');
    }
} else {
    // Nếu không đăng nhập, lấy thông tin từ bảng Orders
    if (isset($_SESSION['order_id'])) {
        $order_id = $_SESSION['order_id'];
        // Truy vấn thông tin đơn hàng
        $query_order = "SELECT * FROM Orders WHERE order_id = '$order_id'";
        $result_order = mysqli_query($conn, $query_order);
        if ($result_order && mysqli_num_rows($result_order) > 0) {
            $order = mysqli_fetch_assoc($result_order);
            // Đặt thông tin người mua và người nhận giống nhau khi không đăng nhập
            $user_info = $order;
            $receiver_info = $order;
        } else {
            die('Error: Không tìm thấy thông tin đơn hàng.');
        }
    } else {
        die('Error: Không có order_id.');
    }
}

// Lấy chi tiết đơn hàng từ bảng OrderDetails
$order_details = [];
if (isset($order['order_id'])) {
    $order_id = $order['order_id'];
    $query_order_details = "SELECT od.*, p.anh, p.tensp 
                            FROM OrderDetails od
                            JOIN Product p ON od.masp = p.masp
                            WHERE od.order_id = '$order_id'";
    $result_order_details = mysqli_query($conn, $query_order_details);
    if ($result_order_details && mysqli_num_rows($result_order_details) > 0) {
        while ($row = mysqli_fetch_assoc($result_order_details)) {
            $order_details[] = $row;
        }
    } else {
        die('Error: Không tìm thấy chi tiết đơn hàng.');
    }
} else {
    die('Error: order_id không hợp lệ.');
}
?>

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
  <!-- Phần thông báo và logo -->
  <img src="../backend/img/logo.png" alt="THOITRANGVHTDT" style="width: 250px; margin-bottom: 20px;">

  <div>
    <p>Cảm ơn bạn đã đặt hàng!</p>
    <p>Nhân viên sẽ liên hệ đến số điện thoại để xác nhận <strong><?php echo ($order['so_dien_thoai']); ?></strong>. Vui lòng kiểm tra điện thoại của bạn.</p>
  </div>


  <!-- Phần thông tin người nhận hàng -->
  <div class="customer-info">
    <h4>Địa chỉ nhận hàng</h4>
    <p><strong>Tên người nhận:</strong> <?php echo $receiver_info['ten_khach_hang']; ?></p>
    <p><strong>Số điện thoại:</strong> <?php echo $receiver_info['so_dien_thoai']; ?></p>
    <p><strong>Địa chỉ chi tiết:</strong> <?php echo $receiver_info['dia_chi']; ?></p>
  </div>

  <!-- Phần chi tiết đơn hàng -->
  <div>
    <h4>Chi tiết đơn hàng</h4>
    <?php foreach ($order_details as $detail): ?>
    <div class="order-item">
      <div class="image-container">
        <img src="../admin/backend_sanpham/img/<?php echo ($detail['anh']); ?>" alt="<?php echo ($detail['tensp']); ?>">
      </div>
      <div class="details">
        <h3><?php echo ($detail['tensp']); ?></h3>
        <p><strong>Size:</strong> <?php echo ($detail['size']); ?></p>
        <p><strong>Số lượng:</strong> <?php echo ($detail['sl']); ?></p>
        <p><strong>Đơn giá:</strong> <?php echo ($detail['dongia']); ?>đ</p>
        <p><strong>Thành tiền:</strong> <?php echo ($detail['thanhtien']); ?>đ</p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Tổng cộng và nút tiếp tục mua sắm -->
  <div>
    <h3>Tổng cộng: <?php echo number_format($order['tongtien']); ?>đ</h3>
    <button class="continue-shopping-btn" onclick="location.href='index.php'">Tiếp tục mua sắm</button>
  </div>
</div>

</body>
</html>











































  <!-- Phần thông tin người mua hàng
  <div class="customer-info">
    <h4>Thông tin mua hàng</h4>
    <p><strong>Tên khách hàng:</strong> <?php echo isset($user_info['tenkh']) ? $user_info['tenkh'] : $order['ten_khach_hang']; ?></p>
    <p><strong>Số điện thoại:</strong> <?php echo isset($user_info['sdt']) ? $user_info['sdt'] : $order['so_dien_thoai']; ?></p>
    <p><strong>Địa chỉ:</strong> <?php echo isset($user_info['dc']) ? $user_info['dc'] : $order['dia_chi']; ?></p>
  </div> -->
