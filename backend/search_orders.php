<?php
require_once 'ketnoi.php'; // Đường dẫn tương đối đến file kết nối

session_start();
$GLOBALSsdt;
$sdt = $_POST['phone_number'];

// Truy vấn danh sách đơn hàng
$lietke_sql = "SELECT * FROM orders WHERE so_dien_thoai = $sdt";
$result = mysqli_query($conn, $lietke_sql);

if (!$result) {
    echo "Lỗi truy vấn: " . mysqli_error($conn);
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LỊCH SỬ ĐẶT HÀNG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div class="container">
    <h1>LỊCH SỬ ĐẶT HÀNG</h1>
    <div class="row mt-3">
            <div class="col-md-12">
                <button onclick="window.location.href='Trangchu.php'" class="btn btn-primary">TRANG CHỦ</button>
                <button onclick="window.location.href='cart.php'" class="btn btn-primary">GIỎ HÀNG</button>
            </div>
        </div>
    <table class="table table-dark mt-3">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tên KH</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt</th>
                <th>Ngày nhận(dự kiến)</th>
                <th>Trạng thái</th>
                <th>Phương thức TT</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($r = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $r['order_id']; ?></td>
                    <td><?php echo $r['ten_khach_hang']; ?></td>
                    <td><?php echo $r['so_dien_thoai']; ?></td>
                    <td><?php echo $r['dia_chi']; ?></td>
                    <td><?php echo $r['ngay_dat_hang']; ?></td>
                    <td><?php echo $r['ngay_nhan_hang']; ?></td>
                    <td><?php echo $r['trangthai']; ?></td>
                    <td><?php echo $r['pttt']; ?></td>
                    <td><?php echo $r['tongtien']; ?> VNĐ</td>
                    <td>
                        <a href="Chitietdonhang.php?order_id=<?php echo $r['order_id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="in_hoa_don.php?order_id=<?php echo $r['order_id']; ?>" class="btn btn-primary"><i class="fas fa-print"></i></a>
                        <!-- Button trigger modal -->
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
