<?php
//lay id can sua
$masp=$_GET['sid'];

//ketnoi
require_once 'ketnoi.php';
//cau lenh de lay thong tin 
$sua_sql="SELECT *FROM product WHERE masp='$masp'";
$result=mysqli_query($conn,$sua_sql);
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua thong tin product</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <form name="form" action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="sid" value="<?php echo $masp;?>" masp="">
        <div class="container">
            <h1>Form sửa thông tin product</h1>
            <div class="form-group">
                <label for="masp">Mã sản phẩm</label>
                <input type="text" id="masp" class="form-control" name="masp" value="<?php echo $row['masp']?>">
            </div>
            <div class="form-group">
                <label for="tensp">Tên sản phẩm</label>
                <input type="text" id="tensp" class="form-control" name="tensp" value="<?php echo $row['tensp']?>">
            </div>
            <div class="form-group">
                <label for="gia">Giá</label>
                <input type="text" id="gia" name="gia" class="form-control" value="<?php echo $row['gia']?>">
            </div>
            <div class="form-group">
                <label for="mausac">Màu sắc</label>
                <input type="text" id="mausac" name="mausac" class="form-control" value="<?php echo $row['mausac']?>">
            </div>
            <div class="form-group">
                <label for="soluong">Số lượng kho</label>
                <input type="text" id="soluong" name="soluong" class="form-control" value="<?php echo $row['soluong']?>">
            </div>
            <div class="form-group">
                <label for="ngaytao">Ngày tạo</label>
                <input type="date" id="ngaytao" name="ngaytao" class="form-control" value="<?php echo $row['ngaytao']?>">
            </div>
            <div class="form-group">
                <label for="gioithieu">Giới thiệu</label>
                <input type="text" id="gioithieu" name="gioithieu" class="form-control" value="<?php echo $row['gioithieu']?>">
            </div>
            <div class="form-group">
                <label for="ctsp">Chi tiết sản phẩm</label>
                <input type="text" id="ctsp" name="ctsp" class="form-control" value="<?php echo $row['ctsp']?>">
            </div>
            <div class="form-group">
                <label for="baoquan">Bảo quản</label>
                <input type="text" id="baoquan" name="baoquan" class="form-control" value="<?php echo $row['baoquan']?>">
            </div>
            <div class="form-group">
                <label for="upload">Tên ảnh cũ</label>
                <input type="text" id="upload" name="upload" class="form-control" value="<?php echo htmlspecialchars($row['anh']); ?>">
            </div>
            <div class="form-group">
                <label for="uploads">Upload ảnh mô tả cũ</label>
                <input type="text" id="uploads" name="uploads[]" class="form-control" value="<?php echo htmlspecialchars($row['fileanh']); ?>">
            </div>
            <div class="form-group">
                <label for="newUpload">Chọn ảnh mới</label><br>
                <!-- Trường input loại file để chọn ảnh mới -->
                <input type="file" id="newUpload" name="newUpload" class="form-control">
            </div>
            <div class="form-group">
                                <label for="uploads">Upload ảnh mô tả mới</label>
                                <input type="file" id="newuploads" name="newuploads[]" class="form-control" multiple>
            </div>


            <input type="submit" value="Sua thong tin"/>
        </div>
    </form>
</body>
</html>

