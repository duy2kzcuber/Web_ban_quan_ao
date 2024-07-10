<?php
$tieude = $_POST['tieude'];
$noidung = $_POST['noidung'];
$ngaytao = $_POST['ngaytao'];

$fileNameMain = '';
if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['upload']['tmp_name'];
    $fileNameTemp = $_FILES['upload']['name'];
    $fileName = str_replace(" ", "", $fileNameTemp);
    $uploadFileDir = './imgs/';

    // Kiểm tra xem thư mục đích có tồn tại không
    if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }

    $fileNameMain = $fileName; // Lưu tên tệp vào biến để lưu vào CSDL

    if (!move_uploaded_file($fileTmpPath, $uploadFileDir . $fileName)) {
        echo "Lỗi khi di chuyển ảnh chính đến thư mục đích.<br>";
        exit;
    }
}

require_once '../ketnoi.php';

$themsql = "INSERT INTO `tintuc` (`tieude`, `noidung`, `ngaytao`, `hinhanh`) VALUES ('$tieude', '$noidung', '$ngaytao', '$fileNameMain')";

if (mysqli_query($conn, $themsql)) {
    header("Location: lietketintuc.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
?>
