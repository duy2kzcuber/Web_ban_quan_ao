<?php

// Lấy thông tin sản phẩm từ form
$id = $_POST['id'];
$size = $_POST['size'];

require_once '../ketnoi.php'; // Kết nối đến cơ sở dữ liệu
$suasql = "UPDATE tensize SET tensize='$size' WHERE id='$id'";


if (mysqli_query($conn, $suasql)) {
    header("Location: lietke.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

?>
