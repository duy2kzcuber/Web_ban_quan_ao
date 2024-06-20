<?php
$madm = $_POST['madm'];
$tendm=$_POST['tendm'];



require_once '../ketnoi.php';
$themsql = "INSERT INTO `danhmuc` ( `tendm`) VALUES ( '$tendm')";

            if (mysqli_query($conn, $themsql)) {
                header("Location:lietkedanhmuc.php");
            } else {
                echo "Loi: " . mysqli_error($conn);
            }

?>
