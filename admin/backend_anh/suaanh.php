<?php
// Lay id can sua
$idanhht = $_GET['sid'];

// Ket noi
require_once '../ketnoi.php';

// Cau lenh de lay thong tin
$sua_sql = "SELECT * FROM anhht WHERE idanhht = '$idanhht'";
$result = mysqli_query($conn, $sua_sql);
$row = mysqli_fetch_assoc($result);

// Include slider or any other includes needed
include "../slider.php";
?>

<form name="form" action="updateanh.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="sid" value="<?php echo $idanhht; ?>">
    <div class="container">
        <h1>Form Sửa Ảnh</h1>
        <div class="form-group">
            <label for="mota">Mô tả</label>
            <input type="text" id="mota" class="form-control" name="mota" value="<?php echo $row['mota']; ?>">
        </div>
        
        <div class="form-group">
            <label for="ngaytao">Ngày tạo</label>
            <input type="date" id="ngaytao" class="form-control" name="ngaytao" value="<?php echo $row['ngaytao']; ?>">
        </div>
        <div class="form-group">
            <label for="upload">Ảnh hiện tại</label>
            <br>
            <img src="../backend_anh/imgs/<?php echo $row['anhhienthi']; ?>" alt="Ảnh hiện tại" style="max-width: 200px;">
            <input type="hidden" id="upload" name="upload" class="form-control" value="<?php echo $row['anhhienthi']; ?>">
        </div>
        <div class="form-group">
            <label for="newUpload">Chọn ảnh mới</label>
            <input type="file" id="newUpload" name="newUpload" class="form-control">
        </div>
        
        <input type="submit" value="Sửa thông tin" class="btn btn-primary">
    </div>
</form>
