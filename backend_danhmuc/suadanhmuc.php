<?php
//lay id can sua
$madm=$_GET['sid'];

//ketnoi
require_once 'ketnoi.php';
//cau lenh de lay thong tin 
$sua_sql="SELECT *FROM danhmuc WHERE madm='$madm'";
$result=mysqli_query($conn,$sua_sql);
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua thong tin danh muc</title>
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
        <input type="hidden" name="sid" value="<?php echo $madm;?>" madm="">
        <div class="container">
            <h1>Form Sửa thông tin danh muc</h1>
            <div class="form-group">
                <label for="madm">Mã danh mục</label>
                <input type="text" id="madm" class="form-control" name="madm" value="<?php echo $row['madm']?>">
            </div>
            <div class="form-group">
                <label for="id">Tên Danh Mục</label>
                <input type="text" id="tendm" class="form-control" name="tendm" value="<?php echo $row['tendm']?>">
            </div>
            
            <input type="submit" value="Sua thong tin"/>
        </div>
    </form>
</body>
</html>

