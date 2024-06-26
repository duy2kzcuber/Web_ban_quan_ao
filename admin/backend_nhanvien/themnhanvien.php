<?php
$manv = $_POST['manv'];
$tennv=$_POST['tennv'];
$ngaysinh=$_POST['ngaysinh'];
$gioitinh=$_POST['gioitinh'];
$diachi=$_POST['diachi'];
$sdt=$_POST['sdt'];
$email=$_POST['email'];
$ngayvaolam=$_POST['ngayvaolam'];
$luong=$_POST['luong'];
$ghichu=$_POST['ghichu'];



 require_once '../ketnoi.php';
$themsql = "INSERT INTO `nhanvien` (`manv`, `tennv`,`ngaysinh`,`gioitinh`,`diachi`,`sdt`,`email`,`ngayvaolam`,`luong`,`ghichu`) 
    VALUES ('$manv', '$tennv','$ngaysinh','$gioitinh','$diachi','$sdt','$email','$ngayvaolam','$luong','$ghichu')";

            if (mysqli_query($conn, $themsql)) {
                header("Location:lietkenhanvien.php");
            } else {
                echo "Loi: " . mysqli_error($conn);
            }

?>
