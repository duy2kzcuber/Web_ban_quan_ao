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


function createPassword($s) {
    $date = $month = $year = "";
    $tt = 0;

    for ($i = 0; $i < strlen($s); $i++) {
        if ($s[$i] == '-') {
            $tt++;
        } else if ($tt == 0) {
            $year .= $s[$i];
        } else if ($tt == 1) {
            $month .= $s[$i];
        } else if ($tt == 2) {
            $date .= $s[$i];
        }
    }
    return $date . $month . $year;
}
$matkhau = createPassword($ngaysinh);
$matkhau = md5($matkhau);
require_once '../ketnoi.php';
$themsql = "INSERT INTO `nhanvien` (`manv`, `tennv`,`ngaysinh`,`gioitinh`,`diachi`,`sdt`,`email`,`ngayvaolam`,`luong`,`ghichu`,matkhau) 
    VALUES ('$manv', '$tennv','$ngaysinh','$gioitinh','$diachi','$sdt','$email','$ngayvaolam','$luong','$ghichu','$matkhau')";
            if (mysqli_query($conn, $themsql)) {
                header("Location:lietkenhanvien.php");
            } else {
                echo "Loi: " . mysqli_error($conn);
            }

?>
