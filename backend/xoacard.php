<?php
session_start();

if (isset($_GET['key']) && isset($_SESSION['cart'][$_GET['key']])) {
    // Xóa sản phẩm khỏi giỏ hàng dựa trên key
    unset($_SESSION['cart'][$_GET['key']]);
}

// Điều hướng người dùng quay lại trang giỏ hàng sau khi xóa
header("Location: cart.php");
exit();
?>
