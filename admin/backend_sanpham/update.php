<?php
// Lấy id sản phẩm cần sửa từ form
$masp = $_POST['sid'];

// Lấy dữ liệu từ form
$tensp = $_POST['tensp'];
$gia = $_POST['gia'];
$mausac = $_POST['mausac'];
$soluong = $_POST['soluong'];
$ngaytao = $_POST['ngaytao'];
$gioithieu = $_POST['gioithieu'];
$ctsp = $_POST['ctsp'];
$baoquan = $_POST['baoquan'];
$upload = $_POST['upload']; // Tên ảnh chính cũ

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
    if (!move_uploaded_file($fileTmpPath,    $dest_path)) {
        echo "Lỗi khi di chuyển ảnh chính " . $fileName . " đến thư mục đích.<br>";
    }

    // Cập nhật tên ảnh mới vào cơ sở dữ liệu
    $updateAnh = "UPDATE product SET anh='$fileName' WHERE masp='$masp'";
    mysqli_query($conn, $updateAnh);
}

// Xử lý upload ảnh mô tả 1 mới nếu có
$newUpload1 = $_FILES['newUpload1']['name'];
if (!empty($newUpload1)) {
    $fileNameTemp = $_FILES['newUpload1']['name'];
    $fileName1 = str_replace(" ", "", $fileNameTemp); //.rand(100000,999999)
    $fileTmpPath = $_FILES['newUpload1']['tmp_name'];
    $fileSize = $_FILES['newUpload1']['size'];
    $fileType = $_FILES['newUpload1']['type'];
    $fileNameCmps = explode(".", $fileName1);
    $fileExtension = strtolower(end($fileNameCmps));

    // Thư mục lưu trữ ảnh mô tả 1
    $uploadFileDir = './anhmota/';

    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }

    $dest_path = $uploadFileDir . $fileName1;

    // Di chuyển ảnh mô tả 1 vào thư mục đích
    if (!move_uploaded_file($fileTmpPath, $dest_path)) {
        echo "Lỗi khi di chuyển ảnh mô tả 1 " . $fileName1 . " đến thư mục đích.<br>";
    }

    // Cập nhật tên ảnh mô tả 1 mới vào cơ sở dữ liệu
    $updateAnh1 = "UPDATE product SET anhmt1='$fileName1' WHERE masp='$masp'";
    mysqli_query($conn, $updateAnh1);
}

// Xử lý upload ảnh mô tả 2 mới nếu có
$newUpload2 = $_FILES['newUpload2']['name'];
if (!empty($newUpload2)) {
    $fileNameTemp = $_FILES['newUpload2']['name'];
    $fileName2 = str_replace(" ", "", $fileNameTemp); //.rand(100000,999999)
    $fileTmpPath = $_FILES['newUpload2']['tmp_name'];
    $fileSize = $_FILES['newUpload2']['size'];
    $fileType = $_FILES['newUpload2']['type'];
    $fileNameCmps = explode(".", $fileName2);
    $fileExtension = strtolower(end($fileNameCmps));

    // Thư mục lưu trữ ảnh mô tả 2
    $uploadFileDir = './anhmota/';

    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }

    $dest_path = $uploadFileDir . $fileName2;

    // Di chuyển ảnh mô tả 2 vào thư mục đích
    if (!move_uploaded_file($fileTmpPath, $dest_path)) {
        echo "Lỗi khi di chuyển ảnh mô tả 2 " . $fileName2 . " đến thư mục đích.<br>";
    }

    // Cập nhật tên ảnh mô tả 2 mới vào cơ sở dữ liệu
    $updateAnh2 = "UPDATE product SET anhmt2='$fileName2' WHERE masp='$masp'";
    mysqli_query($conn, $updateAnh2);
}
// Xử lý upload ảnh mô tả 3 mới nếu có
$newUpload3 = $_FILES['newUpload3']['name'];
if (!empty($newUpload3)) {
    $fileNameTemp = $_FILES['newUpload3']['name'];
    $fileName3 = str_replace(" ", "", $fileNameTemp); //.rand(100000,999999)
    $fileTmpPath = $_FILES['newUpload3']['tmp_name'];
    $fileSize = $_FILES['newUpload3']['size'];
    $fileType = $_FILES['newUpload3']['type'];
    $fileNameCmps = explode(".", $fileName3);
    $fileExtension = strtolower(end($fileNameCmps));

    // Thư mục lưu trữ ảnh mô tả 3
    $uploadFileDir = './anhmota/';

    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }

    $dest_path = $uploadFileDir . $fileName3;

    // Di chuyển ảnh mô tả 3 vào thư mục đích
    if (!move_uploaded_file($fileTmpPath, $dest_path)) {
        echo "Lỗi khi di chuyển ảnh mô tả 3 " . $fileName3 . " đến thư mục đích.<br>";
    }

    // Cập nhật tên ảnh mô tả 3 mới vào cơ sở dữ liệu
    $updateAnh3 = "UPDATE product SET anhmt3='$fileName3' WHERE masp='$masp'";
    mysqli_query($conn, $updateAnh3);
}


// Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
$updateSql = "UPDATE product SET tensp='$tensp', gia='$gia', mausac='$mausac', soluong='$soluong', ngaytao='$ngaytao', gioithieu='$gioithieu', ctsp='$ctsp', baoquan='$baoquan' WHERE masp='$masp'";

if (mysqli_query($conn, $updateSql)) {
    // Nếu cập nhật thành công, chuyển hướng về trang liệt kê sản phẩm
    header("Location: lietke.php");
    exit;
} else {
    // Nếu có lỗi SQL, hiển thị thông báo lỗi
    echo "Lỗi: " . mysqli_error($conn);
}
?>

