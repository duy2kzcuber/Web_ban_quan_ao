<?php
require_once('ketnoi.php'); // Ensure your database connection file is included

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Example: Update order status to "Cancelled" in your Orders table
    $update_query = "UPDATE Orders SET trangthai = 'Đã hủy' WHERE order_id = $order_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location:lichsudonhang.php");
    } else {
        echo "Đã xảy ra lỗi: " . mysqli_error($conn);
    }
} else {
    echo "Thiếu thông tin đơn hàng để hủy.";
}

mysqli_close($conn); // Close database connection
?>
