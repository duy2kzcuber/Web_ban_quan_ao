<?php
// Lấy thông tin tin tức từ form
$idtintuc = $_POST['sid'];
$tieude = $_POST['tieude'];
$noidung = $_POST['noidung'];
$ngaytao = $_POST['ngaytao'];

// Kết nối tới cơ sở dữ liệu
require_once '../ketnoi.php';

// Xử lý upload ảnh mới nếu có
if (!empty($_FILES['newUpload']['name'])) {
    $fileName = $_FILES['newUpload']['name'];
    $fileTmpPath = $_FILES['newUpload']['tmp_name'];
    $fileSize = $_FILES['newUpload']['size'];
    $fileType = $_FILES['newUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Thư mục lưu trữ ảnh
    $uploadDir = 'imgs/';

    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Tạo tên file mới để tránh trùng lặp
    $newFileName = uniqid() . '.' . $fileExtension;
    $destPath = $uploadDir . $newFileName;

    // Di chuyển file vào thư mục đích
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // Cập nhật tên file ảnh mới vào cơ sở dữ liệu
        $updateSql = "UPDATE tintuc SET tieude='$tieude', noidung='$noidung', ngaytao='$ngaytao', hinhanh='$newFileName' WHERE idtintuc='$idtintuc'";
    } else {
        echo "Lỗi khi di chuyển file " . $fileName . " vào thư mục đích.<br>";
        exit();
    }
} else {
    // Nếu không có ảnh mới được tải lên, chỉ cập nhật các thông tin khác
    $updateSql = "UPDATE tintuc SET tieude='$tieude', noidung='$noidung', ngaytao='$ngaytao' WHERE idtintuc='$idtintuc'";
}

// Thực thi câu lệnh SQL để cập nhật
if (mysqli_query($conn, $updateSql)) {
    header("Location: lietketintuc.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
?>
