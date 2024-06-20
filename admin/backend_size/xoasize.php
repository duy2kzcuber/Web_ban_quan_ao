<?php

require_once '../ketnoi.php';


$id = $_GET['sid'];
//echo $masp;


if (!empty($id)) {
   
    $delete_sql = "DELETE FROM tensize WHERE id = '$id'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $delete_sql)) {
        
        header("Location: lietke.php"); 
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "id không hợp lệ.";
}


?>
