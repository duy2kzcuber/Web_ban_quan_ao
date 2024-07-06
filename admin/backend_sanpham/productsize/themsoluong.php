<?php
$id = $_POST['id'];
$masp=$_POST['masp'];
$soluongsize=$_POST['soluongsize'];



require_once '../../ketnoi.php';
$themsql = "INSERT INTO `productsize` ( `id`,`masp`,`soluongsize`) VALUES ( '$id','$masp','$soluongsize')";

            if (mysqli_query($conn, $themsql)) {
                header("Location:lietkesoluong.php");
            } else {
                echo "Loi: " . mysqli_error($conn);
            }

?>
