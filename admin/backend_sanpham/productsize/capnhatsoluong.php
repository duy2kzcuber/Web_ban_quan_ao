<?php
require_once '../../ketnoi.php';

// Lấy danh sách các sản phẩm trong các đơn hàng đã xác nhận và chưa được xử lý
$sql = "SELECT od.masp, od.sl, od.size, o.order_id, o.trangthai, o.processed, o.processed1
        FROM orderdetails od 
        JOIN orders o ON od.order_id = o.order_id 
        WHERE o.trangthai = 'Đã xác nhận' OR o.trangthai = 'Hoàn hàng'";

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $masp = $row['masp'];
        $sl = $row['sl'];
        $size = $row['size'];
        $order_id = $row['order_id'];
        $trangthai = $row['trangthai']; // Lấy trạng thái của đơn hàng
        $processed = $row['processed']; // Lấy giá trị của processed
        $processed1 = $row['processed1']; // Lấy giá trị của processed1

        // Lấy số lượng hiện tại của sản phẩm trong bảng productsize
        $current_quantity_sql = "SELECT soluongsize 
                                 FROM productsize 
                                 WHERE masp = '$masp' AND id = (SELECT id FROM tensize WHERE tensize = '$size')";
        $current_quantity_result = mysqli_query($conn, $current_quantity_sql);

        if ($current_quantity_result) {
            $current_quantity_row = mysqli_fetch_assoc($current_quantity_result);
            $current_quantity = $current_quantity_row['soluongsize'];

            // Kiểm tra nếu số lượng hiện tại lớn hơn hoặc bằng số lượng cần trừ
            if ($trangthai == 'Đã xác nhận') {
                if ($current_quantity >= $sl && !$processed) {
                    // Cập nhật số lượng sản phẩm trong bảng productsize
                    $update_sql = "UPDATE productsize 
                                   SET soluongsize = soluongsize - $sl 
                                   WHERE masp = '$masp' AND id = (SELECT id FROM tensize WHERE tensize = '$size')";
                    mysqli_query($conn, $update_sql);

                    // Đánh dấu đơn hàng là đã xử lý
                    $update_order_sql = "UPDATE orders SET processed = TRUE WHERE order_id = '$order_id'";
                    mysqli_query($conn, $update_order_sql);
                }
            } elseif ($trangthai == 'Hoàn hàng') {
                if (!$processed1) {
                    // Cộng số lượng sản phẩm
                    // Cập nhật số lượng sản phẩm trong bảng productsize
                    $update_sql = "UPDATE productsize 
                                   SET soluongsize = soluongsize + $sl 
                                   WHERE masp = '$masp' AND id = (SELECT id FROM tensize WHERE tensize = '$size')";
                    mysqli_query($conn, $update_sql);

                    // Đánh dấu đơn hàng là đã xử lý
                    $update_order_sql = "UPDATE orders SET processed1 = TRUE WHERE order_id = '$order_id'";
                    mysqli_query($conn, $update_order_sql);
                }
            }

        } else {
            echo "Lỗi khi truy vấn số lượng sản phẩm hiện tại: " . mysqli_error($conn);
        }
    }

    header("Location: lietkesoluong.php");
    exit();
} else {
    echo "Có lỗi xảy ra khi lấy danh sách sản phẩm: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
