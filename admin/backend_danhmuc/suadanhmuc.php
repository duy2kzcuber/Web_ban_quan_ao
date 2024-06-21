<?php
//lay id can sua
$madm=$_GET['sid'];

//ketnoi
require_once '../ketnoi.php';
//cau lenh de lay thong tin 
$sua_sql="SELECT *FROM danhmuc WHERE madm='$madm'";
$result=mysqli_query($conn,$sua_sql);
$row = mysqli_fetch_assoc($result);

include "../slider.php";
?>


<form name="form" action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="sid" value="<?php echo $madm;?>" madm="">
        <div class="container">
            <h1>Form Sửa thông tin danh muc</h1>
            <div class="form-group">
                <label for="madm">Mã danh mục</label>
                <input type="text" id="madm" class="form-control" name="madm" value="<?php echo $row['madm']?>">
            </div>
            <div class="form-group">
                <label for="danhmuccha">Tên danh mục cha</label>
                <input type="text" id="danhmuccha" class="form-control" name="danhmuccha" value="<?php echo $row['danhmuccha']?>">
            </div>
            <div class="form-group">
                <label for="id">Tên Danh Mục</label>
                <input type="text" id="tendm" class="form-control" name="tendm" value="<?php echo $row['tendm']?>">
            </div>
            
            <input type="submit" value="Sua thong tin"/>
        </div>
    </form>


