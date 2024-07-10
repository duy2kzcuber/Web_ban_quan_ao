<?php
$anhhienthi = $_FILES['anhhienthi']['name'];
$mota = $_POST['mota'];
$ngaytao = date('Y-m-d');
echo "Ngày hiện tại là: " . $ngaytao;

// Xử lý tệp ảnh
$fileNameMain = '';
if (isset($_FILES['anhhienthi']) && $_FILES['anhhienthi']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['anhhienthi']['tmp_name'];
    $fileNameTemp = $_FILES['anhhienthi']['name'];
    $fileName = str_replace(" ", "", $fileNameTemp);
    $uploadFileDir = '../backend_anh/imgs/';

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
$themsql = "INSERT INTO `anhht` (`mota`, `ngaytao`, `anhhienthi`) VALUES ('$mota', '$ngaytao', '$fileNameMain')";

if (mysqli_query($conn, $themsql)) {
    header("Location:lietkeanh.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

?>
