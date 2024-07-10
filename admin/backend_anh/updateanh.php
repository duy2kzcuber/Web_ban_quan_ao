<?php
// Lấy thông tin ảnh từ form
$idanhht = $_POST['sid'];
$mota = $_POST['mota'];
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
    $uploadDir = '../backend_anh/imgs/';

    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Tạo tên file mới để tránh trùng lặp
    $newFileName = uniqid() . '.' . $fileExtension;
    $destPath = $uploadDir . $newFileName;

    // Di chuyển file vào thư mục đích
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // Cập nhật thông tin mới vào cơ sở dữ liệu, bao gồm cả tên ảnh mới
        $updateSql = "UPDATE anhht SET mota='$mota', ngaytao='$ngaytao', anhhienthi='$newFileName' WHERE idanhht='$idanhht'";
    } else {
        echo "Lỗi khi di chuyển file " . $fileName . " vào thư mục đích.<br>";
        exit();
    }
} else {
    // Nếu không có ảnh mới được tải lên, chỉ cập nhật các thông tin khác
    $updateSql = "UPDATE anhht SET mota='$mota', ngaytao='$ngaytao' WHERE idanhht='$idanhht'";
}

// Thực thi câu lệnh SQL để cập nhật
if (mysqli_query($conn, $updateSql)) {
    header("Location: lietkeanh.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
?>
