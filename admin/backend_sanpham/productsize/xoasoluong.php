<?php

require_once '../../ketnoi.php';


$idprd = $_GET['sid'];
//echo $masp;


if (!empty($idprd)) {
   
    $delete_sql = "DELETE FROM productsize WHERE idprd = '$idprd'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $delete_sql)) {
        
        header("Location: lietkesoluong.php"); 
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "masp không hợp lệ.";
}


?>
