<?php
require_once '../ketnoi.php'; // Đường dẫn tương đối đến file kết nối
include '../slider.php';

// Xử lý form submit
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['sdt'])) {
    // Lấy giá trị số điện thoại từ form
    $sdt = $_GET['sdt'];
    
    // Tạo câu truy vấn SQL với điều kiện WHERE số điện thoại
    $sql = "SELECT * FROM orders WHERE so_dien_thoai LIKE '%$sdt%'";
    $result = mysqli_query($conn, $sql);
} else {
    // Nếu không có dữ liệu từ form, hiển thị tất cả khách hàng
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sql);
}
?>

<div class="container">
    <h1>DANH SÁCH KHÁCH HÀNG</h1>
    <form method="GET" action="">
        <div class="row mt-3">
            <div class="col-md-4">
                <input type="text" name="sdt" class="form-control" placeholder="Nhập số điện thoại...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <table class="table table-dark mt-3">
        <thead>
            <tr>
                <th>Tên KH</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($r = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $r['ten_khach_hang']; ?></td>
                    <td><?php echo $r['so_dien_thoai']; ?></td>
                    <td><?php echo $r['dia_chi']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
