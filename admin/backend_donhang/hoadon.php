<?php
require_once '../ketnoi.php'; // Đường dẫn tương đối đến file kết nối

if (!isset($_GET['order_id'])) {
    echo "Không tìm thấy mã đơn hàng.";
    exit;
}

$order_id = $_GET['order_id'];

// Truy vấn thông tin đơn hàng
$order_sql = "SELECT * FROM orders WHERE order_id = $order_id";
$order_result = mysqli_query($conn, $order_sql);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    echo "Không tìm thấy đơn hàng.";
    exit;
}

// Truy vấn chi tiết đơn hàng
$order_details_sql = "SELECT * FROM orderdetails WHERE order_id = $order_id";
$order_details_result = mysqli_query($conn, $order_details_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Hóa Đơn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">THỜI TRANG VHTDT</h2>
        <br>
        <h4 class="text-center">HÓA ĐƠN THANH TOÁN</h4>
       
        <hr>
        <p><strong>Mã đơn hàng:</strong> <?php echo $order['order_id']; ?></p>
        <p><strong>Tên khách hàng:</strong> <?php echo $order['ten_khach_hang']; ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo $order['so_dien_thoai']; ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo $order['dia_chi']; ?></p>
        <p><strong>Ngày đặt hàng:</strong> <?php echo $order['ngay_dat_hang']; ?></p>
        <p><strong>Ngày nhận hàng:</strong> <?php echo $order['ngay_nhan_hang']; ?></p>
        <p><strong>Phương thức thanh toán:</strong> <?php echo $order['pttt']; ?></p>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($detail = mysqli_fetch_assoc($order_details_result)) { ?>
                    <tr>
                        <td><?php echo $detail['tensp']; ?></td>
                        <td><?php echo $detail['sl']; ?></td>
                        <td><?php echo $detail['dongia']; ?> VNĐ</td>
                        <td><?php echo $detail['thanhtien']; ?> VNĐ</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Tổng tiền:</strong></td>
                    <td><?php echo $order['tongtien']; ?> VNĐ</td>
                </tr>
            </tbody>
        </table>
        <h3 class="text-center">Cảm ơn quý khách đã tham gia mua hàng,</h3>
        <button onclick="window.print()" class="btn btn-primary no-print">In Hóa Đơn</button>
        <a href="javascript:history.back()" class="btn btn-secondary no-print">Quay lại</a>
    </div>
</body>
</html>
