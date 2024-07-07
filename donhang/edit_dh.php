<?php
require_once '../admin/ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $trang_thai = $_POST['trang_thai'];

    $capnhat_sql = "UPDATE orders SET trangthai='$trang_thai' WHERE order_id='$order_id'";
    if (mysqli_query($conn, $capnhat_sql)) {
        echo "Cập nhật thành công";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    header('Location: Danhsach_dh.php');
    exit();
}
?>
