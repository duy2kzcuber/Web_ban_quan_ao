<?php
// Lấy dữ liệu từ form
$masp = $_POST['masp'];
$tensp = $_POST['tensp'];
$gia = $_POST['gia'];
$mausac = $_POST['mausac'];
$soluong = $_POST['soluong'];
$ngaytao = $_POST['ngaytao'];
$madm = $_POST['madm'];
$gioithieu = $_POST['gioithieu'];
$ctsp = $_POST['ctsp'];
$baoquan = $_POST['baoquan'];

// Kiểm tra nếu các trường bắt buộc không được để trống
if (!empty($masp) && !empty($tensp) && !empty($gia)) {
    require_once 'ketnoi.php'; // Kết nối đến cơ sở dữ liệu

    // Biến để lưu trữ tên ảnh chính và ảnh mô tả
    $fileName = '';
    $uploadedFiles = [];
    $target;
    // Xử lý upload ảnh chính
    if (!empty($_FILES['upload']['name'])) {
        $fileNameTemp = $_FILES['upload']['name'];
        $fileName = str_replace(" ", "", $fileNameTemp); //.rand(100000,999999)
        $target =  $fileName;
        $fileTmpPath = $_FILES['upload']['tmp_name'];
        $fileSize = $_FILES['upload']['size'];
        $fileType = $_FILES['upload']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Thư mục lưu trữ ảnh chính
        $uploadFileDir = './img/';

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!file_exists($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $dest_path = $uploadFileDir . $fileName;

        // Di chuyển ảnh chính vào thư mục đích
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            echo "Lỗi khi di chuyển ảnh chính " . $fileName . " đến thư mục đích.<br>";
        }
    }

    // Xử lý upload ảnh mô tả
    if (!empty($_FILES['uploads']['name'][0])) {
        $totalFiles = count($_FILES['uploads']['name']);
        
        for ($i = 0; $i < $totalFiles; $i++) {
            $fileTmpPath = $_FILES['uploads']['tmp_name'][$i];
            $fileNameTemp = $_FILES['uploads']['name'][$i];
            $fileName = str_replace(" ", "", $fileNameTemp); //.rand(100000,999999)
            $fileSize = $_FILES['uploads']['size'][$i];
            $fileType = $_FILES['uploads']['type'][$i];
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
    }

    // Nếu có ảnh chính hoặc ảnh mô tả được upload thành công
    if (!empty($fileName) || !empty($uploadedFiles)) {
        // Format chuỗi ảnh mô tả

        // note: đây là toán tử 3 ngôi, nếu mệnh "!empty($uploadedFiles)" đúng thì sẽ chạy đoạn lệnh sau dấu "?", sai chạy đoạn lệnh sau dấu hai chấm
        $fileNamesString = !empty($uploadedFiles) ? implode(",", $uploadedFiles) : '';

        // Tạo câu lệnh SQL để thêm sản phẩm vào cơ sở dữ liệu
        $themsql = "INSERT INTO `product` ( `madm`, `tensp`, `gia`, `mausac`, `soluong`, `ngaytao`, `gioithieu`, `ctsp`, `baoquan`, `anh`, `fileanh`) 
                    VALUES ( '$madm', '$tensp', '$gia', '$mausac', '$soluong', '$ngaytao', '$gioithieu', '$ctsp', '$baoquan', '$target', '$fileNamesString')";

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
        // Nếu không có ảnh nào được upload
        echo "Vui lòng tải lên ảnh chính hoặc ảnh mô tả.";
    }
} else {
    // Nếu các trường bắt buộc trống
    echo "Vui lòng điền đầy đủ thông tin.";
}
?>
