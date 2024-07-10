<?php
// Lấy id sản phẩm cần sửa từ tham số GET
$masp = $_GET['sid'];

// Kết nối CSDL
require_once '../ketnoi.php';

// Câu lệnh SQL để lấy thông tin sản phẩm dựa vào masp
$sua_sql = "SELECT * FROM product WHERE masp='$masp'";
$result = mysqli_query($conn, $sua_sql);
$row = mysqli_fetch_assoc($result);
include "../slider.php";


?>


<form name="form" action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="sid" value="<?php echo $masp; ?>">
        <div class="container">
            <h1>Form sửa thông tin sản phẩm</h1>
            <div class="form-group">
                <label for="masp">Mã sản phẩm</label>
                <input type="text" id="masp" class="form-control" name="masp" value="<?php echo $row['masp']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tensp">Tên sản phẩm</label>
                <input type="text" id="tensp" class="form-control" name="tensp" value="<?php echo $row['tensp']; ?>">
            </div>
            <div class="form-group">
                <label for="gia">Giá bán</label>
                <input type="text" id="gia" name="gia" class="form-control" value="<?php echo $row['gia']; ?>">
            </div>
            <div class="form-group">
                <label for="gianhap">Giá nhập </label>
                <input type="text" id="gianhap" name="gianhap" class="form-control" value="<?php echo $row['gianhap']; ?>">
            </div>
            <div class="form-group">
                <label for="mausac">Màu sắc</label>
                <input type="text" id="mausac" name="mausac" class="form-control" value="<?php echo $row['mausac']; ?>">
            </div>
           
            <div class="form-group">
                <label for="ngaytao">Ngày tạo</label>
                <input type="date" id="ngaytao" name="ngaytao" class="form-control" value="<?php echo $row['ngaytao']; ?>">
            </div>
            <div class="form-group">
                <label for="gioithieu">Giới thiệu</label>
                <input type="text" id="gioithieu" name="gioithieu" class="form-control" value="<?php echo $row['gioithieu']; ?>">
            </div>
            <div class="form-group">
                <label for="ctsp">Chi tiết sản phẩm</label>
                <input type="text" id="ctsp" name="ctsp" class="form-control" value="<?php echo $row['ctsp']; ?>">
            </div>
            <div class="form-group">
                <label for="baoquan">Bảo quản</label>
                <input type="text" id="baoquan" name="baoquan" class="form-control" value="<?php echo $row['baoquan']; ?>">
            </div>
            <div class="form-group">
                <label for="upload">Tên ảnh chính cũ</label>
                <input type="text" id="upload" name="upload" class="form-control" value="<?php echo htmlspecialchars($row['anh']); ?>">
            </div>
            <div class="form-group">
                <label for="newUpload">Chọn ảnh chính mới</label>
                <input type="file" id="newUpload" name="newUpload" class="form-control">
            </div>
            <div class="form-group">
                <label for="upload1">Tên ảnh mô tả 1 cũ</label>
                <input type="text" id="upload1" name="upload1" class="form-control" value="<?php echo htmlspecialchars($row['anhmt1']); ?>">
            </div>
            <div class="form-group">
                <label for="newUpload1">Chọn ảnh mô tả 1 mới</label>
                <input type="file" id="newUpload1" name="newUpload1" class="form-control">
            </div>
            <div class="form-group">
                <label for="upload2">Tên ảnh mô tả 2 cũ</label>
                <input type="text" id="upload2" name="upload2" class="form-control" value="<?php echo htmlspecialchars($row['anhmt2']); ?>">
            </div>
            <div class="form-group">
                <label for="newUpload2">Chọn ảnh mô tả 2 mới</label>
                <input type="file" id="newUpload2" name="newUpload2" class="form-control">
            </div>
            <div class="form-group">
                <label for="upload3">Tên ảnh mô tả 3 cũ</label>
                <input type="text" id="upload3" name="upload3" class="form-control" value="<?php echo htmlspecialchars($row['anhmt3']); ?>">
            </div>
            <div class="form-group">
                <label for="newUpload3">Chọn ảnh mô tả 3 mới</label>
                <input type="file" id="newUpload3" name="newUpload3" class="form-control">
            </div>
            <input type="submit" value="Sửa thông tin" class="btn btn-primary">
        </div>
    </form>