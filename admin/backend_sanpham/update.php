<?php
// Lấy id sản phẩm cần sửa từ form
$masp = $_POST['sid'];

// Lấy dữ liệu từ form
$tensp = $_POST['tensp'];
$gia = $_POST['gia'];
$mausac = $_POST['mausac'];
$soluong=$_POST['soluong'];
$ngaytao=$_POST['ngaytao'];

$gioithieu = $_POST['gioithieu'];
$ctsp = $_POST['ctsp'];
$baoquan = $_POST['baoquan'];
$upload = $_POST['upload']; // Tên ảnh cũ

// Kết nối đến cơ sở dữ liệu
require_once '../ketnoi.php';

// Xử lý upload ảnh mới nếu có
$newUpload = $_FILES['newUpload']['name'];
if (!empty($newUpload)) {
    $fileNameTemp = $_FILES['newUpload']['name'];
    $fileName = str_replace(" ", "", $fileNameTemp); //.rand(100000,999999)
    $fileTmpPath = $_FILES['newUpload']['tmp_name'];
    $fileSize = $_FILES['newUpload']['size'];
    $fileType = $_FILES['newUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Thư mục lưu trữ ảnh chính
    $uploadFileDir = './img/';

    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }

    $dest_path = $uploadFileDir . $fileName;

    // Di chuyển ảnh chính mới vào thư mục đích
    if (!move_uploaded_file($fileTmpPath, $dest_path)) {
        echo "Lỗi khi di chuyển ảnh chính " . $fileName . " đến thư mục đích.<br>";
    }

    // Cập nhật tên ảnh mới vào cơ sở dữ liệu
    $updateAnh = "UPDATE product SET anh='$fileName' WHERE masp='$masp'";
    mysqli_query($conn, $updateAnh);
}

// Xử lý upload ảnh mô tả mới nếu có
$newUploads = $_FILES['newuploads']['name'];
if (!empty($newUploads)) {
    $uploadedFiles = [];
    $totalFiles = count($_FILES['newuploads']['name']);
    
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileTmpPath = $_FILES['newuploads']['tmp_name'][$i];
        $fileNameTemp = $_FILES['newuploads']['name'][$i];
        $fileName = str_replace(" ", "", $fileNameTemp); //.rand(100000,999999)
        $fileSize = $_FILES['newuploads']['size'][$i];
        $fileType = $_FILES['newuploads']['type'][$i];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Thư mục lưu trữ ảnh mô tả
        $uploadFileDir = './anhmota/';

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!file_exists($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $dest_path = $uploadFileDir . $fileName;

        // Di chuyển ảnh mô tả vào thư mục đích
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $uploadedFiles[] = $fileName;
        } else {
            echo "Lỗi khi di chuyển ảnh mô tả " . $fileName . " đến thư mục đích.<br>";
        }
    }

    // Nếu có ảnh mô tả mới được upload thành công
    if (!empty($uploadedFiles)) {
        $fileNamesString = implode(",", $uploadedFiles);

        // Cập nhật tên các ảnh mô tả mới vào cơ sở dữ liệu
        $updateFileAnh = "UPDATE product SET fileanh='$fileNamesString' WHERE masp='$masp'";
        mysqli_query($conn, $updateFileAnh);
    }
}

// Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
$updateSql = "UPDATE product SET tensp='$tensp', gia='$gia', mausac='$mausac',soluong='$soluong',ngaytao='$ngaytao', gioithieu='$gioithieu', ctsp='$ctsp', baoquan='$baoquan' WHERE masp='$masp'";

if (mysqli_query($conn, $updateSql)) {
    // Nếu cập nhật thành công, chuyển hướng về trang liệt kê sản phẩm
    header("Location: lietke.php");
    exit;
} else {
    // Nếu có lỗi SQL, hiển thị thông báo lỗi
    echo "Lỗi: " . mysqli_error($conn);
}
?>
