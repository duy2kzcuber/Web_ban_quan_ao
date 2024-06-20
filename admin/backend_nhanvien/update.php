<?php

// Lấy thông tin nhân viên từ form
$manv = $_POST['manv'];
$tennv = $_POST['tennv'];
$ngaysinh = $_POST['ngaysinh'];
$gioitinh = $_POST['gioitinh'];
$diachi = $_POST['diachi'];
$sdt = $_POST['sdt'];
$email = $_POST['email'];
$ngayvaolam = $_POST['ngayvaolam'];
$luong = $_POST['luong'];
$ghichu = $_POST['ghichu'];

require_once '../ketnoi.php'; // Kết nối đến cơ sở dữ liệu

// Câu lệnh SQL để cập nhật thông tin nhân viên
$suasql = "UPDATE nhanvien 
           SET tennv='$tennv', 
               ngaysinh='$ngaysinh', 
               gioitinh='$gioitinh', 
               diachi='$diachi', 
               sdt='$sdt', 
               email='$email', 
               ngayvaolam='$ngayvaolam', 
               luong='$luong', 
               ghichu='$ghichu' 
           WHERE manv='$manv'";

if (mysqli_query($conn, $suasql)) {
    header("Location: lietkenhanvien.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

?>
