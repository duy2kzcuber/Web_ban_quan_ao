<?php

require_once '../ketnoi.php';


$manv = $_GET['sid'];
//echo $masp;


if (!empty($manv)) {
   
    $delete_sql = "DELETE FROM nhanvien WHERE manv = '$manv'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $delete_sql)) {
        
        header("Location: lietkenhanvien.php"); 
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "id không hợp lệ.";
}


?>
