<?php
// Lấy thông tin sản phẩm từ form
$idprd = $_POST['sid'];
$masp = $_POST['masp'];
$id = $_POST['id'];
$soluongsize = $_POST['soluongsize'];

require_once '../../ketnoi.php';
$suasql = "UPDATE productsize SET masp='$masp', id='$id', soluongsize='$soluongsize' WHERE idprd='$idprd'";

if (mysqli_query($conn, $suasql)) {
    header("Location: lietkesoluong.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

?>