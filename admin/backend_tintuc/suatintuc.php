<?php
// Lay id can sua
$idtintuc = $_GET['sid'];

// Ket noi
require_once '../ketnoi.php';

// Cau lenh de lay thong tin
$sua_sql = "SELECT * FROM tintuc WHERE idtintuc = '$idtintuc'";
$result = mysqli_query($conn, $sua_sql);
$row = mysqli_fetch_assoc($result);

// Include slider or any other includes needed
include "../slider.php";
?>

<form name="form" action="updatetintuc.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="sid" value="<?php echo $idtintuc; ?>">
    <div class="container">
        <h1>Form Sửa thông tin tin tức</h1>
        <div class="form-group">
            <label for="tieude">Tiêu đề</label>
            <input type="text" id="tieude" class="form-control" name="tieude" value="<?php echo $row['tieude']; ?>" required>
        </div>
        <div class="form-group">
            <label for="noidung">Nội dung</label>
            <textarea id="noidung" class="form-control" name="noidung" required><?php echo $row['noidung']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="ngaytao">Ngày tạo</label>
            <input type="date" id="ngaytao" class="form-control" name="ngaytao" value="<?php echo $row['ngaytao']; ?>" required>
        </div>
        <div class="form-group">
            <label for="upload">Tên ảnh cũ</label>
            <input type="text" id="upload" name="upload" class="form-control" value="<?php echo htmlspecialchars($row['hinhanh']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="newUpload">Chọn ảnh mới</label>
            <input type="file" id="newUpload" name="newUpload" class="form-control">
        </div>
        
        <input type="submit" value="Sửa thông tin"/>
    </div>
</form>
