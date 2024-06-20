<?php
//lay id can sua
$id=$_GET['sid'];

//ketnoi
require_once '../ketnoi.php';
//cau lenh de lay thong tin 
$sua_sql="SELECT *FROM tensize WHERE id='$id'";
$result=mysqli_query($conn,$sua_sql);
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua thong tin size</title>
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
        <input type="hidden" name="sid" value="<?php echo $id;?>" id="">
        <div class="container">
            <h1>Form Sửa thông tin size</h1>
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" id="id" class="form-control" name="id" value="<?php echo $row['id']?>">
            </div>
            <div class="form-group">
                <label for="id">Tên Size</label>
                <input type="text" id="size" class="form-control" name="size" value="<?php echo $row['tensize']?>">
            </div>
            
            <input type="submit" value="Sua thong tin"/>
        </div>
    </form>
</body>
</html>

