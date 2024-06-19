<?php

require_once 'ketnoi.php';


$masp = $_GET['sid'];
//echo $masp;


if (!empty($masp)) {
   
    $delete_sql = "DELETE FROM product WHERE masp = '$masp'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $delete_sql)) {
        
        header("Location: lietke.php"); 
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "masp không hợp lệ.";
}


?>
