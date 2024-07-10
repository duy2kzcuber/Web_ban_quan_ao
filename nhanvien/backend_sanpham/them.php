<?php
$masp = $_POST['masp'];
$tensp = $_POST['tensp'];
$gia = $_POST['gia'];
$gianhap = $_POST['gianhap'];
$mausac = $_POST['mausac'];

$ngaytao = $_POST['ngaytao'];
$madm = $_POST['madm'];
$gioithieu = $_POST['gioithieu'];
$ctsp = $_POST['ctsp'];
$baoquan = $_POST['baoquan'];

if (!empty($masp) && !empty($tensp) && !empty($gia)) {
    require_once '../ketnoi.php';

    // Xử lý upload ảnh chính
    $fileNameMain = '';
    if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['upload']['tmp_name'];
        $fileNameTemp = $_FILES['upload']['name'];
        $fileName = str_replace(" ", "", $fileNameTemp);
        $uploadFileDir = './img/';

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

    // Xử lý upload ảnh mô tả 1
    $fileNameDesc1 = '';
    if (isset($_FILES['upload1']) && $_FILES['upload1']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['upload1']['tmp_name'];
        $fileNameTemp = $_FILES['upload1']['name'];
        $fileName = str_replace(" ", "", $fileNameTemp);
        $uploadFileDir = './anhmota/';

        // Kiểm tra xem thư mục đích có tồn tại không
        if (!file_exists($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $fileNameDesc1 = $fileName; // Lưu tên tệp vào biến để lưu vào CSDL

        if (!move_uploaded_file($fileTmpPath, $uploadFileDir . $fileName)) {
            echo "Lỗi khi di chuyển ảnh mô tả 1 đến thư mục đích.<br>";
            exit;
        }
    }

    // Xử lý upload ảnh mô tả 2
    $fileNameDesc2 = '';
    if (isset($_FILES['upload2']) && $_FILES['upload2']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['upload2']['tmp_name'];
        $fileNameTemp = $_FILES['upload2']['name'];
        $fileName = str_replace(" ", "", $fileNameTemp);
        $uploadFileDir = './anhmota/';

        // Kiểm tra xem thư mục đích có tồn tại không
        if (!file_exists($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $fileNameDesc2 = $fileName; // Lưu tên tệp vào biến để lưu vào CSDL

        if (!move_uploaded_file($fileTmpPath, $uploadFileDir . $fileName)) {
            echo "Lỗi khi di chuyển ảnh mô tả 2 đến thư mục đích.<br>";
            exit;
        }
    }

    // Xử lý upload ảnh mô tả 3
    $fileNameDesc3 = '';
    if (isset($_FILES['upload3']) && $_FILES['upload3']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['upload3']['tmp_name'];
        $fileNameTemp = $_FILES['upload3']['name'];
        $fileName = str_replace(" ", "", $fileNameTemp);
        $uploadFileDir = './anhmota/';

        // Kiểm tra xem thư mục đích có tồn tại không
        if (!file_exists($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $fileNameDesc3 = $fileName; // Lưu tên tệp vào biến để lưu vào CSDL

        if (!move_uploaded_file($fileTmpPath, $uploadFileDir . $fileName)) {
            echo "Lỗi khi di chuyển ảnh mô tả 3 đến thư mục đích.<br>";
            exit;
        }
    }

    // Tạo câu lệnh SQL để thêm sản phẩm vào cơ sở dữ liệu
    $themsql = "INSERT INTO `product` (`masp`, `tensp`, `gia`,`gianhap`, `mausac`, `ngaytao`, `madm`, `gioithieu`, `ctsp`, `baoquan`, `anh`, `anhmt1`, `anhmt2`, `anhmt3`) 
                VALUES ('$masp', '$tensp', '$gia','$gianhap', '$mausac', '$ngaytao', '$madm', '$gioithieu', '$ctsp', '$baoquan', '$fileNameMain', '$fileNameDesc1', '$fileNameDesc2', '$fileNameDesc3')";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $themsql)) {
        // Nếu thêm sản phẩm thành công, chuyển hướng về trang liệt kê sản phẩm
        header("Location: lietke.php");
        exit;
    } else {
        // Nếu có lỗi SQL, hiển thị thông báo lỗi
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    // Nếu các trường bắt buộc trống
    echo "Vui lòng điền đầy đủ thông tin (mã sản phẩm, tên sản phẩm và giá).";
}
?>
