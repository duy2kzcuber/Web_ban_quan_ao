<?php
//lay id can sua
$idprd=$_GET['sid'];

//ketnoi
require_once '../../ketnoi.php';
//cau lenh de lay thong tin 
$sua_sql="SELECT *FROM productsize WHERE idprd='$idprd'";
$result=mysqli_query($conn,$sua_sql);
$row = mysqli_fetch_assoc($result);

include "../../slider.php";
?>


<form name="form" action="updatesoluong.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="sid" value="<?php echo $idprd; ?>" />
    <div class="container">
        <h1>Form Sửa Số Lượng Size</h1>
        <div class="form-group">
            <label for="masp">Mã sản phẩm</label>
            <input type="text" id="masp" class="form-control" name="masp" value="<?php echo $row['masp']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="id">Mã size</label>
            <input type="text" id="id" class="form-control" name="id" value="<?php echo $row['id']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="soluongsize">Số lượng size</label>
            <input type="text" id="soluongsize" class="form-control" name="soluongsize" value="<?php echo $row['soluongsize']; ?>">
        </div>
        
        <input type="submit" value="Sửa thông tin" />
    </div>
</form>


