<?php
//lay id can sua
$manv=$_GET['sid'];

//ketnoi
require_once '../ketnoi.php';
include "../slider.php";
//cau lenh de lay thong tin 
$sua_sql="SELECT * FROM nhanvien WHERE manv='$manv'";
$result=mysqli_query($conn,$sua_sql);
$row = mysqli_fetch_assoc($result);
?>


    <form name="form" action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="sid" value="<?php echo $manv;?>" id="">
        <div class="container">
            <h1>Form Sửa thông tin nhân viên</h1>
            <div class="form-group">
                <label for="manv">Mã nhân viên</label>
                <input type="text" id="manv" class="form-control" name="manv" value="<?php echo $row['manv']?>" required>
            </div>
            <div class="form-group">
                <label for="tennv">Tên nhân viên</label>
                <input type="text" id="tennv" class="form-control" name="tennv" value="<?php echo $row['tennv']?>" required>
            </div>
            <div class="form-group">
                <label for="ngaysinh">Ngày sinh</label>
                <input type="date" id="ngaysinh" class="form-control" name="ngaysinh" value="<?php echo $row['ngaysinh']?>" required>
            </div>
            <div class="form-group">
                <label for="gioitinh">Giới tính</label>
                <select id="gioitinh" class="form-control" name="gioitinh" required>
                    <option value="Nam" <?php if($row['gioitinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if($row['gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="diachi">Địa chỉ</label>
                <input type="text" id="diachi" class="form-control" name="diachi" value="<?php echo $row['diachi']?>" required>
            </div>
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" id="sdt" class="form-control" name="sdt" value="<?php echo $row['sdt']?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email" value="<?php echo $row['email']?>" required>
            </div>
            <div class="form-group">
                <label for="ngayvaolam">Ngày vào làm</label>
                <input type="date" id="ngayvaolam" class="form-control" name="ngayvaolam" value="<?php echo $row['ngayvaolam']?>" required>
            </div>
            <div class="form-group">
                <label for="luong">Lương</label>
                <input type="number" id="luong" class="form-control" name="luong" value="<?php echo $row['luong']?>" required>
            </div>
            <div class="form-group">
                <label for="ghichu">Ghi chú</label>
                <textarea id="ghichu" class="form-control" name="ghichu"><?php echo $row['ghichu']?></textarea>
            </div>
            <input type="submit" value="Sửa thông tin" class="btn btn-success"/>
        </div>
    </form>

