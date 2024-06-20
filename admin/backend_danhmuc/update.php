<?php

// Lấy thông tin sản phẩm từ form
$madm = $_POST['madm'];
$tendm = $_POST['tendm'];

require_once '../ketnoi.php'; // Kết nối đến cơ sở dữ liệu
$suasql = "UPDATE danhmuc SET tendm='$tendm' WHERE madm='$madm'";


if (mysqli_query($conn, $suasql)) {
    header("Location: lietkedanhmuc.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

?>
