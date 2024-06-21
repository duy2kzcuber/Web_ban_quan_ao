<?php
$madm = $_POST['madm'];
$tendm=$_POST['tendm'];
$danhmuccha=$_POST['danhmuccha'];



require_once '../ketnoi.php';
$themsql = "INSERT INTO `danhmuc` ( `madm`,`tendm`,`danhmuccha`) VALUES ( '$madm','$tendm','$danhmuccha')";

            if (mysqli_query($conn, $themsql)) {
                header("Location:lietkedanhmuc.php");
            } else {
                echo "Loi: " . mysqli_error($conn);
            }

?>
