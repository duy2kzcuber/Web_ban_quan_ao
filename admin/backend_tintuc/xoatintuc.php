<?php

require_once '../ketnoi.php';


$idtintuc = $_GET['sid'];
//echo $masp;


if (!empty($idtintuc)) {
   
    $delete_sql = "DELETE FROM tintuc WHERE idtintuc = '$idtintuc'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $delete_sql)) {
        
        header("Location: lietketintuc.php"); 
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "id không hợp lệ.";
}


?>
