<?php

require_once '../ketnoi.php';


$idanhht = $_GET['sid'];
//echo $masp;


if (!empty($idanhht)) {
   
    $delete_sql = "DELETE FROM anhht WHERE idanhht = '$idanhht'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $delete_sql)) {
        
        header("Location: lietkeanh.php"); 
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "id không hợp lệ.";
}


?>
