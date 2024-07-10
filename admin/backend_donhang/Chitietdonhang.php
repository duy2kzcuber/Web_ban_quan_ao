<?php
require_once '../ketnoi.php';
include '../slider.php';

if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Escape the order_id to prevent SQL injection
    $order_id = mysqli_real_escape_string($conn, $order_id);
    
    // Query để lấy chi tiết đơn hàng bao gồm thông tin sản phẩm và size, tính cả phí ship
    $query = "SELECT od.*, p.tensp, p.anh, p.mausac,
                    (od.thanhtien) AS thanhtien_total
            FROM OrderDetails od
            INNER JOIN Product p ON od.masp = p.masp
            WHERE od.order_id = '$order_id'";
    
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        // Hiển thị tiêu đề chi tiết đơn hàng
        echo "<div class='container'>";
        echo "<h2>Chi tiết đơn hàng mã số $order_id</h2>";
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Ảnh</th>";
        echo "<th>Tên sản phẩm</th>";
        echo "<th>Màu sắc</th>";
        echo "<th>Size</th>";
        echo "<th>Số lượng</th>";
        echo "<th>Đơn giá</th>";
        echo "<th>Thành tiền</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        // Hiển thị các hàng chi tiết đơn hàng
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><img src='../backend_sanpham/img/" . $row['anh'] . "' style='width: 100px; height: auto;'></td>";
            echo "<td>" . $row['tensp'] . "</td>";
            echo "<td>" . $row['mausac'] . "</td>";
            echo "<td>" . $row['size'] . "</td>"; // Hiển thị size từ bảng tensize
            echo "<td>" . $row['sl'] . "</td>";
            echo "<td>" . number_format($row['dongia'], 0, ',', '.') . " VNĐ</td>";
            echo "<td>" . number_format($row['thanhtien_total'], 0, ',', '.') . " VNĐ</td>"; // Hiển thị tổng cộng với phí ship
            echo "</tr>";
        }
        
        // Hiển thị tổng tiền của đơn hàng
        $total_query = "SELECT SUM(thanhtien) AS tongtien_total FROM OrderDetails WHERE order_id = '$order_id'";
        $total_result = mysqli_query($conn, $total_query);
        $total_row = mysqli_fetch_assoc($total_result);
        $tienship = 50000;
        $total_amount = $total_row['tongtien_total'] + $tienship;
        
        echo "<tr>";
        echo "<td colspan='6' class='text-right'><strong>Tiền ship:</strong></td>";
        echo "<td><strong>" . number_format($tienship, 0, ',', '.') . " VNĐ</strong></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td colspan='6' class='text-right'><strong>Tổng tiền:</strong></td>";
        echo "<td><strong>" . number_format($total_amount, 0, ',', '.') . " VNĐ</strong></td>";
        echo "</tr>";
        
        echo "</tbody>";
        echo "</table>";
        
        // Thêm nút Quay lại
        echo "<div class='text-center mt-3'>";
        echo "<a href='Danhsach_dh.php' class='btn btn-primary'>Quay lại</a>";
        echo "</div>";
        
        echo "</div>";
    } else {
        echo "Không có chi tiết đơn hàng cho mã số $order_id.";
    }
} else {
    echo "Thiếu tham số order_id.";
}
?>
