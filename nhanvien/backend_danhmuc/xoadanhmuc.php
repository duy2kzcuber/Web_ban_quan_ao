<?php

require_once '../ketnoi.php';


$madm = $_GET['sid'];
//echo $masp;


if (!empty($madm)) {

    $delete_sql = "DELETE FROM danhmuc WHERE madm = '$madm'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $delete_sql)) {

        header("Location: lietkedanhmuc.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "id không hợp lệ.";
}
