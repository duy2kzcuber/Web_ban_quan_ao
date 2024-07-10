<?php

// Lấy thông tin sản phẩm từ form
$madm = $_POST['madm'];
$danhmuccha = $_POST['danhmuccha'];
$tendm = $_POST['tendm'];

require_once '../ketnoi.php';
$suasql = "UPDATE danhmuc SET tendm='$tendm',danhmuccha='$danhmuccha' WHERE madm='$madm'";


if (mysqli_query($conn, $suasql)) {
    header("Location: lietkedanhmuc.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
